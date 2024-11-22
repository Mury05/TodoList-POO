<?php
namespace App\Models;

class User extends Model{
    
    /**
     * Récupère un user par son email
     * @param string $email Email de l'utilisateur
     * @return mixed
     */
    public function getUserByEmail(string $email){
        $query = $this->db->query("SELECT * FROM users WHERE user_email = '$email';");
        return $query->fetch();
    }

    /**
     * Récupère un user par son email
     * @param string $email Email de l'utilisateur
     * @return mixed
     */
    public function getUserByName(string $name){
        $query = $this->db->query("SELECT * FROM users WHERE user_name = '$name';");
        return $query->fetch();
    }

    /**
     * Crée un utilisateur dans la bdd
     * @param mixed $username Le nom d'utilisateur
     * @param mixed $email L'email de l'utilisateur
     * @param mixed $hashPassword Le password haché de l'utilisateur
     * @return bool
     */
    public function createUser($username, $email, $hashPassword){
        $stmt = $this->db->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (:username, :email, :password)");

       return $stmt->execute([":username" => $username, ":email"=> $email, ":password" => $hashPassword]);
    }

    public function loginUser($email, $password){
        $query = $this->db->query("SELECT * FROM users WHERE user_email = '$email' AND user_password = ;");
        return $query->fetch();
    }
}