<?php
require_once '../../../inc/headers.php';
require_once '../../../inc/functions.php';


// Get raw posted data
$input = json_decode(file_get_contents("php://input"));

$id = intval(filter_var($input->id, FILTER_SANITIZE_NUMBER_INT));

try {

  $db = openDb();

  $show = $db->prepare("SELECT
    warehouse.id as warehouse_id,
    shelf.id as shelf_id,
    slot.id as slot_id,
    tires.id as tires_id,
    tires.brand as tires_brand,
    tires.type as tires_type,
    tires.text as tires_text
    FROM warehouse
    LEFT JOIN shelf
    ON shelf.warehouse_id = warehouse.id
    LEFT JOIN slot
    ON slot.shelf_id = shelf.id
    LEFT JOIN slot_order
    ON slot_order.slot_id = slot.id
    LEFT JOIN tires
    ON tires.id = slot_order.tires_id
    WHERE shelf.id = :id
    ORDER BY slot_id");

  // $show = $db->query("SELECT * FROM shelf WHERE id = $id");

  $show->bindValue(":id", $id, PDO::PARAM_INT);
  $show->execute();
  $slots = $show->fetchAll(PDO::FETCH_ASSOC);

  $shelfs = getShelfs();

  $next = 0;
  $previous = 0;
  for($i = 0; $i < sizeof($shelfs);$i++){
    if($shelfs[$i]['id'] === $id){
      if($i !== 0){
        $previous = $shelfs[$i - 1]['id'];
      }
      $testNext = $i + 1;
      if($testNext !== sizeof($shelfs)){
        $next = $shelfs[$testNext]['id'];
    }
    }

  };

  $data = array("slots" => $slots, "next" => $next, "previous" => $previous);

  // $data = array('sql' => $show);

  header('HTTP/1.1 200 OK');
  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
