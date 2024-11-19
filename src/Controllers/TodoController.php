<?php
namespace App\Controllers;

class TodoController {
    public function index() {
        // Récupérer les tâches depuis la session
        if(!isset($_SESSION)){
            session_start(); //Récupérer la session existante
        }
        $todos = $_SESSION["Todos"] ?? []; # Opérateur de coalescence des null.
        // Charger la vue "Views/index.php";
        // require __DIR__."/../Views/index.php";

        require dirname(__DIR__)."/Views/index.php";
    }

    public function create() {
        // Charger la vue add.php
        require dirname(__DIR__)."/Views/add.php";
    }

    public function store() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $task = trim($_POST["task"]);
            if($task){
                $_SESSION['Todos'][] = [
                    'id' => uniqid('todo_'),
                    'task' => $task,
                    'done' => false
                ];
            }
            header('Location: /');
            exit;
        }

    }

    public function delete(){

        $id = $_GET['id'] ?? null;
            if($id){
                $_SESSION['Todos'] = array_filter($_SESSION['Todos'], function($todo) use ($id) {
                    return $todo['id'] !== $id;
                });
            }
        header('Location: /');
        exit;
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if($id){
            foreach ($_SESSION['Todos'] as &$todo) {
                if($todo['id'] === $id){
                    $todoItem = $todo;
                }
            }
            require dirname(__DIR__)."/Views/edit.php";
        }
    }
    public function update() {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_GET['id'] ?? null;
            if($id){
                foreach ($_SESSION['Todos'] as &$todo) {
                    if($todo['id'] === $id){
                        $todo['task'] = $_POST['task'];
                    }
                }
            }
            header('Location: /');
            exit;
        }
    }

    public function toggle() {
        $id = $_GET['id'] ?? null;
        if($id){
            foreach ($_SESSION['Todos'] as &$todo) {
                if($todo['id'] === $id){
                    $todo['done'] = !$todo['done'];
                }
            }
        }
        header('Location: /');
        exit;
    }
}