<?php


header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {


  // Headers

  include_once '../../config/DB.php';
  include_once '../../models/Holidays.php';

  // Instantiate DB & connect
  $database = new DB();
  $db = $database->connect();


  // Instantiate blog post object

  $reserver = new Holidays($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Assign values to variables
  $reserver->date_debut = $data->date_debut;
  $reserver->date_fin = $data->date_fin;


  if ($reserver->create()) {
    echo json_encode(
      array('message' => 'holiday Created')
    );
  } else {
    echo json_encode(
      array('message' => 'holiday Not Created')
    );
  }
}
