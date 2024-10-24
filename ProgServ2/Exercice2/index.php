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
            <p>Tu es officiellement arrivé sur la page où... il n'y a absolument rien de spécial à faire. 
                Eh oui, tu peux t'installer, te détendre, et admirer ce magnifique espace blanc. Ne t'inquiète 
                pas, même si ça ressemble à du vide intersidéral, c'est intentionnel. Ici, tu peux faire 
                absolument tout ce que tu veux... tant que ce "tout" n'implique rien du tout. Bref, bienvenue 
                dans le calme avant la tempête (ou pas).</p>

            <?php
            // Affichage d'un message de connexion
            if (isset($_SESSION['user_connected']) && $_SESSION['user_connected']) {
                echo "<br>";
                echo "<p><strong>Bravo, tu es connecté.</strong></p>";
            } else {
                $_SESSION['user_connected'] = false;
            }
            ?>
        </main>
        <div class="image-container">
            <img class="image" src="./img/geranium.png" alt="Un petit géranium">
            <div class="legende">et là, un petit géranium</div>
        </div>
        <footer>
            <p>Jonas Du Bois 2024, en galère</p>
        </footer>
    </body>
</html>
