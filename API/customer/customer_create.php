<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$db = null;

// Get raw posted data
$input = json_decode(file_get_contents("php://input"));

$etunimi = filter_var($input->etunimi, FILTER_SANITIZE_STRING);
$sukunimi = filter_var($input->sukunimi, FILTER_SANITIZE_STRING);
$puhnro = filter_var($input->puhnro, FILTER_SANITIZE_STRING);
$sposti = filter_var($input->sposti, FILTER_SANITIZE_STRING);
$osoite = filter_var($input->osoite, FILTER_SANITIZE_STRING);
$postinro = filter_var($input->postinro, FILTER_SANITIZE_NUMBER_INT);
$postitmp = filter_var($input->postitmp, FILTER_SANITIZE_STRING);


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
