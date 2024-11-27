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
                                <?php foreach ($taches as $task): ?>
                                    <!-- Lien sur toute la ligne -->
                                    <tr class="clickable-row" data-href="task_details.php?task_id=<?php echo $task->rendId(); ?>">
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
    </div>

    <script>
        // Assurer que le JavaScript fonctionne correctement
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.clickable-row').forEach(row => {
                row.addEventListener('click', function() {
                    window.location = this.dataset.href;
                });
            });
        });
    </script>
</body>
</html>
