<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

try {
  $db = openDb();
  $sql = "SELECT
    DISTINCT ON (orders.id) orders_id,
    car.register as car_register,
    orders.orderdate
    FROM customer, car, orders, orderline, tires
    WHERE customer.id = orders.customer_id
    AND orderline.orders_id = orders.id
    AND tires.id = orderline.tires_id
    AND car.id = tires.car_id
    ORDER BY orders.id";

  $show = $db->query($sql);

  $data = $show->fetchAll(PDO::FETCH_ASSOC);

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
