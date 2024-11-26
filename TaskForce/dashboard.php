<?php
require_once 'vendor/autoload.php'; 
require_once 'includes/functions.php';
use M521\Taskforce\dbManager\DbManagerCRUD;

$dbManager = new DbManagerCRUD();

// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$email = $_SESSION['email_user'];

$userInfo = getUserByEmail($email, $dbManager);
if (!$userInfo) {
    die("Utilisateur non trouvé.");
}

$userId = $userInfo->rendId();
// Récupérer les tâches de l'utilisateur
$taches = $dbManager->getTasksByUserId($userId);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestion des Tâches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Inclure la sidebar -->
            <?php include 'Includes/sidebar.php'; ?>
            <!-- Contenu principal -->
            <div class="col-md-9 col-lg-10 p-4">
                <h2 class="text-center mb-4">Tableau de bord</h2>
                
                <!-- Liste des tâches -->
                <h4>Mes Tâches</h4>
                
                <?php if (empty($taches)): ?>
                    <p>Aucune tâche assignée pour le moment.</p>
                <?php else: ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Titre</th>
                                <th>Description</th>
                                <th>Date d'échéance</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($taches as $task): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($task->rendTitre()); ?></td>
                                    <td><?php echo htmlspecialchars($task->rendDescription()); ?></td>
                                    <td><?php echo htmlspecialchars($task->rendDateEcheance()); ?></td>
                                    <td><?php echo htmlspecialchars($task->rendStatut()); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>