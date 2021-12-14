<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

// Get raw posted data
$input = json_decode(file_get_contents('php://input'));

$car_id = intval(filter_var($input->car_id, FILTER_SANITIZE_NUMBER_INT));

try {
    $db = openDb();

    $tires_array = [];
    $tires = getTires($car_id);
        $tires_id = [];
        foreach ($tires as $tire) {
            array_push($tires_array, $tire);
        };
    
    $data['tires'] = $tires_array;

    header('HTTP/1.1 200 OK');

    echo json_encode($data);
} catch (PDOException $pdoex) {
    returnError($pdoex);
}
