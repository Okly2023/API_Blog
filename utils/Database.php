<?php
// Define a namespace for the Database class
namespace App\Utils;
// Import the PDO and PDOException classes
use PDO;
use PDOException;

// Define a class named Database
class Database {
    // Define private properties for the database host, name, username, and password
    private $host = "localhost";
    private $db_name = "Blog";
    private $username = "root";
    private $password = "root";
    public $conn;

    // Define a method named getConnection
    public function getConnection() {
        // Set the connection property to null
        $this->conn = null;

        // Try to establish a connection to the database
        try {
            // Create a new PDO instance, passing the database host, name, username, and password
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            // If the connection is successful, print a success message
           // echo "Connection successful!";
        } catch(PDOException $exception) {
            // If there's an error, catch the exception and print an error message
            echo "Connection error: " . $exception->getMessage();
        }

        // Return the connection
        return $this->conn;
    }
}

// Create a new instance of the Database class
//$db = new Database();
// Call the getConnection method on the Database instance
//$db->getConnection();