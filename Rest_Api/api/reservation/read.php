<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/DB.php';
include_once '../../models/Reserver.php';


$database = new DB();
$db = $database->connect();

$reserver = new Reserver($db);

$result = $reserver->read_reservation();
$num = $result->rowCount();

if($num > 0) {
    $reservation_arr = array();
    $reservation_arr['data'] = $result->fetchAll(PDO::FETCH_ASSOC);
    // while($row = $result->fetch(PDO::FETCH_ASSOC)){
    //     extract($row);

    //     $reservation_item = array(
    //         'id' => $id,
    //         'created_at' => $created_at,
    //         'heure' => $heure
    //     );

    //     array_push($reservation_arr['data'],$reservation_item);
    // }

    echo json_encode($reservation_arr);

} else {

    echo json_encode(
        array('message' => 'No Clients Found')
    );
}