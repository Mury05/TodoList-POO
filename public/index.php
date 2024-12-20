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
$router->get("/add", [$todoController, 'create']);
$router->post("/add", [$todoController, 'store']);
$router->get("/toggle", [$todoController, 'toggle']);
$router->get("/update", [$todoController, 'edit']);
$router->post("/update", [$todoController, 'update']);
$router->get("/delete", [$todoController, 'delete']);

// Résoudre la route correspondante
$router->resolve();