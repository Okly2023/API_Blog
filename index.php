<?php

require __DIR__ . '/vendor/autoload.php';

use App\Controllers\PostController;
use App\Controllers\AuthorController;
use App\Controllers\CategorieController;

$uri = $_SERVER['REQUEST_URI']; // return string

$url = parse_url($uri); // return array 

$result = [];
if (isset($url['query'])) {
    parse_str($url['query'], $result);
}

switch($url['path']) {
    case '/posts':
        (new PostController())->Posts();
        break;
    case '/post':
        // Verify if id is set
        if (isset($result['id'])) {
            $id = intval($result['id']);
            (new PostController())->Post($id);
        } else {
            echo "ID not provided";
        }
        break;
        case '/addPost':
            (new PostController())->AddArticle();
            break;
         case '/authors':
              (new AuthorController())->Authors();
             break;
         case '/author':
                // Verify if id is set
                if (isset($result['id'])) {
                    $id = intval($result['id']);
                    (new AuthorController())->authorID($id);
                } else {
                    echo "ID not provided";
                }
                break;
         case '/addAuthor':
                (new AuthorController())->addauthor();
                break; 

         case '/categories':
                (new CategorieController())->Categories();
                break;
         case '/categorie':
                // Verify if id is set
                if (isset($result['id'])) {
                    $id = intval($result['id']);
                    (new CategorieController())->Categorie($id);
                } else {
                    echo "ID not provided";
                }
                break;
         case '/addCategorie':
                    (new CategorieController())->addCategorie();
                    break;                   
    default:
        echo "Invalid route";
        break;
}
?>