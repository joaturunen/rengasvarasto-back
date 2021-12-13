<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

try {
  $db = openDb();
  $sql = "SELECT
  customer.id as customer_id,
  customer.firstname as customer_firstname,
  customer.lastname as customer_lastname,
  orders.id,
  orders.orderdate
  FROM customer, orders, ordertable
  WHERE customer.id = orders.customer_id
  AND orders.id = ordertable.orders_id";

  $show = $db->query($sql);

  $data = $show->fetchAll(PDO::FETCH_ASSOC);

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}