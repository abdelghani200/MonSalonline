<?php

class Client
{
  private $conn;
  private $table = 'clients';

  public $id;
  public $nom;
  public $prenom;
  public $numtele;
  public $email;
  public $password;


  public function __construct($db,)
  {
    $this->conn = $db;
  }

  public function read()
  {

    $query = 'SELECT c.id, c.nom, c.prenom, c.numtele, c.email, r.created_at, r.heure
    FROM clients c
    JOIN reserver r
    ON c.id = r.user_id
    ORDER BY r.created_at ASC
    ';
// ON c.id = r.user_id
    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return  $stmt;
  }


  public function read_single()
  {
    $query = 'SELECT 
        id,
        nom,
        prenom,
        numtele,
        
        FROM 
           . $this->table . ';

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->id);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->nom = $row['nom'];
    $this->prenom = $row['prenom'];
    $this->numtele = $row['numtele'];

    // $this->nom = $row['nom'];
  }

  public function create()
  {
    // Create query
    $query = 'INSERT INTO ' . $this->table . ' SET nom = :nom, prenom = :prenom, numtele = :numtele, email = :email, password = :password ';
    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Clean data
    $this->nom = htmlspecialchars(strip_tags($this->nom));
    $this->prenom = htmlspecialchars(strip_tags($this->prenom));
    $this->numtele = htmlspecialchars(strip_tags($this->numtele));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->password = htmlspecialchars(strip_tags($this->password));


    // Hash password 

    $hashed_password = password_hash($this->password, PASSWORD_DEFAULT);

    // Bind data
    $stmt->bindParam(':nom', $this->nom);
    $stmt->bindParam(':prenom', $this->prenom);
    $stmt->bindParam(':numtele', $this->numtele);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':password', $hashed_password);


    // Execute query
    if ($stmt->execute()) {
      return true;
    }
    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);
    return false;
  }

  // Update Post
  public function update()
  {
    // Create query
    $query = 'UPDATE ' . $this->table . ' SET nom = :nom, prenom = :prenom, numtele = :numtele, email =:email, password =:password, WHERE id = :id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->nom = htmlspecialchars(strip_tags($this->nom));
    $this->prenom = htmlspecialchars(strip_tags($this->prenom));
    $this->numtele = htmlspecialchars(strip_tags($this->numtele));
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->password = htmlspecialchars(strip_tags($this->password));
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':nom', $this->nom);
    $stmt->bindParam(':prenom', $this->prenom);
    $stmt->bindParam(':numtele', $this->numtele);
    $stmt->bindParam(':cat_id', $this->email);
    $stmt->bindParam(':cat_id', $this->password);
    $stmt->bindParam(':id', $this->id);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

  // Delete Post
  public function delete()
  {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':id', $this->id);

    // Execute query
    if ($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
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
        return array('result' => true, 'message' => 'Client authenticated successfully','id'=>$row['id']);
      } else {
        return array('result' => false, 'message' => 'Invalid password');
      }
    } else {

      return array('result' => false, 'message' => 'Client not found');
    }
  }
}
