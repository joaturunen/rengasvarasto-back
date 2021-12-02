<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';


$input = json_decode(file_get_contents('php://input'));

$id = filter_var($input->cus_id, FILTER_SANITIZE_NUMBER_INT);

try {

  //$id = 1;

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
    $tires = getTires($car_id);
    $tires_id = [];
    foreach ($tires as $tire) {
      array_push($tires_array, $tire);
    };
  };

  $data['tires'] = $tires_array;

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
