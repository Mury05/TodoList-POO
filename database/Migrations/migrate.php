<?php
namespace Database\Migrations;

require dirname(__DIR__) . "/../vendor/autoload.php";

use DB\Database;

// Récupérer l'instance de connexion à la base de données
$db = Database::getInstance();

// Création des tables si elles n'existent pas
$queries = [
    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_name VARCHAR(255) NOT NULL,
        user_email VARCHAR(255) NOT NULL,
        user_password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT UC_Person UNIQUE(user_name, user_email)
    )",
    "CREATE TABLE IF NOT EXISTS todos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        task VARCHAR(255) NOT NULL,
        done TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )"
];

foreach ($queries as $query) {
    $db->exec($query);
    echo "Migration exécutée : $query" . PHP_EOL;
}

// Vérification de l'existence de la colonne user_id dans la table todos
$table = 'todos';
$column = 'user_id';
$dbName = $_ENV["DB_NAME"];

// Requête pour vérifier l'existence de la colonne
$verifQuery = "
    SELECT COLUMN_NAME 
    FROM information_schema.COLUMNS 
    WHERE TABLE_NAME = :table AND COLUMN_NAME = :column AND TABLE_SCHEMA = :schema
";

$stmt = $db->prepare($verifQuery);
$stmt->execute([
    ':table' => $table,
    ':column' => $column,
    ':schema' => $dbName,
]);

$columnExists = $stmt->fetch();

if (!$columnExists) {
    // Ajoute la colonne si elle n'existe pas
    $addColumnQuery = "ALTER TABLE $table ADD $column INT;";
    $db->exec($addColumnQuery);

    // Ajoute une clé étrangère
    $addForeignKeyQuery = "
        ALTER TABLE $table 
        ADD CONSTRAINT fk_$column 
        FOREIGN KEY ($column) REFERENCES users(id);
    ";
    $db->exec($addForeignKeyQuery);

    echo "La colonne `$column` a été ajoutée et la clé étrangère a été définie avec succès." . PHP_EOL;
} else {
    echo "La colonne `$column` existe déjà dans la table `$table`." . PHP_EOL;
}

echo "Migrations terminées avec succès !" . PHP_EOL;