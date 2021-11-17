<?php
ob_start();
session_start();
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

include_once '../../config/Database.php';
include_once '../../models/Customer.php';

// Get raw posted data
$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);


//SQL for user
$sql = "select * from tyontekija where username = '$username'";

try {
  //instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  //Get data from DB
  $query = $db->query($sql);
  $user = $query->fetch(PDO::FETCH_OBJ);

  //Check user ok
  if ($user) {

    // User is ok
    $passwordDb = $user->salasana;

    //Check password ok
    if (password_verify($password, $passwordDb)) {
      //Password is ok
      header('HTTP/1.1 200 OK');
      $data = array(
        'username' => $user->username,
        'password' => $user->passworld
      );
      $_SESSION['user'] = $user;
    } else {
      //Wrong password
      header('HTTP/1.1 401 Unauthorized');
      $data = array('message' => "Unsuccessfull login.");
    }
  } else {
    //No user
    header('HTTP/1.1 401 Unauthorized');
    $data = array('message' => "Unsuccessfull login.");
  }

  echo json_encode($data);
} catch (PDOException $e) {
  returnError($e);
}
