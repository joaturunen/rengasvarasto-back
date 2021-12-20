<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

try {
  $db = openDb();
  $sql = "SELECT
  orders.id,
  customer.id as customer_id,
  customer.firstname as customer_firstname,
  customer.lastname as customer_lastname,
  orders.orderdate
  FROM customer, orders
  WHERE customer.id = orders.customer_id";

  $show = $db->query($sql);

  $data = $show->fetchAll(PDO::FETCH_ASSOC);

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
