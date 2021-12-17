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
  //$db = null;

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
  //$db = null;

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
  //$db = null;

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
    warehouse.id as warehouse_id,
    season.name as order_season
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
    LEFT JOIN orders
    ON orders.tires_id = tires.id
    LEFT JOIN season
    ON season.id = orders.season_id
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
  //$db = null;

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
  //$db = null;

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
  //$db = null;

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
  //$db = null;

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
  //$db = null;
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
  //$db = null;
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
  //$db = null;
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
  //$db = null;
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


function addCarForCustomer($customer_id, $register, $brand, $model){
  {
    //$db = null;
    try {
      $db = openDb();
      $sql = "INSERT INTO car (register, brand, model, customer_id)
      VALUES ('$register','$brand', '$model', '$customer_id')";

      $car_id = executeInsert($db, $sql);
  
      return $car_id;
    } catch (PDOException $pdoex) {
      returnError($pdoex);
    }
  }
}

function addTires($car_id){
  //$db = null;
  try {
    $db = openDb();
    $sql = "INSERT INTO tires (car_id) VALUES ($car_id)";

    $tires_id = executeInsert($db, $sql);

    return $tires_id;
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
}

function getCusOrders($customer_id) {
  try {
    $db = openDb();
    $sql = "SELECT
      orders.id,
      car.register as car_register,
      orders.orderdate
      FROM customer, car, tires, orders
      WHERE customer.id = orders.customer_id
      AND customer.id = car.customer_id
      AND car.id = tires.car_id
      AND tires.id = orders.tires_id
      AND customer.id = :customer_id";

    $show = $db->prepare($sql);

    $show->bindValue(":customer_id", $customer_id, PDO::PARAM_INT);

    $show->execute();
    $data = $show->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  } catch (PDOException $pdoex) {
  returnError($pdoex);
  }
}

function getTiresOldModal($id)
{
  try {
    $db = openDb();

    $show = $db->prepare("SELECT
    tires.id, 
    tires.car_id as car_id, 
    car.register as car_register,
    tires.brand,
    tires.type,
    slot_order.slot_id as slot_id,
    season.name as order_season
    FROM car
    LEFT JOIN tires
    ON tires.car_id = car.id
    LEFT JOIN slot_order
    ON slot_order.tires_id = tires.id
    LEFT JOIN orders
    ON orders.tires_id = tires.id
    LEFT JOIN season
    ON season.id = orders.season_id
    WHERE car.id = :id AND slot_order.tires_id IS NULL OR (tires.id = slot_order.tires_id)
    ORDER BY tires.id");

    $show->bindValue(":id", $id, PDO::PARAM_INT);

    $show->execute();
    $data = $show->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
}
