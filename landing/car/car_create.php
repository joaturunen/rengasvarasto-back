<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

// Get raw posted data
$input = json_decode(file_get_contents("php://input"));

$customer_id = intval(filter_var($input->customer_id, FILTER_SANITIZE_NUMBER_INT));
$register = filter_var($input->register, FILTER_SANITIZE_STRING);
$brand = filter_var($input->brand, FILTER_SANITIZE_STRING);
$model = filter_var($input->model, FILTER_SANITIZE_STRING);

try {
  //instantiate DB & connect
  $db = openDb();
  $db->beginTransaction();

  $car_id = addCarForCustomer($customer_id, $register, $brand, $model);
  $tires_id = addTires($car_id);

  $db->commit();
  header('HTTP/1.1 200 OK');
  $data = array(
    'id' => $car_id,
    'register' => $register,
    'brand' => $brand,
    'model' => $model,
    'customer_id' => $customer_id
  );
  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
