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
  try {
    $db = openDb();

    $show = $db->prepare("SELECT * FROM tires WHERE car_id = :id");

    $show->bindValue(":id", $id, PDO::PARAM_INT);

    $show->execute();
    $data = $show->fetchAll(PDO::FETCH_ASSOC);

    return $data;
  } catch (PDOException $pdoex) {
    returnError($pdoex);
  }
}
