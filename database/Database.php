<?php
namespace DB;

use Dotenv\Dotenv;
use \PDO;
use \PDOException;

class Database
{
    // Design Pattern: Singleton
    public static ?PDO $instanceDb = null;

    /**
     * Empêche l'instanciation de la classe
     */
    private function __construct()
    {
    }
    private function __clone()
    {
    }

    public static function getInstance()
    {
        // Charger les variables d'environnement
        $dotenv = Dotenv::createImmutable(dirname(__DIR__ ));
        $dotenv->load();

        // Configuration de la base de données 
        $dbHost = $_ENV["DB_HOST"];
        $dbName = $_ENV["DB_NAME"];
        $dbUser = $_ENV["DB_USER"];
        $dbPassword = $_ENV["DB_PASSWORD"];
        $dbCharset = $_ENV["DB_CHARSET"];

        // si l'instance est nulle, on la crée 

        if (self::$instanceDb === null) {
            try {
                self::$instanceDb = new PDO(
                    "mysql:host=$dbHost;dbname=$dbName;charset=$dbCharset",
                    $dbUser,
                    $dbPassword,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Lever des exceptions quand il y a des erreurs
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //Renvoyer les données sous forme de tableau associatif
                    ]
                );
            } catch (PDOException $e) {
                die("Echec de la connexion à la BDD: " . $e->getMessage()); //die ou exit
            }
        }
        // Sinon, on la renvoie directement
        return self::$instanceDb;
    }
}