<?php
// Headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

if (strtolower($_SERVER['REQUEST_METHOD']) === 'post') {

  include_once '../../config/DB.php';
  include_once '../../models/Client.php';

  // Instantiate DB & connect
  $database = new DB();
  $db = $database->connect();

  // Instantiate admin object
  $admin = new Client($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  if ($data) {
    $admin->email = $data->email;
    $admin->password = $data->password;

    // Authenticate admin
    $auth_result = $admin->authenticate();
    $result = $auth_result['result'];

    $msg = $auth_result['message'];

    if ($result) {
      // Generate JWT
      $token = uniqid();


      
      // Set response code
      http_response_code(200);

      // Return data
      echo json_encode(
        array(
          'message' => 'Client authenticated successfully',
          'token' => $token,
          'user_id' => $auth_result['id'],
        )
      );
    } else {
      // Set response code
      http_response_code(401);

      // Return data
      echo json_encode(
        array(
          'message' => $auth_result['message']
        )
      );
    }
  } else {
    // Set response code
    http_response_code(400);

    // Return data
    echo json_encode(
      array(
        'message' => 'Invalid request data'
      )
    );
  }
}
