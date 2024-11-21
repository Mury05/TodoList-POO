<?php
namespace DB;

Use \PDO;
use \PDOException;

class Database
{
    // Design Pattern: Singleton
    public static ?PDO $instanceDb = null;

    // Configuration de la base de données 
    private const DB_HOST = 'localhost';
    private const DB_NAME = 'todos_db';
    private const DB_USER = 'root';
    private const DB_PASSWORD = '';

    /**
     * Empêche l'instanciation de la classe
     */
    private function __construct(){}
    private function __clone(){}

    public static function getInstance()
    {
        // si l'instance est nulle, on la crée 

        if(self::$instanceDb === null){
            try {
                self::$instanceDb = new PDO(
                    "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME . ";charset=utf8mb4", 
                    self::DB_USER, 
                    self::DB_PASSWORD,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Lever des exceptions quand il y a des erreurs
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //Renvoyer les données sous forme de tableau associatif
                    ]
            );
            } catch (PDOException $e) {
                die("Echec de la connexion à la BDD: ". $e->getMessage()); //die ou exit
            }
        }
        // Sinon, on la renvoie directement
        return self::$instanceDb;
    }
}