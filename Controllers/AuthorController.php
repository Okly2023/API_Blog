<?php

// Define the namespace for this class
namespace App\Controllers;

// Import the Author class from the App\Models namespace
use App\Models\Author;

// Define a class named AuthorController
class AuthorController
{
    // Define a method named Authors
    public function Authors()
    {
        // Create a new instance of the Author class
        $author = new Author();
        // Call the getAuthors method on the Author instance to get all authors
        $author = $author->getAuthors();
        // Set the Content-Type header to application/json
        header('Content-Type: application/json');
        // Output the Authors as a JSON string
        echo json_encode([
            'status' => 200,
            'message' => 'OK',
            'data' => $author
        ], JSON_PRETTY_PRINT);
    }

    // Define a method named Author, which takes a parameter named $id
    public function authorID($id)
    {
        // Create a new instance of the Author class
        $author = new Author();
        // Call the getAuthorById method on the Post instance to get a post by its ID
        $author = $author->getAuthorById($id);
        // Set the Content-Type header to application/json
        header('Content-Type: application/json');
        // Output the author as a JSON string
        echo json_encode([
            'status' => 200,
            'message' => 'OK',
            'data' => $author
        ], JSON_PRETTY_PRINT);
    }   
    
    public function addauthor(){
        // Get the request data
        $data = json_decode(file_get_contents('php://input'), true);
        // Create a new instance of the Author class
        $author = new Author();
        // Call the addAuthor method on the Author instance to add a new author
        $author->addAuthor($data['name'], $data['email']);
        // Set the Content-Type header to application/json
        header('Content-Type: application/json');
        // Output a success message as a JSON string
        echo json_encode([
            'status' => 200,
            'message' => 'Author added successfully'
        ], JSON_PRETTY_PRINT);
    }
}