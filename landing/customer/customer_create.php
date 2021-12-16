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


try {
  //instantiate DB & connect
  $db = openDb();

  // Create query
  $sql = "INSERT INTO customer (firstname, lastname, phone, email, address, zipcode, city, employee_id)
  VALUES ('" .
    filter_var($firstname, FILTER_SANITIZE_STRING) . "','" .
    filter_var($lastname, FILTER_SANITIZE_STRING) . "','" .
    filter_var($phone, FILTER_SANITIZE_STRING) . "','" .
    filter_var($email, FILTER_SANITIZE_STRING) . "','" .
    filter_var($address, FILTER_SANITIZE_STRING) . "','" .
    filter_var($zipcode, FILTER_SANITIZE_STRING) . "','" .
    filter_var($city, FILTER_SANITIZE_STRING) . "','" .
    filter_var($employee_id, FILTER_SANITIZE_STRING) . "')";

  $customer_id = executeInsert($db, $sql);
  header('HTTP/1.1 200 OK');
  $data = array('id' => $customer_id);
  echo json_encode($data);
} catch (PDOException $pdoex) {

  returnError($pdoex);
}
