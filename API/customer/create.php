<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

include_once '../../config/Database.php';
include_once '../../models/Customer.php';

try {
  //instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  $db->beginTransaction();

  // Instantiate customer object
  $customer = new Customer($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  $customer->etunimi = filter_var($data->etunimi, FILTER_SANITIZE_STRING);
  $customer->sukunimi = filter_var($data->sukunimi, FILTER_SANITIZE_STRING);
  $customer->puhnro = filter_var($data->puhnro, FILTER_SANITIZE_STRING);
  $customer->sposti = filter_var($data->sposti, FILTER_SANITIZE_STRING);
  $customer->osoite = filter_var($data->osoite, FILTER_SANITIZE_STRING);
  $customer->postinro = filter_var($data->postinro, FILTER_SANITIZE_NUMBER_INT);
  $customer->postitmp = filter_var($data->postitmp, FILTER_SANITIZE_STRING);

  // Create customer
  if ($customer->create()) {
    echo json_encode(
      array('message' => 'Asiakas tallennettu.')
    );
  }
} catch (PDOException $pdoex) {
  $db->rollback();
  returnError($pdoex);
}
