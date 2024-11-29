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
    <title>Tâches terminées</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/styleSheet.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

</head>

<body>
    <div class="d-flex">
        <!-- Inclusion de la sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <div class="main-content ms-auto col-md-9 col-lg-10 p-5">
            <h2 class="text-center mb-4 text-success">Tâches terminées</h2>

            <?php if (empty($tacheTermine)): ?>
                <div class="alert alert-info mt-4" role="alert">
                    <p>Aucune tâche terminée pour le moment.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive pt-4">
                    <table class="table table-hover align-middle">
                        <thead class="table-success">
                            <tr>
                            <th scope="col" style="width: 20%;">Titre</th>
                                <th scope="col" style="width: 30%;">Description</th>
                                <th scope="col" style="width: 20%;">Date d'échéance</th>
                                <th scope="col" style="width: 20%;">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tacheTermine as $task): ?>
                                <tr class="clickable-row" data-href="task_details.php?task_id=<?php echo $task->rendId(); ?>">
                                    <td scope="row" class="fw-bold text-dark p-3"><?php echo htmlspecialchars($task->rendTitre()); ?></td>
                                    <td class="text-truncate" style="max-width: 300px;">
                                        <?php echo htmlspecialchars($task->rendDescription()); ?>
                                    </td>
                                    <td class="text-muted"><?php echo htmlspecialchars($task->getFormattedDateEcheance()); ?></td>
                                    <td>
                                        <span class="badge <?php echo getStatusBadgeClass($task->getFormattedStatut()); ?> me-1">
                                            <i class="bi bi-check-circle-fill"></i> <?php echo htmlspecialchars($task->getFormattedStatut()); ?>
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