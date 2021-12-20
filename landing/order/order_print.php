<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$input = json_decode(file_get_contents('php://input'));

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
        tires.groovefl as tire_groovefl,
        tires.groovefr as tire_groovefr,
        tires.groovebl as tire_groovebl,
        tires.groovebr as tire_groovebr,
        orders.orderdate as order_date,
        services.service as service_title,
        warehouse.id as warehouse_id,
        shelf.id as shelf_id,
        slot.id as slot_id
        FROM customer, car, tires, services, orders, orderline, slot_order, slot, shelf, warehouse
        WHERE orders.id = :order_id
        AND orders.customer_id = customer.id
        AND orderline.orders_id = orders.id
        AND orderline.id = slot_order.orderline_id
        AND orderline.services_id = services.id
        AND orderline.tires_id = tires.id
        AND tires.car_id = car.id
        AND slot_order.slot_id = slot.id
        AND slot.shelf_id = shelf.id
        AND shelf.warehouse_id = warehouse.id";

    $order = $db->prepare($sql);
    $order->bindValue(":order_id", $order_id, PDO::PARAM_INT);
    $order->execute();

    $data['orderdata'] = $order->fetchAll(PDO::FETCH_ASSOC);

    $office_id = 1;
    $office = $db->prepare("select * from office where id = :office_id");
    $office->bindValue(":office_id", $office_id, PDO::PARAM_INT);
    $office->execute();

    $data['office'] = $office->fetchAll(PDO::FETCH_ASSOC);

    header('HTTP/1.1 200 OK');
    
    echo json_encode($data);
} catch (PDOException $pdoex) {
    returnError($pdoex);
}