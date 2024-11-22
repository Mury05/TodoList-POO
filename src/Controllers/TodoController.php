<?php
namespace App\Controllers;

use App\Models\Todo;
use DB\Database;

class TodoController extends Controller
{
    private Todo $todoModel;
    public function __construct()
    {
        $this->todoModel = new Todo();
    }
    public function index()
    {
        $todos = $this->todoModel->all();

        // Charger la vue "Views/index.php";
        // require __DIR__."/../Views/index.php";

        $this->view("index", ["todos" => $todos] );
    }

    public function create()
    {
        // Charger la vue add.php
        $this->view("add");
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $task = trim($_POST["task"]);
            if ($task) {

                $this->todoModel->create($task);
            }
            $this->redirect("/");
        }

    }

    public function delete()
    {

        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->todoModel->delete($id);
        }
        $this->redirect("/");

    }

    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $todoItem = $this->todoModel->getOne($id);

            $this->view("edit", ["todoItem" => $todoItem]);

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
            $this->redirect("/");

        }
    }

    public function toggle()
    {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->todoModel->toggle($id);
        }
        $this->redirect("/");

    }
}