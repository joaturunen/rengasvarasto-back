<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Customer.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate customer object
$customer = new Customer($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$customer->etunimi = $data->etunimi;
$customer->sukunimi = $data->sukunimi;
$customer->puhnro = $data->puhnro;
$customer->sposti = $data->sposti;
$customer->osoite = $data->osoite;
$customer->postinro = $data->postinro;
$customer->postitmp = $data->postitmp;

// Create customer
if ($customer->create()) {
  echo json_encode(
    array('message' => 'Asiakas tallennettu.')
  );
} else {
  echo json_encode(
    array('message' => 'Asiakkaan tallennus epäonnistui.')
  );
}
