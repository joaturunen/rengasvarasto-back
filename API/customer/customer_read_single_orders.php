<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$db = null;

$id = isset($_GET['id']) ? $_GET['id'] : die();

try {
  $db = openDb();
  $show = $db->prepare("SELECT * FROM order WHERE customer_id = :id");

  $show->bindValue(":id", $id, PDO::PARAM_INT);

  $show->execute();
  $data = $show->fetchAll(PDO::FETCH_ASSOC);

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
