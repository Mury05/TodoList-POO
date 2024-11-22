<?php
namespace App\Controllers;

use App\Models\User;
use \Exception;
class UserController extends Controller
{
    private User $user;

    public function __construct()
    {
        $this->user = new User();
    }

    public function loginView()
    {
        $this->view("Auth/login");
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim(htmlspecialchars($_POST['email']));
            $password = trim(htmlspecialchars($_POST['password']));

            // Vérifie si les champs ne sont pas vides
            if (empty($email) || empty($password)) {
                throw new Exception("Nom d'utilisateur et mot de passe sont requis.");
            }

            // Récupérer l'user par son email
            $user = $this->user->getUserByEmail($email);

            var_dump($user);
            if (!$user) {
                throw new Exception("Nom d'utilisateur inexistant");
            }
            // Vérifie le mot de passe
            if (!password_verify($password, $user['user_password'])) {
                throw new Exception("Nom d'utilisateur ou mot de passe incorrect.");
            }

            // Démarrer la session
            if (!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['user'] = ["id" => $user['id'], "email" => $user['user_email'], "username" => $user['user_name']] ;

            echo "Connexion réussie. Bienvenue, " . htmlspecialchars($user['user_name']) . "!";
            $this->redirect('/');
        }
    }
    public function registerView()
    {
        $this->view("Auth/register");
    }

    public function register()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim(htmlspecialchars($_POST['username']));
            $email = trim(htmlspecialchars($_POST['email']));
            $password = trim(htmlspecialchars($_POST['password']));

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $msg = "L'email n'est pas valide.";

                $this->redirect('/register');
                // exit;

            }

            if ($this->user->getUserByEmail((string) $email)) {
                $msg = "L'email existe déjà.";
                $this->redirect('/register');

                // exit;
            }
            if ($this->user->getUserByName((string) $username)) {
                $msg = "Le nom d'utilisateur existe déjà.";
                $this->redirect('/register');


            }

            // Hachage du mot de passe 
            $passwordHashed = password_hash($password, PASSWORD_BCRYPT);

            $this->user->createUser($username, $email, $passwordHashed);
            $this->redirect('/login');

        }
    }
}