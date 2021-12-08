<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$db = null;

$input = json_decode(file_get_contents('php://input'));

$cus_id = intval(filter_var($input->cus_id, FILTER_SANITIZE_NUMBER_INT));
$employee_id = intval(filter_var($input->employee_id, FILTER_SANITIZE_NUMBER_INT));
$cart = $input->cart;

try {
    $db = openDb();
    $db->beginTransaction();

    $sql = "INSERT INTO orders (cus_id) 
        VALUES ('". 
            filter_var($cus_id,FILTER_SANITIZE_NUMBER_INT) . "','" .
            filter_var($employee_id,FILTER_SANITIZE_NUMBER_INT) ."')";
    $order_id = executeInsert($db,$sql);

    foreach ($cart as $services) {
        $sql = "INSERT INTO ordertable (order_id, service_id)
            VALUES (" . $order_id . "," . $services->id .")";
        executeInsert($db, $sql);
    }

    $db->commit();

    header('HTTP/1.1 200 OK');
    $data = array('id' => $astunnus);
    echo json_encode($data);
}
catch (PDOException $pdoex) {
    $db->rollback();
    returnError($pdoex);
}