<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';


// Get raw posted data
$input = json_decode(file_get_contents('php://input'));

$car_id = filter_var($input->car_id, FILTER_SANITIZE_NUMBER_INT);
//$slot_id = filter_var($input->slot_id, FILTER_SANITIZE_NUMBER_INT); tätä ei oo tietokannassa tires-taulussa
$brand = filter_var($input->brand, FILTER_SANITIZE_STRING);
$model = filter_var($input->model, FILTER_SANITIZE_STRING);
$type = filter_var($input->type, FILTER_SANITIZE_STRING);
//$hubcups = filter_var($input->hubcups, FILTER_SANITIZE_STRING);
$groovefl = filter_var($input->groovefl, FILTER_SANITIZE_NUMBER_INT);
$groovefr = filter_var($input->groovefr, FILTER_SANITIZE_STRING);
$groovebl = filter_var($input->groovebl, FILTER_SANITIZE_STRING);
$groovebr = filter_var($input->groovebr, FILTER_SANITIZE_STRING);
$tiresize = filter_var($input->tiresize, FILTER_SANITIZE_STRING);
$tirebolt = filter_var($input->tirebolt, FILTER_SANITIZE_STRING);
$text = filter_var($input->type, FILTER_SANITIZE_STRING);
$rims = filter_var($input->rims, FILTER_SANITIZE_STRING);
$info = filter_var($input->info, FILTER_SANITIZE_STRING);

$hubcups = true;


try {
  //instantiate DB & connect
  $db = openDb();

  // Create query
  $sql = "INSERT INTO tires 
    (car_id, brand, model, type, hubcups, groovefl, groovefr, 
      groovebl, groovebr, tiresize, tirebolt, text, rims, info)
    VALUES ('$car_id', '$brand', '$model', '$type', '$hubcups', '$groovefl', '$groovefr', 
      '$groovebl', '$groovebr', '$tiresize', '$tirebolt', '$text', '$rims', '$info'')";

  $tires_id = executeInsert($db, $sql);
  header('HTTP/1.1 200 OK');
  $data = array('id' => $tires_id, 'car_id' => $car_id, 'brand' => $brand, 
    'model' => $model, 'type' => $type, 'hubcups' => $hubcups, 'groovefl' => $groovefl, 
    'groovefr' => $groovefr, 'groovebl' => $groovebl, 'groovebr' => $groovebr, 'tiresize' => $tiresize, 
    'tirebolt' => $tirebolt, 'text' => $text, '' => $rims, '' => $info);

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
