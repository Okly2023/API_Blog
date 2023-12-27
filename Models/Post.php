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

    // Define a method named getPostById, which takes an integer parameter named $id
    public function getPostById(int $id)
    {
        // Create a new instance of the Database class
        $pdo = new Database();
        // Call the getConnection method on the Database instance to get a PDO connection
        $conn = $pdo->getConnection();
        // Define a SQL query to select the record from the posts table and their deails where the id is equal to the provided id
        

        $sql = "SELECT posts.*, authors.name as author_name, GROUP_CONCAT(categories.name) as categorie
            FROM posts 
            INNER JOIN authors ON posts.author_id = authors.id 
            LEFT JOIN categories ON posts.id = categories.post_id  
            WHERE posts.id = :id 
            GROUP BY posts.id";

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

    public function addArticle(string $title, string $content, string $author_name, string $email, array $categories)
    {
        // Create a new instance of the Database class
        $pdo = new Database();
        // Call the getConnection method on the Database instance to get a PDO connection
        $conn = $pdo->getConnection();
    
        // First, check if the author already exists in the authors table
        $sql = "SELECT id FROM authors WHERE name = :name AND email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':name', $author_name, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $author = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // If the author exists, use their existing author_id
        // If not, insert them as a new author and use the new author_id
        $author_id = $author ? $author['id'] : null;
        if (!$author_id) {
            $sql = "INSERT INTO authors (name, email) VALUES (:name, :email)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':name', $author_name, PDO::PARAM_STR);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $author_id = $conn->lastInsertId();
        }
    
    
        // Next, insert the new post into the posts table
        $sql = "INSERT INTO posts (title, content, author_id) VALUES (:title, :content, :author_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':author_id', $author_id, PDO::PARAM_INT);
        $stmt->execute();
        $post_id = $conn->lastInsertId();
    
        // For each category provided, insert a new record into the categories table
        foreach ($categories as $category_name) {
            $sql = "INSERT INTO categories (name, post_id) VALUES (:name, :post_id)";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':name', $category_name, PDO::PARAM_STR);
            $stmt->bindValue(':post_id', $post_id, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
    
}