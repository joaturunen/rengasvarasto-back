<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$input = json_decode(file_get_contents('php://input'));

$order_id = filter_var($input->order_id, FILTER_SANITIZE_NUMBER_INT);

try {

    // $show = $db->prepare("SELECT * FROM car WHERE customer_id = :id");

    // $show->bindValue(":id", $id, PDO::PARAM_INT);

    // $show->execute();
    // $data = $show->fetchAll(PDO::FETCH_ASSOC);

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
        tire.brand as tire_brand,
        tire.model as tire_model,
        tire.type as tire_type,
        tire.hubcups as tire_hubcups,
        tire.rims as tire_rims,
        tire.tirebolt as tire_tirebolt, 

        "

} catch (PDOException $pdoex) {
    $db->rollback();
    returnError($pdoex);
}