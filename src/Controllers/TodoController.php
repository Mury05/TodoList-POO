<?php
namespace App\Controllers;

class TodoController {
    public function index() {
        // Récupérer les tâches depuis la session
        if(!isset($_SESSION)){
            session_start(); //Récupérer la session existante

        }
        $todos = $_SESSION["Todos"];
        // Charger la vue "Views/index.php"
        // require __DIR__."/../Views/index.php";
        require dirname(__DIR__)."/Views/index.php";
    }

    public function store() {

    }

    public function delete(){

    }

    public function update($id) {

    }

    public function toggle() {

    }
}