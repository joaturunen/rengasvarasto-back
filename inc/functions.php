<?php
function openDb(): object
{
  $ini = parse_ini_file("config.ini", true);

  $host = $ini['host'];
  $database = $ini['database'];
  $user = $ini['user'];
  $password = $ini['password'];

  $db = new PDO("pgsql:host=$host;port=5432;dbname=$database", $user, $password);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  return $db;
}

function selectAsJson(object $db, string $sql): void
{
  $query = $db->query($sql);
  $results = $query->fetchAll(PDO::FETCH_ASSOC);
  header('HTTP/1.1 200 OK');
  echo json_encode($results);
}

function executeInsert(object $db, string $sql): int
{
  $query = $db->query($sql);
  return $db->lastInsertId();
}

function returnError(PDOException $pdoex): void
{
  header('HTTP/1.1 500 Internal Server Error');
  $error = array('error' => $pdoex->getMessage());
  echo json_encode($error);
  exit;
}

function getCars($id)
{
  $db = null;

  try {
    $db = openDb();

    $show = $db->prepare("SELECT * FROM car WHERE customer_id = :id");

    $show->bindValue(":id", $id, PDO::PARAM_INT);

    $show->execute();
    $data = $show->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
}

function getCustomer($id)
{
  $db = null;

  try {
    $db = openDb();

    $show = $db->prepare("SELECT * FROM customer WHERE id = :id");

    $show->bindValue(":id", $id, PDO::PARAM_INT);

    $show->execute();
    $data = $show->fetch(PDO::FETCH_ASSOC);

    return  $data;
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
}


function getTires($id)
{
  $db = null;

  try {
    $db = openDb();

    // COUNT(s.slot_id)
    // FROM slot_order s 
    // LEFT JOIN slot 
    // ON slot.id = s.slot_id 
    // LEFT JOIN shelf 
    // ON shelf.id = slot.shelf_id 
    // WHERE shelf.id = :id AND s.tires_id IS NULL");


    $show = $db->prepare("SELECT
    tires.id, 
    tires.car_id, 
    car.register as car_register,
    tires.brand,
    tires.model,
    tires.type,
    tires.hubcups,
    tires.groovefl,
    tires.groovefr,
    tires.groovebl,
    tires.groovebr,
    tires.tiresize,
    tires.tirebolt,
    tires.text,
    tires.rims,
    tires.servicedate,
    tires.info,
    slot.id as slot_id,
    shelf.id as shelf_id,
    warehouse.id as warehouse_id
    FROM car
    LEFT JOIN tires
    ON tires.car_id = car.id
    LEFT JOIN slot_order
    ON slot_order.tires_id = tires.id
    LEFT JOIN slot
    ON slot.id = slot_order.slot_id
    LEFT JOIN shelf
    ON shelf.id = slot.shelf_id
    LEFT JOIN warehouse
    ON warehouse.id = shelf.warehouse_id
    WHERE car.id = :id");

    $show->bindValue(":id", $id, PDO::PARAM_INT);

    $show->execute();
    $data = $show->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
}


function getShelf_amount($id)
{
  $db = null;

  try {
    $db = openDb();

    $show = $db->prepare("SELECT * FROM slots WHERE shelf_id = :id");

    $show->bindValue(":id", $id, PDO::PARAM_INT);

    $show->execute();
    $data = $show->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
}

function getShelfs()
{
  $db = null;

  try {

    $db = openDb();
    $show = $db->prepare("SELECT id FROM shelf");

    $show->execute();
    $data = $show->fetchAll(PDO::FETCH_ASSOC);


    return $data;
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
}

function getShelfSlots($id)
{
  $db = null;

  try {

    $db = openDb();
    $show = $db->prepare("SELECT id FROM slot WHERE shelf_id = :id");

    $show->bindValue(":id", $id, PDO::PARAM_INT);

    $show->execute();
    $data = $show->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
}

function getSlot($id)
{
  $db = null;

  try {

    $db = openDb();
    $show = $db->prepare("SELECT COUNT(*) FROM slot_order WHERE slot_id = :id AND tires_id IS NOT NULL");

    $show->bindValue(":id", $id, PDO::PARAM_INT);

    $show->execute();
    $data = $show->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
}

function getCalculateSlots($id)
{
  $db = null;
  try {

    $db = openDb();
    $show = $db->prepare("SELECT COUNT(*) FROM slot WHERE shelf_id = :id");

    $show->bindValue(":id", $id, PDO::PARAM_INT);

    $show->execute();
    $data = $show->fetchAll(PDO::FETCH_ASSOC);

    return $data[0]['count'];
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
}

function getCalculateSlotsNull($id)
{
  $db = null;
  try {

    $db = openDb();
    $show = $db->prepare("SELECT
      COUNT(s.slot_id)
      FROM slot_order s 
      LEFT JOIN slot 
      ON slot.id = s.slot_id 
      LEFT JOIN shelf 
      ON shelf.id = slot.shelf_id 
      WHERE shelf.id = :id AND s.tires_id IS NULL");

    $show->bindValue(":id", $id, PDO::PARAM_INT);

    $show->execute();
    $data = $show->fetchAll(PDO::FETCH_ASSOC);

    return $data[0]['count'];
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
}


function getCalculateAllSlotsNull()
{
  $db = null;
  try {
    $db = openDb();
    $show = $db->prepare("SELECT
      COUNT(slot_id)
      FROM slot_order 
      WHERE tires_id IS NULL");


    $show->execute();
    $data = $show->fetchAll(PDO::FETCH_ASSOC);

    return $data[0]['count'];
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
}

function getCalculateAllSlotsNotNull()
{
  $db = null;
  try {
    $db = openDb();
    $show = $db->prepare("SELECT
      COUNT(slot_id)
      FROM slot_order 
      WHERE tires_id IS NOT NULL");

    $show->execute();
    $data = $show->fetchAll(PDO::FETCH_ASSOC);

    return $data[0]['count'];
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
}
