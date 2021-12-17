<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$input = json_decode(file_get_contents('php://input'));

$cus_id = filter_var($input->customer_id, FILTER_SANITIZE_NUMBER_INT);
$employee_id = filter_var($input->employee_id, FILTER_SANITIZE_NUMBER_INT);
$car_id = filter_var($input->car_id, FILTER_SANITIZE_NUMBER_INT);
$tires_id = filter_var($input->tires_id, FILTER_SANITIZE_NUMBER_INT);
$oldTires_id = filter_var($input->oldTires_id, FILTER_SANITIZE_NUMBER_INT);
$slot_id = filter_var($input->slot_id, FILTER_SANITIZE_NUMBER_INT);
$cart = $input->cart;

try {
    $message = "";
    $db = openDb();
    $db->beginTransaction();

    $order_id = 0;

    $sql = "INSERT INTO orders (customer_id, employee_id, tires_id) VALUES ($cus_id, $employee_id, null)";
    $order_id = executeInsert($db, $sql);


    if($oldTires_id > 0){
      $message .= "Vanhat renkaat NRO-$oldTires_id poistetaan varastosta paikalta NRO $slot_id. Paikalle lisätään renkaat NRO-$tires_id. ";

      $sql = "UPDATE orders SET tires_id = $tires_id WHERE orders.id = $order_id";
      executeInsert($db, $sql);

      $sql = "UPDATE slot_order SET tires_id = $tires_id WHERE slot_id = $slot_id";
      $order_id = executeInsert($db, $sql);

      $message .= "Renkaat NRO-$oldTires_id vaihdetaan autoon. ";
    } else if($tires_id > 0){
      $message .= "Lisätään varastoon renkaat NRO-$tires_id paikalle $slot_id. ";
      
      $sql = "UPDATE orders SET tires_id = $tires_id WHERE orders.id = $order_id";
      executeInsert($db, $sql);
      
      $stmt = $db->prepare("SELECT slot_id FROM slot_order WHERE tires_id IS NULL");
      $stmt->execute();
      $slot_idAr = $stmt->fetch();

      $new_slot_id = $slot_idAr[0];

      $sql = "UPDATE slot_order SET tires_id = $tires_id where slot_id = $new_slot_id";
      $new_slot_id = executeInsert($db, $sql);
    } else {
      $message .= "Tilaus ilman rengaspaikkaa.";
    }

    foreach ($cart as $services) {
      $sql = "INSERT INTO ordertable (orders_id, services_id) VALUES ($order_id, '$services->id')";
      executeInsert($db, $sql);
      $season = $services->season_id;
      if($season !== null){
        $sql = "UPDATE orders SET season_id = $season WHERE orders.id = $order_id";
        executeInsert($db, $sql);
      }
    }

    $sql = "UPDATE orders SET info = '$message' WHERE orders.id = $order_id";
    executeInsert($db, $sql);

    $db->commit();

    header('HTTP/1.1 200 OK');
    $data = array('status' => "Tilaus onnistui.");
    echo json_encode($data);
}
catch (PDOException $pdoex) {
    $db->rollback();
    returnError($pdoex);
}