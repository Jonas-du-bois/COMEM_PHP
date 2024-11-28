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

<div class="col-md-3 col-lg-2 bg-dark text-white sidebar position-fixed vh-100 d-flex flex-column p-3">

    <h4 class="mb-0">Gestion des tâches</h4>
    <p class="mt-1"><?= htmlspecialchars($userName) ?></p>


    <ul class="nav nav-pills flex-column mb-auto pt-3">
    <?php
                    $navLinks = [
                        'dashboard.php' => 'Tableau de bord',
                        'ajouter_tache.php' => 'Ajouter une tâche',
                        'taches_en_cours.php' => 'Tâches en cours',
                        'taches_terminees.php' => 'Tâches terminées',
                        'taches_partage.php' => 'Tâches partagées',
                    ];
                    foreach ($navLinks as $link => $label) {
                        $active = basename($_SERVER['PHP_SELF']) == $link ? 'active' : '';
                        echo "<li class='nav-item'>
                                <a href='$link' class='nav-link text-white $active'>$label</a>
                              </li>";
                    }
                    ?>
                </ul>
                
                <div class="mt-auto border-top pt-3">
                    <a href="profile.php" class="nav-link text-white pb-3<?= basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : '' ?>">
                        Mon Profil
                    </a>
                    <a href="logout.php" class="nav-link text-white pb-3">
                        Se déconnecter
                    </a>
                </div>
</div>