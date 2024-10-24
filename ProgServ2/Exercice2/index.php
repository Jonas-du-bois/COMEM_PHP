<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleSheet.css">
    <title>Page 1</title>
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
                <li><a href="index.php">Page 1</a></li>
                <li><a href="page2_protected.php">Page 2</a></li>
                
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
        <h1>Bienvenue sur la Page 1</h1>
        <p>Bienvenue sur la page 1 la page où tu peux faire tout ce que tu veux, même s'il n'y a rien à faire de bien intéressant.</p>

        <?php
        // Affichage d'un message de connexion
        if (isset($_SESSION['user_connected']) && $_SESSION['user_connected']) {
            echo "<p>Bravo, tu es connecté.</p>";
        } else {
            $_SESSION['user_connected'] = false;
        }
        ?>
    </main>

    <footer>
        <p>Jonas Du Bois 2024, en galère</p>
    </footer>
</body>
</html>
