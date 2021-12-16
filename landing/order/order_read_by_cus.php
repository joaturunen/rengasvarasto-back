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

//   $sql = "SELECT
//     orders.id,
//     car.register as car_register,
//     orders.orderdate
//     FROM customer, car, tires, orders
//     WHERE customer.id = orders.customer_id
//     AND customer.id = car.customer_id
//     AND car.id = tires.car_id
//     AND tires.id = orders.tires_id
//     AND customer.id = :customer_id";

//   $orders = $db->prepare($sql);

//   $orders->bindValue(":customer_id", $customer_id, PDO::PARAM_INT);

//   $orders->execute();
//   $data = $orders->fetchAll(PDO::FETCH_ASSOC);

    header('HTTP/1.1 200 OK');

    echo json_encode($data);
} catch (PDOException $pdoex) {
    returnError($pdoex);
}
