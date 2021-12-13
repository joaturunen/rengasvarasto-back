<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

try {
  $free =  getCalculateAllSlotsNull();
  $taken = getCalculateAllSlotsNotNull();
  $slots = $free + $taken;

  $percent = $taken / $slots * 100;
  $degree = (360 / 100) * $percent;

  $data = array("all" => $slots, "free" => $free, "taken" => $taken, "degree" => $degree);

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
