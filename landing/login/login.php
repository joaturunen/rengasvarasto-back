<?php
ob_start();
session_start();
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

// include_once '../../config/Database.php';
// include_once '../../models/Customer.php';

// Get raw posted data
$login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);


//SQL for user
$sql = "SELECT * FROM employee WHERE login = '$login'";

try {
  $db = openDb();
  //Get data from DB
  $query = $db->query($sql);
  $user = $query->fetch(PDO::FETCH_OBJ);

  //Check user ok
  if ($user) {

    // User is ok
    $passwordDb = $user->password;

    //Check password ok
    if (password_verify($password, $passwordDb)) {
      //Password is ok
      header('HTTP/1.1 200 OK');
      $data = array(
        'login' => $user->login,
        'password' => $user->password,
        'firstname' => $user->firstname,
        'lastname' => $uset->lastname
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
