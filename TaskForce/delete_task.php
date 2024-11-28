<?php
require_once 'vendor/autoload.php';
require_once 'includes/functions.php';

use M521\Taskforce\dbManager\DbManagerCRUD;

session_start(); // Démarrage de la session
$dbManager = new DbManagerCRUD();

if (isset($_POST['delete_task'])) {
    try {
        // Validation sécurisée de l'ID de tâche
        $taskId = filter_input(INPUT_GET, 'task_id', FILTER_VALIDATE_INT);
        if (!$taskId) {
            die("ID de tâche invalide.");
        }

        // Supprimer la tâche dans la base de données
        $dbManager->deleteTask($taskId);

        // Ajouter un message de succès
        $_SESSION['successMessage'] = "Tâche supprimée avec succès !";

        // Rediriger vers la liste des tâches après la suppression
        header("Location: task_details.php"); // Assurez-vous que cette page existe
        exit;
    } catch (\Exception $e) {
        // Ajouter un message d'erreur
        $_SESSION['errorMessage'] = "Erreur lors de la suppression de la tâche : " . $e->getMessage();
    }
}

