<?php
// Inclusion des fichiers nécessaires
require_once 'vendor/autoload.php'; // Chargement des dépendances via Composer
require_once 'includes/functions.php'; // Fonctions utilitaires

use M521\Taskforce\dbManager\DbManagerCRUD; // Namespace pour le gestionnaire de tâches

// Initialisation du gestionnaire de base de données
$dbManager = new DbManagerCRUD();

// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Récupérer les informations de l'utilisateur connecté
$email = $_SESSION['email_user'] ?? null;
if (!$email) {
    die("L'utilisateur n'est pas connecté.");
}
$userInfo = getUserByEmail($email, $dbManager);
if (!$userInfo) {
    die("Utilisateur non trouvé.");
}
$userId = $userInfo->rendId(); // Obtenir l'identifiant utilisateur

// Messages de succès/erreur pour les actions utilisateur
$successMessage = '';
$errorMessage = '';

// Déterminer les critères de tri des tâches (par défaut : titre et ordre ascendant)
$sortColumn = $_GET['sort'] ?? 'title';
$order = $_GET['order'] ?? 'ASC';

// Récupérer les tâches triées pour l'utilisateur
$taches = $dbManager->getTasksByUserIdSorted($userId, $sortColumn, $order);

// Gérer les modifications de statut via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'], $_POST['statut'])) {
    $taskId = intval($_POST['task_id']);
    $formattedStatut = $_POST['statut'];

    // Traduction des statuts affichés vers les valeurs internes
    $statutTraduction = [
        'À faire' => 'a_faire',
        'En cours' => 'en_cours',
        'Terminé' => 'termine',
    ];
    $internalStatut = $statutTraduction[$formattedStatut] ?? null;

    if ($internalStatut) {
        $task = $dbManager->getTaskById($taskId);

        if ($task) {
            $task->setStatut($internalStatut); // Mettre à jour le statut
            $dbManager->updateTask($task, $taskId); // Enregistrer la modification
            $successMessage = "Statut de la tâche mis à jour avec succès.";
        } else {
            $errorMessage = "Tâche introuvable.";
        }
    } else {
        $errorMessage = "Statut invalide sélectionné.";
    }

    // Actualiser la liste des tâches après la mise à jour
    $taches = $dbManager->getTasksByUserIdSorted($userId, $sortColumn, $order);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestion des Tâches</title>
    <!-- Intégration de Bootstrap pour le style -->
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
                <h2 class="text-center mb-4">Tableau de bord</h2>

                <!-- Affichage des messages de succès/erreur -->
                <?php
                if (isset($_SESSION['successMessage'])) {
                    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['successMessage']) . '</div>';
                    unset($_SESSION['successMessage']);
                }
                if (isset($_SESSION['errorMessage'])) {
                    echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['errorMessage']) . '</div>';
                    unset($_SESSION['errorMessage']);
                }
                ?>

                <!-- Section des tâches -->
                <h4 class="text-secondary">Mes Tâches</h4>

                <?php if (empty($taches)): ?>
                    <!-- Message si aucune tâche n'est disponible -->
                    <div class="alert alert-info mt-4" role="alert">
                        <p>Aucune tâche assignée pour le moment.</p>
                    </div>
                <?php else: ?>
                    <!-- Tableau des tâches -->
                    <div class="table-responsive pt-4">
                        <table class="table table-hover align-middle">
                            <thead class="table-secondary">
                                <tr>
                                    <!-- Colonnes avec tri -->
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
                                        <!-- Contenu des colonnes -->
                                        <td scope="row" class="fw-bold text-dark p-3"><?php echo htmlspecialchars($task->rendTitre()); ?></td>
                                        <td class="text-truncate" style="max-width: 300px;">
                                            <?php echo htmlspecialchars($task->rendDescription()); ?>
                                        </td>
                                        <td class="text-muted"><?php echo htmlspecialchars($task->getFormattedDateEcheance()); ?></td>
                                        <td>
                                            <!-- Formulaire de mise à jour du statut -->
                                            <form method="POST" action="">
                                                <input type="hidden" name="task_id" value="<?php echo htmlspecialchars($task->rendId()); ?>">
                                                <select name="statut" class="statutActu form-select text-white badge <?php echo getStatusBadgeClass($task->getFormattedStatut()); ?>" style="max-width: 150px;" onchange="this.form.submit()">
                                                    <?php foreach (['À faire', 'En cours', 'Terminé'] as $status): ?>
                                                        <option value="<?php echo htmlspecialchars($status); ?>" <?php echo $status === $task->getFormattedStatut() ? 'selected' : ''; ?>>
                                                            <?php echo htmlspecialchars($status); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <!-- Bouton pour modifier -->
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
            </div>
        </div>
    </div>
</body>

</html>


<style>
    select {
        width: 150px;
        /* Fixe une largeur uniforme pour le sélecteur */
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
        justify-content: space-between;
        /* Assure un bon espacement entre le texte et l'icône */
        text-decoration: none;
    }

    th a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    th i {
        margin-left: 5px;
        /* Légèrement espacé pour éviter que la flèche touche le texte */
    }

    td select {
        padding-right: 20px;
        /* Ajoute un peu d'espace à droite pour éviter que le texte ne touche le bord */
    }

    .statutActu {
        width: 100%;
        /* Pour s'assurer que le statut occupe toute la largeur disponible dans la cellule */
        border-radius: 5px;
    }

    .badge {
        text-align: center;
        padding-left: 12px;
        padding-right: 12px;
    }

    .table th,
    .table td {
        vertical-align: middle;
        /* Assure que tout est bien centré verticalement */
    }
</style>