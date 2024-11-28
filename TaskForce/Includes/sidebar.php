<?php

use M521\Taskforce\dbManager\DbManagerCRUD;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_connected']) && !$_SESSION['user_connected']) {
    header("Location: login.php");
    exit;
    
}
//Prendre le nom et le prénom de l'utilisateur connecté
$email = $_SESSION['email_user'];

$dbManager = new DbManagerCRUD();
$users = $dbManager->rendPersonnes($email);

if (!empty($users)) {
    $user = $users[0];
    $userName = $user->rendPrenom() . ' ' . $user->rendNom();
} else {
    $userName = 'Utilisateur inconnu';
}
?>

<div class="col-md-3 col-lg-2 bg-dark text-white p-3" style="height: 100vh; display: flex; flex-direction: column; justify-content: space-between;">
    <!-- Titre et Nom de l'utilisateur -->
    <div>
        <h4 class="text-center mb-1">Gestion des Tâches</h4>
        <p class="text-center "><?= htmlspecialchars($userName) ?></p>
    </div>

    <!-- Navigation principale -->
    <ul class="nav nav-pills flex-column mb-auto mt-4">
        <li class="nav-item">
            <a href="dashboard.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">
                Tableau de bord
            </a>
        </li>
        <li>
            <a href="ajouter_tache.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'ajouter_tache.php' ? 'active' : '' ?>">
                Ajouter une tâche
            </a>
        </li>
        <li>
            <a href="taches_en_cours.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'taches_en_cours.php' ? 'active' : '' ?>">
                Tâches en cours
            </a>
        </li>
        <li>
            <a href="taches_terminees.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'taches_terminees.php' ? 'active' : '' ?>">
                Tâches terminées
            </a>
        </li>
        <li>
            <a href="taches_partage.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'taches_partage.php' ? 'active' : '' ?>">
                Tâches partagées
            </a>
        </li>
    </ul>

    <!-- Mon Profil et Se déconnecter -->
    <div class="mt-3 pt-3 border-top">
        <a href="profile.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : '' ?>" style="margin-bottom: 10px;">
            Mon Profil
        </a>
        <a href="logout.php" class="nav-link text-white">
            Se déconnecter
        </a>
    </div>
</div>
