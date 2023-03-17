<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: *');


  include_once '../../config/DB.php';
  include_once '../../models/Reserver.php';

  // Instantiate DB & connect
  $database = new DB();
  $db = $database->connect();

  // Instantiate client object
  $client = new Reserver($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // var_dump($data);

  // Set ID to update
  $client->id = $data->id;

  // Delete post
  if($client->delete_reservation()) {
    echo json_encode(
      array('message' => 'Reservation Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Reservation Not Deleted')
    );
  }

