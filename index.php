
<?php

require __DIR__ . '/vendor/autoload.php';

use App\Controllers\PostController;

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
        // Verif if id is set
     
       // (new PostController())->show($result['id']);
        break;
}
?>
