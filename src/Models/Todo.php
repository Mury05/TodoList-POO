<?php
namespace App\Models;

class Todo extends Model
{
    /**
     * Récupère toutes les tâches dans la base de données
     * @return array
     */
    public function all()
    {
        // Récupérer les tâches depuis la BDD
        $query = $this->db->query("SELECT * FROM todos;"); //Prepare la requête
        return $query->fetchAll(); // Retourne le résultat de l'éxécution de la requête
    }

    /**
     * Récupère une tache spécifique
     * @param mixed $id
     * @return mixed
     */
    public function getOne($id)
    {
        $query = $this->db->query("SELECT * FROM todos WHERE id = $id;"); //Prepare la requête
        return $query->fetch();
    }

    /**
     * Crée une nouvelle tâche
     * @param string $task
     * @return bool
     */
    public function create(string $task)
    {
        //Prepare la requête SQL pour insérer une nouvelle tâche dans la table "todos".
        // Les placeholders `:task` et `:done` sont utilisés pour éviter les injections SQL.
        $stmt = $this->db->prepare("INSERT INTO todos (task, done) VALUES (:task, :done);");

        // Exécute la requête préparée avex les valeurs spécifiques fournies dans un tableau associatif
        // - `:task` contient la description de la tache saisie par l'utilisateur
        // - `:done` est initialisé à 0 (indique quand la tâche n'est pas encore terminée)
        return $stmt->execute([":task" => $task, ":done" => 0]); //Exécute la requête
        //$stmt->execute(["task"=> $task, "done" => 0]); //On peut retirer les ':' des placeholders. C'est pareil !

    }

    /**
     * Modifier une tache
     * @param mixed $id Identifiant de la tâche à modifier
     * @return bool
     */
    public function update($id, string $task)
    {
        $stmt = $this->db->prepare("UPDATE todos SET task = :task WHERE id= :id");
        return $stmt->execute(["task" => $task, "id" => (int) $id]);
    }

    /**
     * Modifier le status d'une tache
     * @param mixed $id Identifiant de la tâche à modifier
     * @return bool
     */
    public function toggle($id)
    {
        $stmt = $this->db->prepare("UPDATE todos SET done = NOT done WHERE id= :id");
        return $stmt->execute(["id" => (int) $id]);
    }

    /**
     * Supprimer une tache
     * @param mixed $id Identifiant de la tâche à supprimer
     * @return bool
     */
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM todos WHERE id = :id"); //$stmt pour prepared statement
        return $stmt->execute(["id" => (int) $id]);
    }
}