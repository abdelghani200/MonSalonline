<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
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

  $client->nom = $data->nom;
  $client->prenom = $data->prenom;
  $client->numtele = $data->numtele;
  $client->cat_id = $data->cat_id;

  // Create client
  if($client->create()) {
    echo json_encode(
      array('message' => 'client Created')
    );
  } else {
    echo json_encode(
      array('message' => 'client Not Created')
    );
  }

