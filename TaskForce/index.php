<?php
require 'lib/vendor/autoload.php';
use Google\Cloud\Translate\V2\TranslateClient;

// Démarrez une session
session_start();

// Créez une instance du client Google Translate avec votre clé API
$translate = new TranslateClient([
    //'key' => 
    'verify' => false // Désactiver la vérification SSL (uniquement pour le développement)
]);

// Définissez la langue cible par défaut (si aucune langue n'est définie dans la session)
if (!isset($_SESSION['target_language'])) {
    $_SESSION['target_language'] = 'fr';
}

// Si l'utilisateur appuie sur le bouton de changement de langue
if (isset($_POST['toggle_language'])) {
    $_SESSION['target_language'] = ($_SESSION['target_language'] === 'fr') ? 'en' : 'fr';
}

// Définissez la langue cible en fonction de la session
$targetLanguage = $_SESSION['target_language'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleSheet.css">
    <title>Accueil</title>
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
                if (isset($_SESSION['user_connected']) && $_SESSION['user_connected']) {
                    echo '<li><a href="logout.php">Déconnexion</a></li>';
                } else {
                    echo '<li><a href="login.php">Se connecter</a></li>';
                    echo '<li><a href="signup.php">S\'inscrire</a></li>';
                }
                ?>
                <!-- Bouton de changement de langue -->
                <li>
                    <form method="post" style="display: inline;">
                        <button type="submit" name="toggle_language" class="language-toggle">
                            <?php echo ($_SESSION['target_language'] === 'fr') ? 'EN' : 'FR'; ?>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Bienvenue sur la Page d'accueil</h1>

        <?php
        // Texte de base en français
        $textToTranslate = "Tu es officiellement arrivé sur la page où... il n'y a absolument rien de spécial à faire. 
            Eh oui, tu peux t'installer, te détendre, et admirer ce magnifique espace blanc. Ne t'inquiète 
            pas, même si ça ressemble à du vide intersidéral, c'est intentionnel. Ici, tu peux faire 
            absolument tout ce que tu veux... tant que ce 'tout' n'implique rien du tout. Bref, bienvenue 
            dans le calme avant la tempête (ou pas).";

        // Traduire le texte si la langue cible est différente de 'fr'
        if ($targetLanguage !== 'fr') {
            $translation = $translate->translate($textToTranslate, [
                'target' => $targetLanguage
            ]);
            $textToDisplay = $translation['text'];
        } else {
            $textToDisplay = $textToTranslate;
        }
        ?>

        <p class="styled-text"><?php echo $textToDisplay; ?></p>

        <?php
        // Affichage du message de connexion
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
