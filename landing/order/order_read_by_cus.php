<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$input = json_decode(file_get_contents('php://input'));

$customer_id = intval(filter_var($input->customer_id, FILTER_SANITIZE_NUMBER_INT));

try {
    $db = openDb();

    $orders_array = [];
    $orders = getCusOrders($customer_id);
    $orders_id = [];
    foreach ($orders as $order) {
        array_push($orders_array, $order);
    };

    $data['orders'] = $orders_array;

    header('HTTP/1.1 200 OK');

    echo json_encode($data);
} catch (PDOException $pdoex) {
    returnError($pdoex);
}
