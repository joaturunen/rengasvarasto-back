<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$input = json_decode(file_get_contents('php://input'), true);

$order_id = filter_var($input->order_id, FILTER_SANITIZE_NUMBER_INT);

try {

    $db = openDb();

    $sql = "SELECT 
        customer.firstname as customer_firstname,
        customer.lastname as customer_lastname, 
        customer.phone as customer_phone,
        customer.email as customer_email,
        customer.address as customer_address,
        customer.zipcode as customer_zipcode,
        customer.city as customer_city,
        car.register as car_register,
        car.brand as car_brand,
        car.model as car_model,
        tires.brand as tire_brand,
        tires.model as tire_model,
        tires.type as tire_type,
        tires.hubcups as tire_hubcups,
        tires.rims as tire_rims,
        tires.tirebolt as tire_tirebolt, 
        orders.orderdate as order_date
        FROM customer, car, tires, orders
        WHERE orders.id = :order_id
        AND orders.customer_id = customer.id
        AND orders.tires_id = tires.id
        AND tires.car_id = car.id";

    $order = $db->prepare($sql);
    $order->bindValue(":order_id", $order_id, PDO::PARAM_INT);
    $order->execute();

    $data = $show->fetchAll(PDO::FETCH_ASSOC);

    header('HTTP/1.1 200 OK');
    $data = array(
        
    );
    echo json_encode($data);
} catch (PDOException $pdoex) {
    $db->rollback();
    returnError($pdoex);
}