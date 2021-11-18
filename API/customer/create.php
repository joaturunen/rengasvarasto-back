<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$db = null;

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$etunimi = filter_var($data->etunimi, FILTER_SANITIZE_STRING);
$sukunimi = filter_var($data->sukunimi, FILTER_SANITIZE_STRING);
$puhnro = filter_var($data->puhnro, FILTER_SANITIZE_STRING);
$sposti = filter_var($data->sposti, FILTER_SANITIZE_STRING);
$osoite = filter_var($data->osoite, FILTER_SANITIZE_STRING);
$postinro = filter_var($data->postinro, FILTER_SANITIZE_NUMBER_INT);
$postitmp = filter_var($data->postitmp, FILTER_SANITIZE_STRING);


try {
  //instantiate DB & connect
  $db = openDb();

  // Create query
  $sql = "INSERT INTO asiakas (etunimi, sukunimi, puhnro, sposti, osoite, postinro, postitmp)
  VALUES ('" .
    filter_var($etunimi, FILTER_SANITIZE_STRING) . "','" .
    filter_var($sukunimi, FILTER_SANITIZE_STRING) . "','" .
    filter_var($puhnro, FILTER_SANITIZE_STRING) . "','" .
    filter_var($sposti, FILTER_SANITIZE_STRING) . "','" .
    filter_var($osoite, FILTER_SANITIZE_STRING) . "','" .
    filter_var($postinro, FILTER_SANITIZE_STRING) . "','" .
    filter_var($postitmp, FILTER_SANITIZE_STRING) . "')";

  $astunnus = executeInsert($db, $sql);
  header('HTTP/1.1 200 OK');
  $data = array('id' => $astunnus);
  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
