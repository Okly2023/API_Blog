<?php

// Enforce strict typing mode
declare(strict_types=1);

// Define the namespace for this class
namespace App\Models;

// Import the Database class from the App\utils namespace
use App\utils\Database;

// Import the PDO class from the global namespace
use PDO;

// Define a class named Author
class Author
{
    // Define a method named getAuthors
    public function getAuthors()
    {
        // Create a new instance of the Database class
        $pdo = new Database();
        // Call the getConnection method on the Database instance to get a PDO connection
        $conn = $pdo->getConnection();
        // Define a SQL query to select all records from the posts table
        $sql = "SELECT * FROM authors";
        // Prepare the SQL query
        $stmt = $conn->prepare($sql);
        // Execute the SQL query
        $stmt->execute();
        // Fetch all the results as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Return the results
        return $result;
    }

    // Define a method named getAuthorById, which takes an integer parameter named $id
    public function getAuthorById(int $id)
    {
        // Create a new instance of the Database class
        $pdo = new Database();
        // Call the getConnection method on the Database instance to get a PDO connection
        $conn = $pdo->getConnection();
        // Define a SQL query to select the record from the Author table and their deails where the id is equal to the provided id
        
            $sql = "SELECT authors.*, posts.title as article
                    FROM authors
                    LEFT JOIN posts ON posts.author_id = authors.id
                    WHERE authors.id = :id";
                   
     

        // Prepare the SQL query
        $stmt = $conn->prepare($sql);
        // Bind the value of the id parameter to the SQL query
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        // Execute the SQL query
        $stmt->execute();
        // Fetch the result as an associative array
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        // Return the result
        return $result;
    }
    public function addAuthor(string $name, string $email)
    {
        // Create a new instance of the Database class
        $pdo = new Database();
        // Call the getConnection method on the Database instance to get a PDO connection
        $conn = $pdo->getConnection();
        // Define a SQL query to insert a new record into the authors table
        $sql = "INSERT INTO authors (name, email) VALUES (:name, :email)";
        // Prepare the SQL query
        $stmt = $conn->prepare($sql);
        // Bind the values of the parameters to the SQL query
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        // Execute the SQL query
        $stmt->execute();
        // Return the ID of the inserted record
        return $conn->lastInsertId();
    }
}