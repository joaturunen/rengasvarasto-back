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

    $sql = "INSERT INTO orders (customer_id, employee_id) VALUES ($cus_id, $employee_id)";
    $order_id = executeInsert($db, $sql);

    $orderline_id = 0;

    foreach ($cart as $services) {
      $season = $services->season_id;
      if($season === 1){
        $sql = "INSERT INTO orderline (orders_id, services_id, tires_id) VALUES ($order_id, '$services->id', $tires_id)";
        $orderline_id = executeInsert($db, $sql);
      } else {
        $sql = "INSERT INTO orderline (orders_id, services_id, tires_id)  VALUES ($order_id, '$services->id', $tires_id)";
        executeInsert($db, $sql);
      }

    }

    if($oldTires_id > 0 && $orderline_id !== 0){
      $message .= "Vanhat renkaat NRO-$oldTires_id poistetaan varastosta paikalta NRO $slot_id. Paikalle lisätään renkaat NRO-$tires_id. ";

      $sql = "UPDATE orderline SET tires_id = $tires_id WHERE orderline.id = $orderline_id";
      executeInsert($db, $sql);

      $sql = "UPDATE slot_order SET orderline_id = $orderline_id WHERE slot_id = $slot_id";
      executeInsert($db, $sql);

      $message .= "Renkaat NRO-$oldTires_id vaihdetaan autoon. ";
    } else if($tires_id && $orderline_id !== 0){
      
      $message .= "Lisätään varastoon renkaat NRO-$tires_id paikalle $slot_id. ";
      $sql = "UPDATE orderline SET tires_id = $tires_id WHERE orderline.id = $orderline_id";
      executeInsert($db, $sql);
      $stmt = $db->prepare("SELECT slot_id FROM slot_order WHERE orderline_id IS NULL");
      $stmt->execute();
      $slot_idAr = $stmt->fetch();
      $new_slot_id = $slot_idAr[0];

      $sql = "UPDATE slot_order SET orderline_id = $orderline_id where slot_id = $new_slot_id";
      $new_slot_id = executeInsert($db, $sql);

      $message .= "Lisätään varastoon renkaat NRO-$tires_id paikalle $new_slot_id. ";
    }

    if($orderline_id !== 0){
      $sql = "UPDATE orderline SET info = '$message' WHERE orderline.id = $orderline_id";
      executeInsert($db, $sql);
    }

    $db->commit();

    header('HTTP/1.1 200 OK');
    $data = array('status' => "Tilaus onnistui.", 'orderNRO' =>  $order_id);
    echo json_encode($data);
}
catch (PDOException $pdoex) {
    $db->rollback();
    returnError($pdoex);
}