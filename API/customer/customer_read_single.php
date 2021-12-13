<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

// Get raw posted data
$input = json_decode(file_get_contents('php://input'));

$uri = parse_url(filter_input(INPUT_SERVER, 'PATH_INFO'), PHP_URL_PATH);

$id = filter_var($input->cus_id, FILTER_SANITIZE_NUMBER_INT);


try {
  $db = openDb();
  $show = $db->prepare("SELECT * FROM customer WHERE id = :id");

  $show->bindValue(":id", $id, PDO::PARAM_INT);

  $show->execute();
  $data = $show->fetch(PDO::FETCH_ASSOC);

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
