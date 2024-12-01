<?php

// Utilisation de la classe DbManagerCRUD pour gérer les opérations liées à la base de données
use M521\Taskforce\dbManager\DbManagerCRUD;

// Démarre la session si elle n'est pas déjà démarrée
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifie si l'utilisateur est connecté. Si ce n'est pas le cas, redirige vers la page de connexion
if (!isset($_SESSION['user_connected']) || !$_SESSION['user_connected']) {
    header("Location: login.php");
    exit; // Interrompt l'exécution du script après la redirection
}

// Récupère l'email de l'utilisateur connecté depuis la session
$email = $_SESSION['email_user'];

// Crée une instance de DbManagerCRUD pour interagir avec la base de données
$dbManager = new DbManagerCRUD();

// Récupère les informations de l'utilisateur à partir de son email
$users = $dbManager->rendPersonnes($email);

// Vérifie si des informations sur l'utilisateur ont été récupérées
if (!empty($users)) {
    // Si des informations sont disponibles, prend le prénom et le nom de l'utilisateur
    $user = $users[0];
    $userName = $user->rendPrenom() . ' ' . $user->rendNom();
} else {
    // Si aucune information n'est trouvée, définie un nom d'utilisateur générique
    $userName = 'Utilisateur inconnu';
}
?>

<!-- Inclure Font Awesome pour utiliser les icônes -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<!-- Sidebar (barre de navigation latérale) avec une position fixe à gauche de la page -->
<div class="col-md-3 col-lg-2 bg-dark text-white sidebar position-fixed vh-100 d-flex flex-column p-3">

    <!-- Titre de la section -->
    <h4 class="mb-0">Gestion des tâches</h4>
    
    <!-- Affiche le nom de l'utilisateur connecté -->
    <p class="mt-1"><?= htmlspecialchars($userName) ?></p>

    <!-- Liste des liens de navigation avec un état actif dynamique -->
    <ul class="nav nav-pills flex-column mb-auto pt-3">
        <?php
        // Définition des liens de navigation avec leurs labels et icônes associées
        $navLinks = [
            'index.php' => '<i class="fas fa-home"></i> Accueil', // Icône maison pour la page d'accueil
            'dashboard.php' => '<i class="fas fa-tachometer-alt"></i> Tableau de bord', // Icône tableau de bord
            'ajouter_tache.php' => '<i class="fas fa-plus-circle"></i> Ajouter une tâche', // Icône plus
            'taches_a_faire.php' => '<i class="fas fa-list-ul"></i> Tâches à faire', // Icône liste
            'taches_en_cours.php' => '<i class="fas fa-spinner"></i> Tâches en cours', // Icône en cours
            'taches_terminees.php' => '<i class="fas fa-check-circle"></i> Tâches terminées', // Icône check
            'taches_partage.php' => '<i class="fas fa-share-alt"></i> Tâches partagées', // Icône partage
        ];

        // Parcours les liens de navigation et les affiche dans la liste
        foreach ($navLinks as $link => $label) {
            // Détermine si le lien est actif en comparant le nom du fichier actuel avec celui du lien
            $active = basename($_SERVER['PHP_SELF']) == $link ? 'active' : '';
            echo "<li class='nav-item'>
                    <a href='$link' class='nav-link text-white $active'>$label</a>
                  </li>";
        }
        ?>
    </ul>
    
    <!-- Section pour les liens de profil et de déconnexion -->
    <div class="mt-auto border-top pt-3">
        <!-- Lien vers le profil avec une classe active si la page actuelle est 'profile.php' -->
        <a href="profile.php" class="nav-link text-white pb-3<?= basename($_SERVER['PHP_SELF']) == 'profile.php' ? ' active' : '' ?>">
            <i class="fas fa-user"></i> Mon Profil
        </a>
        
        <!-- Lien de déconnexion avec une icône -->
        <a href="logout.php" class="nav-link text-white pb-3">
            <i class="fas fa-sign-out-alt"></i> Se déconnecter
        </a>
    </div>
</div>
