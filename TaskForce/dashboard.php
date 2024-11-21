<?php
// Assurez-vous que l'utilisateur est authentifié avant d'afficher le dashboard
session_start();
if (!isset($_SESSION['user_connected']) && $_SESSION['user_connected']) {
    header("Location: login.php");
    exit;
}

require_once 'vendor/autoload.php';
use M521\Taskforce\dbManager\DbManagerCRUD;

$dbUser = new DbManagerCRUD();
$taches = $dbUser->getAllTaches(); // Vous devrez créer une méthode qui récupère toutes les tâches
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestion des Tâches</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <link rel="stylesheet" href="style/styles.css">
    <!-- Lien Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lien Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 p-3 bg-light">
                <h4 class="text-center mb-4">Gestion des Tâches</h4>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">Tableau de bord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ajouter_tache.php">Ajouter une tâche</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="taches_en_cours.php">Tâches en cours</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="taches_terminees.php">Tâches terminées</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profil.php">Mon Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Se déconnecter</a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-4">
                <h3>Tableau de bord</h3>

                <div class="row mb-4">
                    <div class="col-12">
                        <h5>Liste des tâches</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titre</th>
                                    <th>Description</th>
                                    <th>État</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($taches): ?>
                                    <?php foreach ($taches as $tache): ?>
                                        <tr>
                                            <td><?= $tache['id'] ?></td>
                                            <td><?= $tache['titre'] ?></td>
                                            <td><?= $tache['description'] ?></td>
                                            <td>
                                                <?php if ($tache['etat'] == 'en_cours'): ?>
                                                    <span class="badge bg-warning">En cours</span>
                                                <?php elseif ($tache['etat'] == 'terminee'): ?>
                                                    <span class="badge bg-success">Terminée</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Non définie</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="modifier_tache.php?id=<?= $tache['id'] ?>" class="btn btn-info btn-sm">Modifier</a>
                                                <?php if ($tache['etat'] != 'terminee'): ?>
                                                    <a href="terminer_tache.php?id=<?= $tache['id'] ?>" class="btn btn-success btn-sm">Terminer</a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Aucune tâche trouvée</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
</body>

</html>
