<?php
require_once 'vendor/autoload.php';
require_once 'includes/functions.php';

use M521\Taskforce\dbManager\DbManagerCRUD;

$dbManager = new DbManagerCRUD();

// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Récupérer l'utilisateur
$email = $_SESSION['email_user'];
$userInfo = getUserByEmail($email, $dbManager);
if (!$userInfo) {
    die("Utilisateur non trouvé.");
}

$userId = $userInfo->rendId();

$successMessage = '';
$errorMessage = '';

// Récupérer les paramètres de tri
$sortColumn = $_GET['sort'] ?? 'title'; // Par défaut, tri par titre
$order = $_GET['order'] ?? 'ASC'; // Par défaut, ordre ascendant

// Récupérer les tâches triées
$taches = $dbManager->getTasksByUserIdSorted($userId, $sortColumn, $order);

// Gérer la mise à jour des statuts via formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'], $_POST['statut'])) {
    $taskId = intval($_POST['task_id']);
    $formattedStatut = $_POST['statut'];

    $statutTraduction = [
        'À faire' => 'a_faire',
        'En cours' => 'en_cours',
        'Terminé' => 'termine',
    ];

    $internalStatut = $statutTraduction[$formattedStatut] ?? null;

    if ($internalStatut) {
        $task = $dbManager->getTaskById($taskId);

        if ($task) {
            $task->setStatut($internalStatut);
            $dbManager->updateTask($task, $taskId);
            $successMessage = "Statut de la tâche mis à jour avec succès.";
        } else {
            $errorMessage = "Tâche introuvable.";
        }
    } else {
        $errorMessage = "Statut invalide sélectionné.";
    }

    // Réactualiser les tâches triées après mise à jour
    $taches = $dbManager->getTasksByUserIdSorted($userId, $sortColumn, $order);
}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestion des Tâches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Inclure la sidebar -->
            <?php include 'Includes/sidebar.php'; ?>
            <!-- Contenu principal -->
            <div class="main-content ms-auto col-md-9 col-lg-10 p-5">
                <h2 class="text-center mb-4">Tableau de bord</h2>

                <!-- Liste des tâches -->
                <h4 class="text-secondary">Mes Tâches</h4>

                <?php if (empty($taches)): ?>
                    <div class="alert alert-info mt-4" role="alert">
                        <p>Aucune tâche assignée pour le moment.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive pt-4">
                        <table class="table table-hover align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <th scope="col">
                                        <a href="?sort=title&order=<?php echo getSortOrder('title'); ?>" class="text-decoration-none text-dark">
                                            Titre 
                                            <i class="bi <?php echo $sortColumn === 'title' ? ($order === 'ASC' ? 'bi-arrow-up' : 'bi-arrow-down') : ''; ?>"></i>
                                        </a>
                                    </th>
                                    <th scope="col">Description</th>
                                    <th scope="col">
                                        <a href="?sort=date_echeance&order=<?php echo getSortOrder('date_echeance'); ?>" class="text-decoration-none text-dark">
                                            Date d'échéance 
                                            <i class="bi <?php echo $sortColumn === 'date_echeance' ? ($order === 'ASC' ? 'bi-arrow-up' : 'bi-arrow-down') : ''; ?>"></i>
                                        </a>
                                    </th>
                                    <th scope="col">
                                        <a href="?sort=statut&order=<?php echo getSortOrder('statut'); ?>" class="text-decoration-none text-dark">
                                            Statut 
                                            <i class="bi <?php echo $sortColumn === 'statut' ? ($order === 'ASC' ? 'bi-arrow-up' : 'bi-arrow-down') : ''; ?>"></i>
                                        </a>
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($taches as $task): ?>
                                    <tr>
                                        <td scope="row" class="fw-bold text-dark p-3"><?php echo htmlspecialchars($task->rendTitre()); ?></td>
                                        <td class="text-truncate" style="max-width: 300px;">
                                            <?php echo htmlspecialchars($task->rendDescription()); ?>
                                        </td>
                                        <td class="text-muted"><?php echo htmlspecialchars($task->getFormattedDateEcheance()); ?></td>
                                        <td>
                                            <form method="POST" action="">
                                                <input type="hidden" name="task_id" value="<?php echo htmlspecialchars($task->rendId()); ?>">
                                              
                                                <select name="statut" class="statutActu form-select text-white badge <?php echo getStatusBadgeClass($task->getFormattedStatut()); ?>" style="max-width: 150px;" onchange="this.form.submit()">
                                                    <?php foreach (['À faire', 'En cours', 'Terminé'] as $status): ?>
                                                        <option value="<?php echo htmlspecialchars($status); ?>"
                                                            <?php echo $status === $task->getFormattedStatut() ? 'selected' : ''; ?>>
                                                            <?php echo htmlspecialchars($status); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <!-- Bouton de modification -->
                                            <form method="GET" action="task_details.php">
                                                <input type="hidden" name="task_id" value="<?php echo htmlspecialchars($task->rendId()); ?>">
                                                <button type="submit" class="btn btn-secondary btn-sm">Modifier</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

                <!-- Alertes Bootstrap placées en bas -->
                <div class="container">
                    <?php if (!empty($successMessage)): ?>
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            <?php echo htmlspecialchars($successMessage); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($errorMessage)): ?>
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <?php echo htmlspecialchars($errorMessage); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<style>
    select {
        width: 150px; /* Fixe une largeur uniforme pour le sélecteur */
    }

    select option {
        background-color: white;
        color: #000;
    }

    select option:hover {
        background-color: #ffc107;
    }

    th a {
        display: flex;
        align-items: center;
        justify-content: space-between; /* Assure un bon espacement entre le texte et l'icône */
        text-decoration: none;
    }

    th a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    th i {
        margin-left: 5px; /* Légèrement espacé pour éviter que la flèche touche le texte */
    }

    td select {
        padding-right: 20px; /* Ajoute un peu d'espace à droite pour éviter que le texte ne touche le bord */
    }

    .statutActu {
        width: 100%; /* Pour s'assurer que le statut occupe toute la largeur disponible dans la cellule */
        border-radius: 5px;
    }

    .badge {
        text-align: center;
        padding-left: 12px;
        padding-right: 12px;
    }

    .table th, .table td {
        vertical-align: middle; /* Assure que tout est bien centré verticalement */
    }
</style>

