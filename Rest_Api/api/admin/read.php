<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/DB.php';
include_once '../../models/Holidays.php';


$database = new DB();
$db = $database->connect();

$reserver = new Holidays($db);

$result = $reserver->read();
$num = $result->rowCount();

if($num > 0) {
    $reservation_arr = array();
    $reservation_arr['data'] = $result->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($reservation_arr);

} else {

    echo json_encode(
        array('message' => 'No Holidays Found')
    );
}