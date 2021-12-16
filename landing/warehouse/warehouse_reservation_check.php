<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

try {
  $db = openDb();
  $show = $db->prepare("SELECT * FROM slot_order WHERE tires_id IS NULL");

  $show->execute();
  $data = $show->fetchAll(PDO::FETCH_ASSOC);

  if (count($data) > 0) {
    $data = array("reservation_free" => true);
  } else {
    $data = array("reservation_free" => false);
  }

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
