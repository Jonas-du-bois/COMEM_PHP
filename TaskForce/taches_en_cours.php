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
$tachesEnCours = $dbManager->getTasksByUserIdAndStatus($userId, 'en_cours');
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
        
        <div class="main-content ms-auto col-md-9 col-lg-10 p-5">

        <h2 class="text-center mb-4">Tâches en cours</h2>

            <?php if (empty($tachesEnCours)): ?>
                <p>Aucune tâche en cours pour le moment.</p>
            <?php else: ?>
                <div class="table-responsive p-3">
                    <table class="table table-hover">
                            <thead>
                                <tr class="table-dark">
                                    <th scope="col">Titre</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Date d'échéance</th>
                                    <th scope="col">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($tachesEnCours as $task): ?>
                                    <tr>
                                        <td scope="row"><?php echo htmlspecialchars($task->rendTitre()); ?></td>
                                        <td class="text-truncate" style="max-width: 200px; overflow: hidden; white-space: nowrap;"><?php echo htmlspecialchars($task->rendDescription()); ?></td>
                                        <td><?php echo htmlspecialchars($task->getFormattedDateEcheance()); ?></td>
                                        <td>
                                            <span class="badge <?php echo getStatusBadgeClass($task->getFormattedStatut()); ?> me-1">
                                                <?php echo htmlspecialchars($task->getFormattedStatut()); ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                </div>
            <?php endif; ?>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
