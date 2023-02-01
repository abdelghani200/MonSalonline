<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/DB.php';
  include_once '../../models/Client.php';

  // Instantiate DB & connect
  $database = new DB();
  $db = $database->connect();

  // Instantiate client object
  $client = new Client($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $client->id = $data->id;

  // Delete post
  if($client->delete()) {
    echo json_encode(
      array('message' => 'Client Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'Client Not Deleted')
    );
  }

