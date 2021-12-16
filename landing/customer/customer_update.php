<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

// Get raw posted data
$input = json_decode(file_get_contents("php://input"));

$firstname = filter_var($input->firstname, FILTER_SANITIZE_STRING);
$lastname = filter_var($input->lastname, FILTER_SANITIZE_STRING);
$phone = filter_var($input->phone, FILTER_SANITIZE_STRING);
$email = filter_var($input->email, FILTER_SANITIZE_STRING);
$address = filter_var($input->address, FILTER_SANITIZE_STRING);
$zipcode = filter_var($input->zipcode, FILTER_SANITIZE_NUMBER_INT);
$city = filter_var($input->city, FILTER_SANITIZE_STRING);
$id = filter_var($input->id, FILTER_SANITIZE_NUMBER_INT);

try {
  $db = openDb();
  $update = $db->prepare("UPDATE customer SET 
            firstname = :firstname,
            lastname = :lastname,
            phone = :phone,
            email = :email,
            address = :address,
            zipcode = :zipcode,
            city = :city 
          WHERE id = :id");

  $update->bindValue(":firstname", $firstname, PDO::PARAM_STR);
  $update->bindValue(":lastname", $lastname, PDO::PARAM_STR);
  $update->bindValue(":phone", $phone, PDO::PARAM_STR);
  $update->bindValue(":email", $email, PDO::PARAM_STR);
  $update->bindValue(":address", $address, PDO::PARAM_STR);
  $update->bindValue(":zipcode", $zipcode, PDO::PARAM_STR);
  $update->bindValue(":city", $city, PDO::PARAM_STR);
  $update->bindValue(":id", $id, PDO::PARAM_INT);

  $update->execute();

  header('HTTP/1.1 200 OK');
  $data = array('id' => $id);
  echo json_encode($data);
} catch (PDOException $pdoex) {
  returnError($pdoex);
}
