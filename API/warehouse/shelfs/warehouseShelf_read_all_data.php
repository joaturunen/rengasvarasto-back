<?php
require_once '../../../inc/headers.php';
require_once '../../../inc/functions.php';

$db = null;

try {

  $shelfs = getShelfs();

  $data = [];

  foreach ($shelfs as $row) {
    $shelfData = getShelfSlots($row['id']);
    $amount = 0;
    $amount = getCalculateSlots($row['id']);

    $shelf = array("id" => $row['id'], "amount" => $letsCount, "free" => $slot_data);
    array_push($data, $shelf);
  }

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
