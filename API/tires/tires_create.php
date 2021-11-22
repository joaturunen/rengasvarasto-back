<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$db = null;

// Get raw posted data
$input = json_decode(file_get_contents("php://input"));

$brand = filter_var($input->brand, FILTER_SANITIZE_STRING);
$model = filter_var($input->model, FILTER_SANITIZE_STRING);
$type = filter_var($input->type, FILTER_SANITIZE_STRING);
$kapselit = filter_var($input->kapselit, FILTER_SANITIZE_STRING);
$text = filter_var($input->text, FILTER_SANITIZE_STRING);
$info = filter_var($input->info, FILTER_SANITIZE_STRING);
$car_id = filter_var($input->car_id, FILTER_SANITIZE_NUMBER_INT);

try {
  //instantiate DB & connect
  $db = openDb();

  // Create query
  $sql = "INSERT INTO tires (brand, model, type, dustrims, car_id)
  VALUES ('" .
    filter_var($brand, FILTER_SANITIZE_STRING) . "','" .
    filter_var($model, FILTER_SANITIZE_STRING) . "','" .
    filter_var($type, FILTER_SANITIZE_STRING) . "','" .
    filter_var($dustrims, FILTER_SANITIZE_STRING) . "','" .
    filter_var($car_id, FILTER_SANITIZE_STRING) . "')";

  $tires_id = executeInsert($db, $sql);
  header('HTTP/1.1 200 OK');
  $data = array('id' => $tires_id);
  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
