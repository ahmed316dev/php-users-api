<?php
    class User {
        // DB stuff
        private $conn;
        private $table='users';


        // User Properties
        public $id;
        public $name;
        public $email;
        public $phone;
        public $address;


        // Constructor with DB

        public function __construct($db){
            $this->conn = $db;
        }


        // Get Users
        public function read() {
            // Create Query

            $query = 'SELECT 
            id,
            name,
            email,
            phone,
            address
        FROM 
            ' . $this->table . '';

        // Prepare Statement

        $stmt = $this->conn->prepare($query);

        // Execute query

        $stmt->execute();

        return $stmt;
        }


        // Create User
        public function create() {
            // Create query 
            $query = 'INSERT INTO ' . 
                $this->table . '
            SET
                name = :name,
                email = :email,
                phone = :phone,
                address = :address';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean data

            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->phone = htmlspecialchars(strip_tags($this->phone));
            $this->address = htmlspecialchars(strip_tags($this->address));

            // Bind data

            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':address', $this->address);

            // Execute query
            if($stmt->execute()){
                return true;
            } else {

                // Print error if something goes wrong

                printf("Error: %s.\n", $stmt->error);

                return false;
            }




        }


        // Update User
        public function update() {
            // Create query 
            $query = 'UPDATE ' . 
                $this->table . '
            SET
                name = :name,
                email = :email,
                phone = :phone,
                address = :address
            WHERE
                id=:id';

            // Prepare Statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->phone = htmlspecialchars(strip_tags($this->phone));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':phone', $this->phone);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':id', $this->id);
            
            // Execute query
            if($stmt->execute()){
                return true;
            } else {
                
                // Print error if something goes wrong
                
                printf("Error: %s.\n", $stmt->error);
                
                return false;
            }
            
            
            
            
        }
        
        // Delete User
        
        public function delete() {
            // Create 
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
            
            // Prepare Statement
            $stmt = $this->conn->prepare($query);
            
            // Clean ID
            $this->id = htmlspecialchars(strip_tags($this->id));
            
            // Bind ID
            $stmt->bindParam(':id', $this->id);
            
             // Execute query
             if($stmt->execute()){
                return true;
            } else {
                
                // Print error if something goes wrong
                
                printf("Error: %s.\n", $stmt->error);
                
                return false;
            }
            
        }
        
    }