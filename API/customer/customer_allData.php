<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$input = json_decode(file_get_contents('php://input'));
$id = intval(filter_var($input->customer_id, FILTER_SANITIZE_NUMBER_INT));

try {
  $db = openDb();

  $show = $db->prepare("SELECT * FROM customer where id = $id");

  $show->execute();
  $data = $show->fetch();

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
