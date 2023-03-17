<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/DB.php';
  include_once '../../models/Reserver.php';

  // Instantiate DB & connect
  $database = new DB();
  $db = $database->connect();

  // Instantiate blog post object
  $reservation = new Reserver($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $reservation->id = $data->id;
  $reservation->created_at = $data->created_at;
  $reservation->heure = $data->heure;
  // $client->cat_id = $data->cat_id;

  // Update post
  if($reservation->update_reservation()) {
    echo json_encode(
      array('message' => 'Client Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Client Not Updated')
    );
  }

