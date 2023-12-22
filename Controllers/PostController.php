<?php

// Define the namespace for this class
namespace App\Controllers;

// Import the Post class from the App\Models namespace
use App\Models\Post;

// Define a class named PostController
class PostController
{
    // Define a method named Posts
    public function Posts()
    {
        // Create a new instance of the Post class
        $posts = new Post();
        // Call the getAllPosts method on the Post instance to get all posts
        $posts = $posts->getAllPosts();
        // Set the Content-Type header to application/json
        header('Content-Type: application/json');
        // Output the posts as a JSON string
        echo json_encode([
            'status' => 200,
            'message' => 'OK',
            'data' => $posts
        ], JSON_PRETTY_PRINT);
    }

}