<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$db = null;

try {
  $db = openDb();
  $sql = "SELECT
  orders.id,
  orders.orderdate,
  customer.lastname, 
  customer.firstname,
  car.register
  FROM customer, car, orders, ordertable
  WHERE customer.id = car.customer_id
  AND customer.id = orders.customer_id
  AND orders.id = ordertable.orders_id";

  $show = $db->query($sql);

  $data = $show->fetchAll(PDO::FETCH_ASSOC);

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}