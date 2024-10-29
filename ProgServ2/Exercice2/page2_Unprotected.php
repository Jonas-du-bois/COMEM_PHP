<?php
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['user_connected']) || $_SESSION['user_connected'] !== true) {
    // Redirige vers la page d'accueil si l'utilisateur n'est pas connecté
    header('Location: page2_protected.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styleSheet.css">
        <title>Bienvenue sur la page de mèmes !</title>
    </head>
    <body>
        
            <header>
            <nav>
                <input type="checkbox" id="menu-toggle" class="menu-toggle">
                <label for="menu-toggle" class="menu-icon">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </label>
                <ul class="nav-list">
                    <li><a href="index.php">Accueil</a></li>
                <li><a href="page2_protected.php">Page secrète</a></li>
                
                <?php
                if (isset($_SESSION['user_connected']) && $_SESSION['user_connected']) {
                    echo '<li><a href="logout.php">Déconnexion</a></li>';
                } else {
                    echo '<li><a href="login.php">Se connecter</a></li>';
                    echo '<li><a href="signup.php">S\'inscrire</a></li>';
                }
                ?>
                </ul>
            </nav>
        </header>
            <main>
                <h1>Bienvenue !</h1>
                <p>A Bikini Bottom</p>

                <div>
                    <img src="./img/bob l'éponge.jpeg" alt="Un mème drôle" class="meme">
                </div>
            </main>

             
        <footer>
            <p>Jonas Du Bois 2024, en galère</p>
        </footer>
    </body>
</html>
