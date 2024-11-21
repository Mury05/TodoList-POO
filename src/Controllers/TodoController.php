<?php
namespace App\Controllers;

use App\Models\Todo;
use DB\Database;

class TodoController
{
    private Todo $todoModel;
    public function __construct(){
        $this->todoModel = new Todo();
    }
    public function index()
    {
        $todos = $this->todoModel->all();

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

              $this->todoModel->create($task);
            }
            header('Location: /');
            exit;
        }

    }

    public function delete()
    {

        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->todoModel->delete($id);
        }
        header('Location: /');
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $todoItem = $this->todoModel->getOne($id);

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
                   $this->todoModel->update($id, $task);
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
            $this->todoModel->toggle($id);
        }
        header('Location: /');
        exit;
    }
}