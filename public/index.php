<?php

use App\Controllers\TodoController;
use App\Router;
require __DIR__."/../vendor/autoload.php";

// Démarrer la session
if(!isset($_SESSION)){
    session_start();
}

// Créer une instance du router 
$router = new Router();

// Créer une instance de controlleur 
$todoController = new TodoController();

// Enregistre les routes de l'application
$router->get("/", [$todoController, 'index']);
$router->get("/add", [$todoController, 'store']);
$router->post("/add", [$todoController, 'store']);
$router->get("/toggle", [$todoController, 'toggle']);
$router->update("/update", [$todoController, 'update']);
$router->delete("/delete", [$todoController, 'delete']);

// Résoudre la route correspondante
$router->resolve();