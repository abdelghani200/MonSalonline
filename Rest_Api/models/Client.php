<?php

class Client
{
  private $conn;
  private $table = 'clients';

  public $id;
  public $cat_id;
  public $nom;
  public $prenom;
  public $numtele;
  public $created_at;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function read()
  {
    $query = 'SELECT c.name as categorie_name,
        p.id,
        p.cat_id,
        p.nom,
        p.prenom,
        p.numtele,
        p.created_at
        FROM 
          ' . $this->table . ' p 
        LEFT JOIN 
          categorie c ON p.cat_id = c.id 
        ORDER BY 
          p.created_at DESC';

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return  $stmt;
  }


  public function read_single()
  {
    $query = 'SELECT c.name as categorie_name,
        p.id,
        p.cat_id,
        p.nom,
        p.prenom,
        p.numtele,
        p.created_at
        FROM 
          ' . $this->table . ' p 
        LEFT JOIN 
          categorie c ON p.cat_id = c.id 
        WHERE 
          p.id = ?
        LIMIT 0,1';

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->id);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->nom = $row['nom'];
    $this->prenom = $row['prenom'];
    $this->numtele = $row['numtele'];
    // $this->nom = $row['nom'];
    // $this->nom = $row['nom'];
  }

  public function create()
  {
    // Create query
    $query = 'INSERT INTO ' . $this->table . ' SET nom = :nom, prenom = :prenom, numtele = :numtele, cat_id = :cat_id';
    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Clean data
    $this->nom = htmlspecialchars(strip_tags($this->nom));
    $this->prenom = htmlspecialchars(strip_tags($this->prenom));
    $this->numtele = htmlspecialchars(strip_tags($this->numtele));
    $this->cat_id = htmlspecialchars(strip_tags($this->cat_id));


    // Bind data
    $stmt->bindParam(':nom', $this->nom);
    $stmt->bindParam(':prenom', $this->prenom);
    $stmt->bindParam(':numtele', $this->numtele);
    $stmt->bindParam(':cat_id', $this->cat_id);


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
    $query = 'UPDATE ' . $this->table . ' SET nom = :nom, prenom = :prenom, numtele = :numtele, cat_id = :cat_id WHERE id = :id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->nom = htmlspecialchars(strip_tags($this->nom));
    $this->prenom = htmlspecialchars(strip_tags($this->prenom));
    $this->numtele = htmlspecialchars(strip_tags($this->numtele));
    $this->cat_id = htmlspecialchars(strip_tags($this->cat_id));
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':nom', $this->nom);
    $stmt->bindParam(':prenom', $this->prenom);
    $stmt->bindParam(':numtele', $this->numtele);
    $stmt->bindParam(':cat_id', $this->cat_id);
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
  public function delete() {
    // Create query
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':id', $this->id);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
}


}
