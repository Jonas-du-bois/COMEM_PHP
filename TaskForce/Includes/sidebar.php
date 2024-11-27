<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user_connected']) && !$_SESSION['user_connected']) {
    header("Location: login.php");
    exit;
}
?>

<div class="col-md-3 col-lg-2 bg-dark text-white p-3" style="height: 100vh;">
    <h4 class="text-center mb-4">Gestion des Tâches</h4>
    <ul class="nav nav-pills flex-column mb-auto">
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
        <li>
            <a href="profile.php" class="nav-link text-white <?= basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : '' ?>">
                Mon Profil
            </a>
        </li>
        <li>
            <a href="logout.php" class="nav-link text-white">
                Se déconnecter
            </a>
        </li>
    </ul>
</div>
