<?php
require_once 'vendor/autoload.php';
require_once 'includes/functions.php';

use M521\Taskforce\dbManager\DbManagerCRUD;

$dbManager = new DbManagerCRUD();

// Démarrer la session et récupérer l'email de l'utilisateur connecté
session_start();
$email = $_SESSION['email_user'];

// Vérifier si l'email est dans la session
if (!isset($email)) {
    die("Utilisateur non authentifié.");
}

$userInfo = getUserByEmail($email, $dbManager);
if (!$userInfo) {
    die("Utilisateur non trouvé.");
}

$userId = $userInfo->rendId();

// Vérifier si l'ID de la tâche est passé dans l'URL
if (!isset($_GET['task_id']) || $_GET['task_id'] <= 0) {
    die("ID de tâche invalide.");
}

$taskId = $_GET['task_id'];

// Récupérer la tâche depuis la base de données
$task = $dbManager->getTaskById($taskId);

// Si la tâche n'est pas trouvée, rediriger avec un message d'erreur
if (!$task) {
    $_SESSION['errorMessage'] = "Tâche non trouvée.";
    header("Location: dashboard.php"); // Rediriger vers la liste des tâches
    exit;
}

try {
    // Supprimer la tâche
    $dbManager->deleteTask($taskId);

    // Message de succès
    $_SESSION['successMessage'] = "Tâche supprimée avec succès!";
} catch (\Exception $e) {
    // Message d'erreur
    $_SESSION['errorMessage'] = "Erreur lors de la suppression de la tâche : " . $e->getMessage();
}

// Rediriger vers la liste des tâches après suppression
header("Location: dashboard.php");
exit;
?>
