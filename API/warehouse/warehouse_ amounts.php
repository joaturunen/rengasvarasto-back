<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$db = null;

try {
  $db = openDb();
  $show = $db->prepare("SELECT * tires_id FROM slot_order");

  $show->execute();
  $data = $show->fetchAll(PDO::FETCH_ASSOC);

  $slots = count($data);
  $letsCount = 0;
  $free = 0;
  $taken = 0;
  while($letsCount <$slots){
    $row = $data[$letsCount];
    if($row['tires_id'] === null){
      $free++;
    } else{
      $taken++;
    };

    $letsCount++;
  }

  $data = array("all" => $slots, "free" => $free, "taken" => $taken);

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
