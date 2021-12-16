<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$db = null;

// Get raw posted data
// $input = json_decode(file_get_contents('php://input'));

//$id = filter_var($input->id, FILTER_SANITIZE_NUMBER_INT);

$id = isset($_GET['id']) ? $_GET['id'] : die();

try {
  $db = openDb();

  $show = $db->prepare("SELECT * FROM car WHERE customer_id = :id");

  $show->bindValue(":id", $id, PDO::PARAM_INT);

  $show->execute();
  $data = $show->fetchAll(PDO::FETCH_ASSOC);
  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}