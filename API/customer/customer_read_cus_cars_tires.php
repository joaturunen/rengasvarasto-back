<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';


$input = json_decode(file_get_contents('php://input'));

$id = filter_var($input->cus_id, FILTER_SANITIZE_NUMBER_INT);

$data = [];

try {

  $customer = getCustomer($id);

  array_push($data, $customer);

  $cars = getCars($id);
  $cars_id = [];
  foreach ($cars as $row) {
    array_push($data, $row);
    array_push($data, $row['id']);
  };

  foreach ($cars_id as $row) {
  };

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
