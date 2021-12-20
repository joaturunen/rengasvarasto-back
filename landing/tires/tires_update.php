<?php
require_once '../../inc/headers.php';
require_once '../../inc/functions.php';

// Get raw posted data
$input = json_decode(file_get_contents('php://input'));

$id = filter_var($input->id, FILTER_SANITIZE_NUMBER_INT);
$brand = filter_var($input->brand, FILTER_SANITIZE_STRING);
$model = filter_var($input->model, FILTER_SANITIZE_STRING);
$type = filter_var($input->type, FILTER_SANITIZE_STRING);
$hubcups = filter_var($input->hubcups, FILTER_SANITIZE_STRING);
$groovefl = filter_var($input->groovefl, FILTER_SANITIZE_STRING);
$groovefr = filter_var($input->groovefr, FILTER_SANITIZE_STRING);
$groovebl = filter_var($input->groovebl, FILTER_SANITIZE_STRING);
$groovebr = filter_var($input->groovebr, FILTER_SANITIZE_STRING);
$tiresize = filter_var($input->tiresize, FILTER_SANITIZE_STRING);
$tirebolt = filter_var($input->tirebolt, FILTER_SANITIZE_STRING);
$text = filter_var($input->text, FILTER_SANITIZE_STRING);
$rims = filter_var($input->rims, FILTER_SANITIZE_STRING);




try {
  //instantiate DB & connect
    $db = openDb();

    // Create query
    $sql = "UPDATE tires 
        SET brand = :brand, 
            model = :model,
            type = :type,
            hubcups = :hubcups,
            groovefl = :groovefl,
            groovefr = :groovefr,
            groovebl = :groovebl,
            groovebr = :groovebr,
            tiresize = :tiresize,
            tirebolt = :tirebolt,
            text = :text,
            rims = :rims
        WHERE id = :id";

    $update = $db->prepare($sql);

    $update->bindValue(":id", $id, PDO::PARAM_INT);
    $update->bindValue(":brand", $brand, PDO::PARAM_STR);
    $update->bindValue(":model", $model, PDO::PARAM_STR);
    $update->bindValue(":type", $type, PDO::PARAM_STR);
    $update->bindValue(":hubcups", $hubcups, PDO::PARAM_STR);
    $update->bindValue(":groovefl", $groovefl, PDO::PARAM_STR);
    $update->bindValue(":groovefr", $groovefr, PDO::PARAM_STR);
    $update->bindValue(":groovebl", $groovebl, PDO::PARAM_STR);
    $update->bindValue(":groovebr", $groovebr, PDO::PARAM_STR);
    $update->bindValue(":tiresize", $tiresize, PDO::PARAM_STR);
    $update->bindValue(":tirebolt", $tirebolt, PDO::PARAM_STR);
    $update->bindValue(":text", $text, PDO::PARAM_STR);
    $update->bindValue(":rims", $rims, PDO::PARAM_STR);

    $update->execute();

    header('HTTP/1.1 200 OK');
    $data = array('id' => $id, 
        'car_id' => $car_id, 
        'brand' => $brand, 
        'model' => $model, 
        'type' => $type, 
        'hubcups' => $hubcups,
        'groovefl' => $groovefl, 
        'groovefr' => $groovefr, 
        'groovebl' => $groovebl, 
        'groovebr' => $groovebr, 
        'tiresize' => $tiresize, 
        'tirebolt' => $tirebolt, 
        'text' => $text, 
        'rims' => $rims);

    echo json_encode($data);
} catch (PDOException $pdoex) {
    returnError($pdoex);
}
