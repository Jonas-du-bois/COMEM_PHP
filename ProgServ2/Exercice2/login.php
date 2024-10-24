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
            <ul>
                <li><a href="index.php">Page 1</a></li>
                <li><a href="page2_protected.php">Page 2</a></li>
                <li><a href="login.php">Se connecter</a></li>
                <li><a href="signup.php">S'inscrire</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <h1>Connecte-toi !</h1>
        <p>WOOOOOW tu fais partie des 3 utilisateurs à avoir un compte sur le site, 
            bravo tu gères ! Tu as compris que ça ne servait à rien et tu es quand même là 
            <br><strong>Bravo à toi !!</strong>
        </p>
        
        <form action="login.php" method="POST">
            <!-- Champ pour l'adresse e-mail -->
            <div class="form-group">
                <label for="email">Adresse e-mail :</label>
                <input type="email" id="email" name="email" required placeholder="Entrez votre adresse e-mail">
            </div>

            <!-- Champ pour le mot de passe -->
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required minlength="6" placeholder="Entrez votre mot de passe">
            </div>

            <!-- Bouton de soumission -->
            <button type="submit" name="login">Se connecter</button>
        </form>

        <?php
        require_once('./config/autoload.php');

        use dbManager\DbManagerCRUD;

        // Instancier la classe pour accéder à la base de données
        $dbUser = new DbManagerCRUD();

        if (filter_has_var(INPUT_POST, 'login')) {
            // Récupérer les données du formulaire
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $motDePasse = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

            // Vérifier si les données sont valides
            if ($email && strlen($motDePasse) >= 6) {
                // Appel d'une méthode pour vérifier les identifiants
                if ($dbUser->verifierIdentifiants($email, $motDePasse)) {
                    // Connexion réussie, vous pouvez rediriger vers une autre page
                    echo "<p>Connexion réussie ! Bienvenue.</p>";
                    // Redirection vers une page protégée (décommenter si nécessaire)
                    // header('Location: page2_protected.php');
                    // exit();
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

