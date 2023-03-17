<?php

class Admin
{
  private $conn;
  private $table = 'admin';

  public $id;
  public $email;
  public $password;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  

  public function authenticate()
  {
    $query = 'SELECT * FROM ' . $this->table . ' WHERE email = ?';

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->email);

    $stmt->execute();

    $num = $stmt->rowCount();

    if ($num == 1) {

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      $hashed_password = $row['password'];

      if (password_verify($this->password, $hashed_password)) {
        return array('result' => true, 'message' => 'Admin authenticated successfully');
      } else {
        return array('result' => false, 'message' => 'Invalid password');
      }

    } else {

      return array('result' => false, 'message' => 'Admin not found');
      
    }
  }


  
}
