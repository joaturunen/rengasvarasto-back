<?php
require_once '../../../inc/headers.php';
require_once '../../../inc/functions.php';

try {
  $data = getShelfs();

  header('HTTP/1.1 200 OK');

  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
