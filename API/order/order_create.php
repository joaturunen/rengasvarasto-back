<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$input = json_decode(file_get_contents('php://input'));

$cus_id = filter_var($input->customer_id, FILTER_SANITIZE_NUMBER_INT);
$employee_id = filter_var($input->employee_id, FILTER_SANITIZE_NUMBER_INT);
$car_id = filter_var($input->car_id, FILTER_SANITIZE_NUMBER_INT);
$tires_id = filter_var($input->tires_id, FILTER_SANITIZE_NUMBER_INT);
$cart = $input->cart;

try {
     $db = openDb();
     $db->beginTransaction();

    $sql = "INSERT INTO orders (customer_id, employee_id) VALUES ('$cus_id', '$employee_id')";
    $order_id = executeInsert($db, $sql);

    $slot_id = 0;

    foreach ($cart as $services) {
      $sql = "INSERT INTO ordertable (orders_id, services_id) VALUES ($order_id, '$services->id')";
      executeInsert($db, $sql);

      $category_id = $services->category_id;
      if($category_id === 1){

        $stmt = $db->prepare("SELECT slot_id FROM slot_order WHERE tires_id IS NULL");
        $slot_id = $stmt->fetch();

        // $show->execute();
        // $data = $show->fetchAll(PDO::FETCH_ASSOC);

        // $sql = "UPDATE slot_order SET ($tires_id) where slot_id = ";
        // $slot_id = executeInsert($db, $sql);
      }
    }

     $db->commit();

    header('HTTP/1.1 200 OK');
    $data = array('id' => $cus_id,
      'Tyontekijä' => $employee_id,
      'car_id'=> $car_id,
      'tires_id' => $tires_id,
      'cart' => $cart,
      "tilausNRO:" => $order_id, 
      'hyllypaikka' => $slot_id);
    echo json_encode($data);
}
catch (PDOException $pdoex) {
    $db->rollback();
    returnError($pdoex);
}