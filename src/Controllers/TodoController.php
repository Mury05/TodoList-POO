<?php
namespace App\Controllers;

use DB\Database;

class TodoController
{
    public function index()
    {
        // Récupérer l'instance de connexion à la bdd
        $db = Database::getInstance();

        // Récupérer les tâches depuis la BDD
        $query = $db->query("SELECT * FROM todos;"); //Prepare la requête
        $todos = $query->fetchAll(); // Retourne le résultat de l'éxécution de la requête

        // Charger la vue "Views/index.php";
        // require __DIR__."/../Views/index.php";

        require dirname(__DIR__) . "/Views/index.php";
    }

    public function create()
    {
        // Charger la vue add.php
        require dirname(__DIR__) . "/Views/add.php";
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = trim($_POST["task"]);
            if ($task) {

                // Récupérer l'instance de connexion à la bdd
                $db = Database::getInstance();
                //Prepare la requête SQL pour insérer une nouvelle tâche dans la table "todos".
                // Les placeholders `:task` et `:done` sont utilisés pour éviter les injections SQL.
                $stmt = $db->prepare("INSERT INTO todos (task, done) VALUES (:task, :done);");

                // Exécute la requête préparée avex les valeurs spécifiques fournies dans un tableau associatif
                // - `:task` contient la description de la tache saisie par l'utilisateur
                // - `:done` est initialisé à 0 (indique quand la tâche n'est pas encore terminée)
                $stmt->execute([":task" => $task, ":done" => 0]); //Exécute la requête
                //$stmt->execute(["task"=> $task, "done" => 0]); //On peut retirer les ':' des placeholders. C'est pareil !

            }
            header('Location: /');
            exit;
        }

    }

    public function delete()
    {

        $id = $_GET['id'] ?? null;
        if ($id) {
            // Récupérer l'instance de connexion à la bdd
            $db = Database::getInstance();

            $stmt = $db->prepare("DELETE FROM todos WHERE id = :id"); //$stmt pour prepared statement
            $stmt->execute(["id" => (int) $id]);
        }
        header('Location: /');
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {

            // Récupérer l'instance de connexion à la bdd
            $db = Database::getInstance();

            $query = $db->query("SELECT * FROM todos WHERE id = $id;"); //Prepare la requête
            $todoItem = $query->fetch();


            require dirname(__DIR__) . "/Views/edit.php";


        }
    }
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_GET['id'] ?? null;
            if ($id) {
                $task = trim($_POST['task']);
                if ($task) {
                    // Récupérer l'instance de connexion à la bdd
                    $db = Database::getInstance();

                    $stmt = $db->prepare("UPDATE todos SET task = :task WHERE id= :id");
                    $stmt->execute(["task" => $task, "id" => (int) $id]);

                }

            }
            header('Location: /');
            exit;
        }
    }

    public function toggle()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {

            // Récupérer l'instance de connexion à la bdd
            $db = Database::getInstance();

            $stmt = $db->prepare("UPDATE todos SET done = NOT done WHERE id= :id");
            $stmt->execute(["id" => (int) $id]);

        }
        header('Location: /');
        exit;
    }
}