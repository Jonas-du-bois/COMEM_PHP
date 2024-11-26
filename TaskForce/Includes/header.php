<?php
// Démarre la session pour utiliser $_SESSION
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskForce</title>
    <link rel="stylesheet" href="style/styles.css">
    <!-- Lien Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lien Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<!-- Barre de navigation -->
<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
    <div class="container">
        <!-- Logo ou titre -->
        <a class="navbar-brand" href="index.php">TaskForce</a>

        <!-- Bouton pour menu mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Liens de navigation -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Accueil</a>
                </li>
                <?php
                // Vérifie si l'utilisateur est connecté
                if (isset($_SESSION['user_connected']) && $_SESSION['user_connected']) {
                    echo '<li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>';
                    echo '<li class="nav-item"><a class="nav-link" href="logout.php">Déconnexion</a></li>';
                } else {
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
