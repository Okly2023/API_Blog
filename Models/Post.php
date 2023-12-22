<?php

// Enforce strict typing mode
declare(strict_types=1);

// Define the namespace for this class
namespace App\Models;

// Import the Database class from the App\utils namespace
use App\utils\Database;

// Import the PDO class from the global namespace
use PDO;

// Define a class named Post
class Post
{
    // Define a method named getAllPosts
    public function getAllPosts()
    {
        // Create a new instance of the Database class
        $pdo = new Database();
        // Call the getConnection method on the Database instance to get a PDO connection
        $conn = $pdo->getConnection();
        // Define a SQL query to select all records from the posts table
        $sql = "SELECT * FROM posts";
        // Prepare the SQL query
        $stmt = $conn->prepare($sql);
        // Execute the SQL query
        $stmt->execute();
        // Fetch all the results as an associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Return the results
        return $result;
    }
    
}