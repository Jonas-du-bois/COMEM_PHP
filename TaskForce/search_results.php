<?php

require_once 'vendor/autoload.php'; // Charger les classes via Composer
require_once 'includes/functions.php'; // Inclure les fonctions utilitaires

use M521\Taskforce\dbManager\DbManagerCRUD;

// Création d'une instance du gestionnaire de base de données
$dbManager = new DbManagerCRUD();

// Démarrer la session si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$email = $_SESSION['email_user'] ?? '';

// Vérification de l'email utilisateur et récupération des informations
$userInfo = getUserByEmail($email, $dbManager);
if (!$userInfo) {
    die("Utilisateur non trouvé.");
}

// Récupérer l'ID de l'utilisateur
$userId = $userInfo->rendId();

// Initialisation des variables
$query = $_GET['query'] ?? ''; // Récupération de la recherche
$searchResults = [];

if (!empty($query)) {
    // Rechercher les tâches correspondant à la requête
    $searchResults = $dbManager->searchTasks($query, $userId);
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Inclure la barre latérale -->
            <?php include 'Includes/sidebar.php'; ?>

            <!-- Contenu principal -->
            <div class="main-content ms-auto col-md-9 col-lg-10 p-5">
                
                <h2 class="text-center mb-4">Résultats de recherche</h2>

                <!-- Message si aucun terme de recherche n'est entré -->
                <?php if (empty($query)): ?>
                    <div class="alert alert-warning" role="alert">
                        <p>Vous n'avez pas mis de terme de recherche, retournez sur la page de recheche</p>
                    </div>
                <?php else: ?>

                    <!-- Message si aucun résultat n'est trouvé -->
                    <?php if (empty($searchResults)): ?>
                        <div class="alert alert-info" role="alert">
                            <p>Aucun résultat trouvé pour : <strong><?php echo htmlspecialchars($query); ?></strong></p>
                        </div>
                    <?php else: ?>

                        <!-- Tableau des résultats de recherche -->
                        <div class="table-responsive pt-4">
                            <table class="table table-hover align-middle">
                                <thead class="table-secondary">
                                    <tr>
                                        <th scope="col">Titre</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Date d'échéance</th>
                                        <th scope="col">Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($searchResults as $task): ?>
                                        <tr>
                                            <td scope="row" class="fw-bold text-dark p-3">
                                                <?php echo htmlspecialchars($task->rendTitre()); ?>
                                            </td>
                                            <td class="text-truncate" style="max-width: 300px;">
                                                <?php echo htmlspecialchars($task->rendDescription()); ?>
                                            </td>
                                            <td class="text-muted">
                                                <?php echo htmlspecialchars($task->getFormattedDateEcheance()); ?>
                                            </td>
                                            <td>
                                                <span class="badge <?php echo getStatusBadgeClass($task->getFormattedStatut()); ?>">
                                                    <?php echo htmlspecialchars($task->getFormattedStatut()); ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                <!-- Bouton de retour -->
                <div class="mt-3 text-center">
                                <a href="dashboard.php" class="btn btn-primary">Rechercher autre chose</a>
                            </div>
            </div>
        </div>
    </div>
</body>

</html>

<style>
    .table th,
    .table td {
        vertical-align: middle;
    }

    .badge {
        padding: 10px;
        text-align: center;
    }

    .text-truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>