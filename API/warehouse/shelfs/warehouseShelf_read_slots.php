<?php
require_once '../../../inc/headers.php';
require_once '../../../inc/functions.php';

$db = null;

// Get raw posted data
$input = json_decode(file_get_contents("php://input"));

$id = filter_var($input->id, FILTER_SANITIZE_NUMBER_INT);

try {

  if($id === '4'){
    $id2 = $id;
    $id = 4;
  }
    

  $db = openDb();

  $show = $db->prepare("SELECT
    warehouse.id as warehouse_id,
    shelf.id as shelf_id,
    slot.id as slot_id,
    tires.id as tires_id
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

  $show->bindValue(":id", $id, PDO::PARAM_INT);
  $show->execute();
  $data = $show->fetchAll(PDO::FETCH_ASSOC);

  header('HTTP/1.1 200 OK');
  $data = array('id' => $id2);
  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
