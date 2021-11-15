<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Customer.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate customer object
$customer = new Customer($db);

// Get ID
$customer->id = isset($_GET['id']) ? $_GET['id'] : die();

// GET post
$customer->read_single();

$cust_arr = array(
  'etunimi' => $customer->etunimi,
  'sukunimi' => $customer->sukunimi
);

//Make JSON
print(json_encode($cust_arr));
