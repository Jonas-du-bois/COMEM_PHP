<?php
// Démarre une session pour utiliser les variables $_SESSION (utilisées pour la gestion des utilisateurs)
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskForce</title>
    <!-- Lien vers le fichier CSS personnalisé pour le style de la page -->
    <link rel="stylesheet" href="style/styles.css">
    
    <!-- Lien vers le fichier CSS de Bootstrap pour des styles prédéfinis et réactifs -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Lien vers le fichier JS de Bootstrap pour les interactions et le menu mobile -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <!-- Logo ou titre de l'application, redirige vers la page d'accueil -->
        <a class="navbar-brand" href="index.php">TaskForce</a>

        <!-- Bouton pour le menu mobile (affichage des liens sur petits écrans) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Liste des liens de navigation qui s'affichent dans le menu -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <!-- Lien vers la page d'accueil -->
                    <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                </li>
                <?php
                // Vérifie si l'utilisateur est connecté en vérifiant une variable de session
                if (isset($_SESSION['user_connected']) && $_SESSION['user_connected']) {
                    // Si l'utilisateur est connecté, afficher les liens vers le tableau de bord et la déconnexion
                    echo '<li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="logout.php">Déconnexion</a></li>';
                } else {
                    // Si l'utilisateur n'est pas connecté, afficher les liens pour se connecter ou s'inscrire
                    echo '<li class="nav-item"><a class="nav-link" href="login.php">Se connecter</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="signup.php">S\'inscrire</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Le reste de ton contenu de page -->

</body>
</html>
