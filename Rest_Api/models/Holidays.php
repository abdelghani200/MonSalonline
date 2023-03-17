<?php

class Holidays
{
  private $conn;
  private $table = 'holidays';

  public $id;
  public $date_debut;
  public $date_fin;
  
  

  public function __construct($db,)
  {
    $this->conn = $db;
  }

  public function read()
  {

    $query = 'SELECT date_debut, date_fin FROM holidays ';

    $stmt = $this->conn->prepare($query);

    $stmt->execute();

    return  $stmt;
  }


  public function read_single()
  {
    $query = 'SELECT 
        id,
        date_debut,
        date_fin, ,
       
        
        FROM 
           . $this->table . ';

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(1, $this->id);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->date_debut = $row['date_debut'];
    $this->date_fin  = $row['date_fin'];
    

    // $this->nom = $row['nom'];
  }

  public function create()
  {
    // Create query
    $query = 'INSERT INTO ' . $this->table . ' SET date_debut = :date_debut, date_fin = :date_fin ';
    // Prepare statement
    $stmt = $this->conn->prepare($query);
    // Clean data
    $this->date_debut = htmlspecialchars(strip_tags($this->date_debut));
    $this->date_fin = htmlspecialchars(strip_tags($this->date_fin));

    // Bind data
    $stmt->bindParam(':date_debut', $this->date_debut);
    $stmt->bindParam(':date_fin', $this->date_fin);

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
    $query = 'UPDATE ' . $this->table . ' SET date_debut = :date_debut, date_fin = :date_fin,  WHERE id = :id';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->date_debut = htmlspecialchars(strip_tags($this->date_debut));
    $this->date_fin = htmlspecialchars(strip_tags($this->date_fin));
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind data
    $stmt->bindParam(':date_debut', $this->date_debut);
    $stmt->bindParam(':date_fin', $this->date_fin);
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


  
}
