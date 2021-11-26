<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

$db = null;

$input = json_decode(file_get_contents("php://input"));
$office_nro = filter_var($input->office_nro, FILTER_SANITIZE_NUMBER_INT);
$warehouse_name = filter_var($input->warehouse_name, FILTER_SANITIZE_STRING);
// try {
//   $db = openDb();
//   $show = $db->prepare("INSERT INTO warehouse(:warehouse_name)");

//   $show->execute();
//   $data = $show->fetchAll(PDO::FETCH_ASSOC);


//   $warehouse_id = executeInsert($db, $sql);
//   header('HTTP/1.1 200 OK');
//   $data = array('id' => $warehouse_id);
//   echo json_encode($data);
// } catch (PDOException $pdoex) {
//   returnError($pdoex);
// }
$data = array('id' => "Varasto luotu oikein!");
echo json_encode($data);
