<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/DB.php';
  include_once '../../models/Client.php';

  // Instantiate DB & connect
  $database = new DB();
  $db = $database->connect();

  // Instantiate blog post object
  $client = new Client($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $client->id = $data->id;

  $client->nom = $data->nom;
  $client->prenom = $data->prenom;
  $client->numtele = $data->numtele;
  $client->numtele = $data->reff;
  $client->cat_id = $data->cat_id;

  // Update post
  if($client->update()) {
    echo json_encode(
      array('message' => 'Client Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Client Not Updated')
    );
  }

