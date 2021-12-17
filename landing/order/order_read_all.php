<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

try {
  $db = openDb();
  $sql = "SELECT
    orders.id,
    customer.firstname as customer_firstname,
    customer.lastname as customer_lastname,
    car.register as car_register,
    orders.orderdate
    FROM customer, car, tires, orders, orderline
    WHERE customer.id = orders.customer_id
    AND customer.id = car.customer_id
    AND car.id = tires.car_id
    AND orderline.orders_id = orders.id
    AND tires.id = orderline.tires_id";

  $show = $db->query($sql);

  $data = $show->fetchAll(PDO::FETCH_ASSOC);

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
