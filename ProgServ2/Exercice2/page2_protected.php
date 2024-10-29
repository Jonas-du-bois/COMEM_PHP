<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styleSheet.css">
        <title>Page 2 - Protected</title>
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
                <li><a href="page2_Unprotected.php">Page secrète</a></li>
                
                <?php
                session_start();
                // Vérifiez si l'utilisateur est connecté
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
            <h1>Bienvenue sur la Page 2, la page qui est protégé ! </h1>
            <p class="styled-text">Voici la page protégée qui n'est pas plus intérressante que ça, à moins que tu ne te connectes ... ;D</p>

            <?php
            require_once('./config/autoload.php');


            // Vérification si l'utilisateur est connecté
            if (isset($_SESSION['user_connected']) && $_SESSION['user_connected']) {
                // L'utilisateur est connecté, redirigez-le vers la page non protégée
                header('Location: page2_unprotected.php');
                exit();
            } else {
                // L'utilisateur n'est pas connecté
                $_SESSION['user_connected'] = false; // Initialisation de la variable de session
                echo "<p>Il semblerait que tu n'es pas connecté. Accède ici à la page de <a href='login.php'>connexion</a>.</p>";
            }
            ?>

        </main>

        <footer>
            <p>Jonas Du Bois 2024, en galère</p>
        </footer>
    </body>
</html>




