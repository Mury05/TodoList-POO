<?php 

use App\Router;
require __DIR__."/../vendor/autoload.php";

// Démarrer la session
if(!isset($_SESSION)){
    session_start();
}

// Créer une instance du router 
$router = new Router();

$router->get("/", function() {});
$router->get("/add", function() {});
$router->post("/add", function() {});
$router->get("/toggle", function() {});
$router->update("/update", function() {});
$router->delete("/delete", function() {});

var_dump($router);