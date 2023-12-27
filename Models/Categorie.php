<?php


// Enforce strict typing mode
declare(strict_types=1);

// Define the namespace for this class
namespace App\Models;

// Import the Database class from the App\utils namespace
use App\utils\Database;

// Import the PDO class from the global namespace
use PDO;

// Define a class named categorie
class categorie
{
    public function getCategories()
    {
        $pdo = new Database();
        $conn = $pdo->getConnection();
        $sql = "SELECT * FROM categories";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getCategorieById(int $id)
    {
        $pdo = new Database();
        $conn = $pdo->getConnection();
        $sql = "SELECT categories.*, posts.title as article
                FROM categories
                LEFT JOIN posts ON posts.id = categories.post_id
                WHERE categories.id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    public function addCategorie(string $name)
    {
        $pdo = new Database();
        $conn = $pdo->getConnection();
        $sql = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();
    }
}