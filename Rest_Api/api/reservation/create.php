<?php

session_start();

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {


  // Headers

  include_once '../../config/DB.php';
  include_once '../../models/Reserver.php';

  // Instantiate DB & connect
  $database = new DB();
  $db = $database->connect();


  // Instantiate blog post object

  $reserver = new Reserver($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Assign values to variables
  $reserver->created_at = $data->created_at;
  $reserver->heure = $data->heure;
  $reserver->user_id = $data->user_id;


  if ($reserver->create_reservation()) {
    echo json_encode(
      array('message' => 'reserver Created')
    );
  } else {
    echo json_encode(
      array('message' => 'reserver Not Created')
    );
  }
}
