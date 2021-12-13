<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

// Get raw posted data
$input = json_decode(file_get_contents("php://input"));

$firstname = filter_var($input->firstname, FILTER_SANITIZE_STRING);
$lastname = filter_var($input->lastname, FILTER_SANITIZE_STRING);
$phone = filter_var($input->phone, FILTER_SANITIZE_STRING);
$email = filter_var($input->email, FILTER_SANITIZE_STRING);
$address = filter_var($input->address, FILTER_SANITIZE_STRING);
$zipcode = filter_var($input->zipcode, FILTER_SANITIZE_NUMBER_INT);
$city = filter_var($input->city, FILTER_SANITIZE_STRING);
$employee_id = filter_var($input->employee_id, FILTER_SANITIZE_NUMBER_INT);
$register = filter_var($input->register, FILTER_SANITIZE_STRING);
$brand = filter_var($input->brand, FILTER_SANITIZE_STRING);
$model = filter_var($input->model, FILTER_SANITIZE_STRING);


try {
  //instantiate DB & connect
  $db = openDb();
  $db->beginTransaction();

  // Create query
  $sql = "INSERT INTO customer (firstname, lastname, phone, email, address, zipcode, city, employee_id)
  VALUES ('$firstname', '$lastname', '$phone', '$email', '$address', '$zipcode', '$city', '$employee_id')";
  $customer_id = executeInsert($db, $sql);

  $sql = "INSERT INTO car (register, brand, model, customer_id)
  VALUES ('$register','$brand', '$model', $customer_id)";
  $car_id = executeInsert($db, $sql);

  $sql = "INSERT INTO tires (car_id) VALUES ($car_id)";
  $tires_id = executeInsert($db, $sql);

  $db->commit();

  $db->commit();
  header('HTTP/1.1 200 OK');
  $data = array('customer_id' => $customer_id, 
  'firstname' => $firstname,
  'lastname' => $lastname,
  'address' => $address,
  'zipcode' => $zipcode,
  'city' => $city,
  'phone' => $phone,
  'email' => $email,
  'car_id' => $car_id,
  'car_register' => $register,
  'tires_id' => $tires_id);

  echo json_encode($data);
} catch (PDOException $pdoex) {
  $db->rollback();
  returnError($pdoex);
}
