<?php


class Reserver
{
    private $conn;
    private $table = 'reserver';

    public $id;
    public $created_at;
    public $heure;
    public $user_id;


    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function read_reservation()
    {
        $query = 'SELECT *
          FROM
          ' . $this->table;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return  $stmt;
    }

    public function create_reservation()
    {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET created_at = :created_at, heure = :heure, user_id = :user_id';
        // Prepare statement
        $stmt = $this->conn->prepare($query);
        // Clean data
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));

        $this->heure = htmlspecialchars(strip_tags($this->heure));

        // Bind data

        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':heure', $this->heure);
        $stmt->bindParam(':user_id', $this->user_id);

        // Execute query
        if ($stmt->execute()) {
            return true;
        }
        // Print error if something goes wrong
        printf("Error: %s.\n", $stmt->error);
        return false;
    }



    public function read_single_reservation()
    {
        $query = 'SELECT 
          id,
          created_at,
          heure
          FROM 
             . $this->table . ';

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->created_at = $row['created_at'];
        $this->heure = $row['heure'];
    }


    public function update_reservation()
    {
        // Create query
        $query = 'UPDATE ' . $this->table . ' SET created_at = :created_at, heure = :heure  WHERE id = :id';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->heure = htmlspecialchars(strip_tags($this->heure));
        $this->id = htmlspecialchars(strip_tags($this->id));


        // Bind data
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':heure', $this->heure);
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
    public function delete_reservation()
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
