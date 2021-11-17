<?php

require_once '../../inc/headers.php';

include_once '../../config/Database.php';
include_once '../../models/Customer.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate customer object
$customer = new Customer($db);

// Get ID
$customer->id = isset($_GET['id']) ? $_GET['id'] : die();

// GET customer
$customer->read_single();

//Make JSON
print(json_encode($customer));
