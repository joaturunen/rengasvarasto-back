<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

try {
  $db = openDb();
  $sql = "SELECT
    orders.id,
    car.register as car_register,
    orders.orderdate,
    orders.info
    FROM customer, car, tires, orders
    WHERE customer.id = orders.customer_id
    AND customer.id = car.customer_id
    AND car.id = tires.car_id
    AND tires.id = orders.tires_id";

  $show = $db->query($sql);

  $data = $show->fetchAll(PDO::FETCH_ASSOC);

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
