<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styleSheet.css">
        <title>Signup</title>
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
            <h1>Bienvenue sur l'inscription</h1>
            <p>Toi aussi tu veux un nouveau compte ? <br> Super, inscris toi dès à présent et gagnes... euh ... bah rien parce qu'il n'y pas assez de budget 
                <br> P Diddy a encore tout mis dans la lub à ses soirées. ATTENTION à la glissade !</p>

            <form action="signup.php" method="POST">
                <div class="form-group">
                    <label for="firstname">Prénom :</label>
                    <input type="text" id="firstname" name="firstname" required minlength="3" maxlength="20" placeholder="Entrez votre prénom">
                </div>

                <div class="form-group">
                    <label for="lastname">Nom :</label>
                    <input type="text" id="lastname" name="lastname" required minlength="3" maxlength="20" placeholder="Entrez votre nom">
                </div>

                <div class="form-group">
                    <label for="email">Adresse e-mail :</label>
                    <input type="email" id="email" name="email" required placeholder="Entrez votre adresse e-mail">
                </div>

                <div class="form-group">
                    <label for="phone">Numéro de téléphone :</label>
                    <input type="tel" id="phone" name="phone" required placeholder="Entrez votre numéro de téléphone">
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required minlength="6" placeholder="Entrez votre mot de passe">
                </div>

                <button type="submit" name="submit">Créer un compte</button>
            </form>

            <?php
            require_once('./config/autoload.php');

            use dbManager\DbManagerCRUD;
            use dbManager\Users;

            $dbUser = new DbManagerCRUD();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Récupérer les données du formulaire avec filter_input
                $nom = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
                $prenom = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                $noTel = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
                $motDePasse = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

                // Regex pour valider les prénoms et noms (lettres et espaces uniquement)
                $namePattern = "/^[a-zA-ZÀ-ÿ' -]{3,20}$/";

                // Regex pour le numéro de téléphone (format international ou local)
                $telPattern = "/^\+?[0-9]{10,15}$/"; // accepte numéros locaux et internationaux

                $errors = []; // Tableau pour stocker les messages d'erreur
                // Validation du prénom
                if (!preg_match($namePattern, $prenom)) {
                    $errors[] = "Le prénom est invalide. Veuillez utiliser uniquement des lettres et des espaces.";
                }

                // Validation du nom
                if (!preg_match($namePattern, $nom)) {
                    $errors[] = "Le nom est invalide. Veuillez utiliser uniquement des lettres et des espaces.";
                }

                // Validation de l'adresse e-mail
                if (!$email) {
                    $errors[] = "L'adresse e-mail est invalide.";
                }

                // Validation du numéro de téléphone
                if (!preg_match($telPattern, $noTel)) {
                    $errors[] = "Le numéro de téléphone est invalide. Veuillez entrer un numéro valide (10 à 15 chiffres).";
                }

                // Validation du mot de passe
                if (strlen($motDePasse) < 6) {
                    $errors[] = "Le mot de passe doit comporter au moins 6 caractères.";
                }

                // Afficher les erreurs
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo "<p style='color: red;'>$error</p>";
                    }
                } else {
                    // Si toutes les validations passent, traiter les données
                    $newUser = new Users($prenom, $nom, $email, $noTel, $motDePasse);
                    try {
                        $id = $dbUser->ajoutePersonne($newUser);
                        echo "<p style='color: green;'>Bravo, tu as réussi ton inscription !</p>";
                    } catch (PDOException $e) {
                        // Vérification du code d'erreur pour la contrainte d'unicité
                        if ($e->getCode() == 23000) {  // 23000 est le code pour les violations de contrainte d'unicité
                            echo "<p style='color: red;'>Le numéro de téléphone ou l'adresse mail que vous avez fourni est déjà utilisé. Veuillez en essayer un autre.</p>";
                        } else {
                            // Pour d'autres types d'erreurs
                            echo "<p style='color: red;'>Une erreur est survenue lors de l'ajout de l'utilisateur. Veuillez réessayer.</p>";
                            // Optionnel: Afficher l'erreur brute 
                            //echo "<p style='color: red;'>Erreur: " . $e->getMessage() . "</p>";
                        }
                    }
                }
            }
            ?>

        </main>

        <footer>
            <p>Jonas Du Bois 2024, en galère</p>
        </footer>
    </body>
</html>


