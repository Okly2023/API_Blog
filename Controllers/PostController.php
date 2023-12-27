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

     // Define a method named Post, which takes a parameter named $id
     public function Post($id)
     {
         // Create a new instance of the Post class
         $post = new Post();
         // Call the getPostById method on the Post instance to get a post by its ID
         $post = $post->getPostById($id);
         // Set the Content-Type header to application/json
         header('Content-Type: application/json');
         // Output the post as a JSON string
         echo json_encode([
             'status' => 200,
             'message' => 'OK',
             'data' => $post
         ], JSON_PRETTY_PRINT);
     }    
     
     public function addArticle()
{
    // Get the request data
    $data = json_decode(file_get_contents('php://input'), true);
    // Create a new instance of the Post class
    $post = new Post();
    // Call the addArticle method on the Post instance to add a new article
    $post->addArticle($data['title'], $data['content'], $data['author_name'], $data['email'], $data['categories']);
    // Set the Content-Type header to application/json
    header('Content-Type: application/json');
    // Output a success message as a JSON string
    echo json_encode([
        'status' => 200,
        'message' => 'Article added successfully'
    ], JSON_PRETTY_PRINT);
}

}