<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

// Get raw posted data
$inputJSON = file_get_contents("php://input");

$input = json_decode($inputJSON, TRUE);

$register = filter_var($input->register, FILTER_SANITIZE_STRING);
$brand = filter_var($input->brand, FILTER_SANITIZE_STRING);
$model = filter_var($input->model, FILTER_SANITIZE_STRING);
$customer_id = filter_var($input->customer_id, FILTER_SANITIZE_NUMBER_INT);

try {
  //instantiate DB & connect
  $db = openDb();
  $customer_id = 1;

  $sql = "INSERT INTO car (register, brand, model, customer_id) 
    VALUES ('$register', '$brand', '$model', $customer_id)";

  $car_id = executeInsert($db, $sql);

  header('HTTP/1.1 200 OK');
  $data = array('id' => $car_id, 'register' => $register, 'brand' => $brand, 'model' => $model, 'customer_id' => $customer_id);
  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
