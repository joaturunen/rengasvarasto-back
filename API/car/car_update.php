<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$db = null;

// Get raw posted data
$input = json_decode(file_get_contents("php://input"));

$register = filter_var($input->register, FILTER_SANITIZE_STRING);
$brand = filter_var($input->brand, FILTER_SANITIZE_STRING);
$model = filter_var($input->model, FILTER_SANITIZE_STRING);
$id = filter_var($input->id, FILTER_SANITIZE_NUMBER_INT);

try {
  $db = openDb();
  $update = $db->prepare("UPDATE car SET 
            register = :register,
            brand = :brand,
            model = :model
          WHERE id = :id");

  $update->bindValue(":register", $register, PDO::PARAM_STR);
  $update->bindValue(":brand", $brand, PDO::PARAM_STR);
  $update->bindValue(":model", $model, PDO::PARAM_STR);
  $update->bindValue(":id", $id, PDO::PARAM_INT);

  $update->execute();

  header('HTTP/1.1 200 OK');
  $data = array('id' => $id);
  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
