<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

// Get raw posted data
$input = json_decode(file_get_contents('php://input'));
$id = filter_var($input->id, FILTER_SANITIZE_NUMBER_INT);

try {
  $db = openDb();
  $db->beginTransaction();
  $delTires = $db->prepare("DELETE FROM tires WHERE car_id = :id");
  $delTires->bindValue(":id", $id, PDO::PARAM_INT);
  $delTires->execute();

  $delCar = $db->prepare("DELETE FROM car WHERE id = :id");
  $delCar->bindValue(":id", $id, PDO::PARAM_INT);
  $delCar->execute();

  $db->commit();
  header('HTTP/1.1 200 OK');
  $data = array('id' => $id);
  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
