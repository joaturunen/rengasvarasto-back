<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$db = null;

// Get raw posted data
$input = json_decode(file_get_contents("php://input"));

$reknro = filter_var($input->reknro, FILTER_SANITIZE_STRING);
$merkki = filter_var($input->merkki, FILTER_SANITIZE_STRING);
$koko = filter_var($input->koko, FILTER_SANITIZE_STRING);
$pultti = filter_var($input->pultti, FILTER_SANITIZE_STRING);
$id = filter_var($input->id, FILTER_SANITIZE_NUMBER_INT);

try {
  $db = openDb();
  $update = $db->prepare("UPDATE car SET 
            reknro = :reknro,
            merkki = :merkki,
            koko = :koko,
            pultti = :pultti
          WHERE id = :id");

  $update->bindValue(":reknro", $reknro, PDO::PARAM_STR);
  $update->bindValue(":merkki", $merkki, PDO::PARAM_STR);
  $update->bindValue(":koko", $koko, PDO::PARAM_STR);
  $update->bindValue(":pultti", $pultti, PDO::PARAM_STR);
  $update->bindValue(":id", $id, PDO::PARAM_INT);

  $update->execute();

  header('HTTP/1.1 200 OK');
  $data = array('id' => $id);
  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
