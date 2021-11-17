<?php
ob_start();
session_start();

include_once '../../config/Database.php';

$tunnus = filter_input(INPUT_POST, 'tunnus', FILTER_SANITIZE_STRING);
$salasana = filter_input(INPUT_POST, 'salasana', FILTER_SANITIZE_STRING);

$sql = "select * from tyontekija where tunnus = '$tunnus'";

try {
    $database = new Database();
    $db = $database->connect();
    $query = $db->query($sql);
    $user = $query->fetch(PDO::FETCH_OBJ);
    if ($user) {
    $salasanaDb = $user->salasana;  
    if (password_verify($salasana, $salasanaDb)) {
        header('HTTP/1.1 200 OK');
        $data = array (
            'tunnus' => $user->tunnus,
            'salasana' => $user->salasana
        );
        $_SESSION['user'] = $user;
    } else {
        header('HTTP/1.1 401 Unauthorized');
        $data = array('message' => "Unsuccessfull login.");
      }
    } else {
      header('HTTP/1.1 401 Unauthorized');
      $data = array('message' => "Unsuccessfull login.");
    }
    
    echo json_encode($data);
} catch (PDOException $e) {
    returnError($e);
}
?>