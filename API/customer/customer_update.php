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
$id = filter_var($input->id, FILTER_SANITIZE_NUMBER_INT);

try {
  $db = openDb();
  $update = $db->prepare("UPDATE asiakas SET 
            etunimi = :etunimi,
            sukunimi = :sukunimi,
            puhnro = :puhnro,
            sposti = :sposti,
            osoite = :osoite,
            postinro = :postinro,
            postitmp = :postitmp 
          WHERE id = :id");

  $update->bindValue(":etunimi", $etunimi, PDO::PARAM_STR);
  $update->bindValue(":sukunimi", $sukunimi, PDO::PARAM_STR);
  $update->bindValue(":puhnro", $puhnro, PDO::PARAM_STR);
  $update->bindValue(":sposti", $sposti, PDO::PARAM_STR);
  $update->bindValue(":osoite", $osoite, PDO::PARAM_STR);
  $update->bindValue(":postinro", $postinro, PDO::PARAM_STR);
  $update->bindValue(":postitmp", $postitmp, PDO::PARAM_STR);
  $update->bindValue(":id", $id, PDO::PARAM_INT);

  $update->execute();

  header('HTTP/1.1 200 OK');
  $data = array('id' => $id);
  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
