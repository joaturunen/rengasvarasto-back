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
$asiakas_id = filter_var($input->asiakas_id, FILTER_SANITIZE_NUMBER_INT);


try {
  //instantiate DB & connect
  $db = openDb();

  // Create query
  $sql = "INSERT INTO car (reknro, merkki, koko, pultti, asiakas_id)
  VALUES ('" .
    filter_var($reknro, FILTER_SANITIZE_STRING) . "','" .
    filter_var($merkki, FILTER_SANITIZE_STRING) . "','" .
    filter_var($koko, FILTER_SANITIZE_STRING) . "','" .
    filter_var($pultti, FILTER_SANITIZE_STRING) . "','" .
    filter_var($asiakas_id, FILTER_SANITIZE_STRING) . "')";

  $asiakas_id = executeInsert($db, $sql);
  header('HTTP/1.1 200 OK');
  $data = array('id' => $asiakas_id);
  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
