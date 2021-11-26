<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

//$db = null;

$input = json_decode(file_get_contents('php://input'));
$searchCriteria = filter_var($input->searchCriteria, FILTER_SANITIZE_STRING);

// $url = parse_url(filter_input(INPUT_SERVER,'PATH_INFO'),PHP_URL_PATH);
// $parameters = explode('/',$url);
// $searchCriteria = $parameters[1];

try {
    $db = openDb();

    $sql = "SELECT * FROM car WHERE register = :searchCriteria";

    $search = $db->prepare($sql);

    $search->bindValue(":searchCriteria", $searchCriteria, PDO::PARAM_STR);

    $search->execute();
    $data = $search->fetch(PDO::FETCH_ASSOC);
  
    header('HTTP/1.1 200 OK');
  
    echo json_encode($data);

} catch (PDOException $pdoex) {
    returnError($pdoex);
}