<?php
require_once('./config/autoload.php');
require_once ('./dbManager/DbManagerCRUD.php');
require_once ('./dbManager/I_ApiCRUD.php');

use dbManager\DbManagerCRUD;

$dbUser = new DbManagerCRUD();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styleSheet.css">
        <title>Connexion</title>
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
            <h1>Connecte-toi !</h1>
            <p>WOOOOOW tu fais partie des <?php echo $dbUser->compterNbUsers() ?>
                utilisateurs à avoir un compte sur le site, 
                bravo tu gères ! Tu as compris que ça ne servait à rien et tu es quand même là 
                <br><strong>Bravo à toi !!</strong>
            </p>

            <form action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">Adresse e-mail :</label>
                    <input type="email" id="email" name="email" required placeholder="Entrez votre adresse e-mail">
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required minlength="6" placeholder="Entrez votre mot de passe">
                </div>

                <button type="submit" name="login">Se connecter</button>
            </form>

            <?php
            if ($_SESSION['user_connected']) {
                echo "<p>Bravo t'es déjà connecté</p>";
            } else {
                $_SESSION['user_connected'] = false;
            }

//            require_once('./config/autoload.php');
//
//            use dbManager\DbManagerCRUD;
//
//            $dbUser = new DbManagerCRUD();

            if (filter_has_var(INPUT_POST, 'login')) {
                // Récupérer les données du formulaire
                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                $motDePasse = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

                // Vérifier si les données sont valides
                if ($email && strlen($motDePasse) >= 6) {
                    // Appel d'une méthode pour vérifier les identifiants
                    if ($dbUser->verifierIdentifiants($email, $motDePasse)) {
                        echo "<p>Connexion réussie ! Bienvenue dans le paradis du fun!</p>";

                        $_SESSION['user_connected'] = true;

                        header('Location: index.php');
                        exit();
                    } else {
                        echo "<p style='color: red;'>Erreur : adresse e-mail ou mot de passe incorrect.</p>";
                    }
                } else {
                    echo "<p style='color: red;'>Veuillez entrer des informations valides.</p>";
                }
            }
            ?>
        </main>

        <footer>
            <p>Jonas Du Bois 2024, en galère</p>
        </footer>
    </body>
</html>

