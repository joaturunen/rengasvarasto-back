<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

// HAKEE ASIAKASNUMEROLLA !!

$db = null;

// Get raw posted data
$input = json_decode(file_get_contents('php://input'));

// $id = filter_var($input->id, FILTER_SANITIZE_NUMBER_INT);

$customer_id = filter_var($input->customer_id, FILTER_SANITIZE_NUMBER_INT);

$id = isset($_GET['id']) ? $_GET['id'] : die();

try {
  $db = openDb();
  $show = $db->prepare("SELECT * FROM car WHERE customer_id = :customer_id");

  $show->bindValue(":customer_id", $id, PDO::PARAM_INT);

  $show->execute();
  $data = $show->fetch(PDO::FETCH_ASSOC);

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
