<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$db = null;

try {
  $db = openDb();
  $sql = "SELECT customer.id as customer_id, orders.id, orders.orderdate, services.service 
        FROM customer, orders, ordertable, services
        WHERE customer.id = orders.customer_id AND
            orders.id = ordertable.orders_id AND
            ordertable.services_id = services.id";

  $show = $db->query($sql);

  $data = $show->fetchAll(PDO::FETCH_ASSOC);

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}