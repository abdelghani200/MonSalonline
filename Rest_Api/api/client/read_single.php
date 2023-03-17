<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/DB.php';
include_once '../../models/Client.php';


$database = new DB();
$db = $database->connect();

$client = new Client($db);

$client->id = isset($_GET['id']) ? $_GET['id']  : die();

$client->read_single();

$client_arr =array(
    'id' => $client->id,
    'nom' => $client->nom,
    'prenom' => $client->prenom,
    'numtele' => $client->numtele
);

print_r(json_encode($client_arr));