<?php
require_once '../../../inc/headers.php';
require_once '../../../inc/functions.php';

$db = null;

try {

  $shelfs = getShelfs();

  $data = [];

  foreach ($shelfs as $row) {
    $shelfData = getShelfSlots($row['id']);
    $amount = getCalculateSlots($row['id']);
    $free = getCalculateSlotsNull($row['id']);
    $shelf = array("id" => $row['id'], "amount" => $amount, "free" => $free);
    array_push($data, $shelf);
  }

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
