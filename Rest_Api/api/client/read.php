<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/DB.php';
include_once '../../models/Client.php';


$database = new DB();
$db = $database->connect();

$client = new Client($db);

$result = $client->read();

$num = $result->rowCount();

if($num > 0) {
    $clients_arr = array();
    $clients_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $client_item = array(
            'id' => $id,
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'numtele' => $numtele,
            'created_at' => $created_at,
            'heure' => $heure
            
        );

        array_push($clients_arr['data'],$client_item);
    }

    echo json_encode($clients_arr);

} else {

    echo json_encode(
        array('message' => 'No Clients Found')
    );
}