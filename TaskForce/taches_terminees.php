<?php
require_once 'vendor/autoload.php';
require_once 'includes/functions.php';

use M521\Taskforce\dbManager\DbManagerCRUD;

$dbManager = new DbManagerCRUD();

// Récupérer l'email de l'utilisateur connecté (assumé que la session est déjà démarrée)
session_start();
$email = $_SESSION['email_user'];

$userInfo = getUserByEmail($email, $dbManager);
if (!$userInfo) {
    die("Utilisateur non trouvé.");
}

$userId = $userInfo->rendId();

// Récupérer les tâches en cours de l'utilisateur
$tacheTermine = $dbManager->getTasksByUserIdAndStatus($userId, 'termine');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tâches en cours</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/styleSheet.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex">
        <!-- Inclusion de la sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <div class="container mt-5">

        <h2 class="text-center mb-4">Tâches en terminées</h2>

            <?php if (empty($tacheTermine)): ?>
                <p>Aucune tâche terminée pour le moment.</p>
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
                            <?php foreach ($tacheTermine as $task): ?>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
