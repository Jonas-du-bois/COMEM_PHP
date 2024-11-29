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

// Récupérer les tâches à faire de l'utilisateur
$tachesAFaire = $dbManager->getTasksByUserIdAndStatus($userId, 'a_faire');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tâches à faire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/styleSheet.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
    <div class="d-flex">
        <!-- Inclusion de la sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <div class="main-content ms-auto col-md-9 col-lg-10 p-5">
            <h2 class="text-center mb-4 text-danger">Tâches à faire</h2>

            <?php if (empty($tachesAFaire)): ?>
                <div class="alert alert-info mt-4" role="alert">
                    <p>Aucune tâche à faire pour le moment.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive pt-4">
                    <table class="table table-hover align-middle">
                        <thead class="table-danger">
                            <tr>
                            <th scope="col" style="width: 20%;">Titre</th>
                                <th scope="col" style="width: 30%;">Description</th>
                                <th scope="col" style="width: 20%;">Date d'échéance</th>
                                <th scope="col" style="width: 20%;">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tachesAFaire as $task): ?>
                                <tr>
                                    <td scope="row" class="fw-bold text-dark p-3"><?php echo htmlspecialchars($task->rendTitre()); ?></td>
                                    <td class="text-truncate" style="max-width: 300px;">
                                        <?php echo htmlspecialchars($task->rendDescription()); ?>
                                    </td>
                                    <td class="text-muted"><?php echo htmlspecialchars($task->getFormattedDateEcheance()); ?></td>
                                    <td>
                                        <span class="badge <?php echo getStatusBadgeClass($task->getFormattedStatut()); ?> me-1">
                                            <i class="bi bi-hourglass-split"></i> <?php echo htmlspecialchars($task->getFormattedStatut()); ?>
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