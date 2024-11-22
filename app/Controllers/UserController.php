<?php
namespace App\Controllers;

use App\Models\User;

class UserController extends Controller
{
    private User $user;

    public function __construct(){
        $this->user = new User();
    }

    public function loginView(){
        $this->view("Auth/login");
    }
    public function registerView(){
        $this->view("Auth/register");
    }
}