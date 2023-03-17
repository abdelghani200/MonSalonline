<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/DB.php';
include_once '../../models/Reserver.php';


$database = new DB();
$db = $database->connect();

$read_reservation = new Reserver($db);

$read_reservation->id = isset($_GET['id']) ? $_GET['id']  : die();

$read_reservation->read_single_reservation();

$read_arr =array(
    'id' => $read_reservation->id,
    'cat_id' => $read_reservation->created_at
);

print_r(json_encode($read_arr));