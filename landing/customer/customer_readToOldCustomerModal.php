<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';


$input = json_decode(file_get_contents('php://input'));

$id = intval(filter_var($input->cus_id, FILTER_SANITIZE_NUMBER_INT));

try {

  $customer = getCustomer($id);

  $data['customer'] = $customer;

  $cars = getCars($id);
  $cars_id = [];
  $cars_array = [];
  foreach ($cars as $row) {
    array_push($cars_array, $row);
    array_push($cars_id, $row['id']);
  };

  $data['cars'] = $cars_array;

  $tires_array = [];
  foreach ($cars_id as $car_id) {
    $tires = getTiresOldModal($car_id);
    foreach ($tires as $tire) {
      array_push($tires_array, $tire);
    };
  };


  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
