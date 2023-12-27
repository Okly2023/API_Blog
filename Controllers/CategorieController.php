<?php

// Define the namespace for this class
namespace App\Controllers;

// Import the Author class from the App\Models namespace
use App\Models\Categorie;

// Define a class named AuthorController
class CategorieController
{
    public function Categories()
    {
        $categorie = new Categorie();
        $categorie = $categorie->getCategories();
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 200,
            'message' => 'OK',
            'data' => $categorie
        ], JSON_PRETTY_PRINT);
    }
    public function Categorie($id)
    {
        $categorie = new Categorie();
        $categorie = $categorie->getCategorieById($id);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 200,
            'message' => 'OK',
            'data' => $categorie
        ], JSON_PRETTY_PRINT);
    }
    public function addCategorie()
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $categorie = new Categorie();
        $categorie->addCategorie($data['name']);
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 200,
            'message' => 'Categorie added successfully'
        ], JSON_PRETTY_PRINT);
    }
}