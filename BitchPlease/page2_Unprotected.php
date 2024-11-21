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
                <li><a href="page2_Unprotected.php">Page secrète</a></li>
                
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
                <h1>Bienvenue sur l'interval des cadeaux</h1>
                <p>Ici le nombre de jour entre le dernier cadeau et le prochain s'affichera sous vos yeux</p>

                <?php
                /**
                 * Génère un nombre aléatoire entre 0 et 6 inclus.
                 *
                 * @return int Le nombre aléatoire généré.
                 */
                function generateRandom(): int {
                    // Génération d'un nombre aléatoire entre 0 et 6
                    return rand(0, 6);
                }
                
                // Vérifie si le cookie 'last_gift_day' existe
                if (isset($_COOKIE['last_gift_day'])) {
                    $lastGiftDay = (int)$_COOKIE['last_gift_day'];
                    
                    // Vérifie si le nombre dans le cookie est supérieur à 0 et si le jour actuel est antérieur à ce jour
                    if ($lastGiftDay > 0 && date('j') < $lastGiftDay) {
                        // Le cookie est valide, donc on informe de la prochaine date du cadeau sans le modifier
                        echo "<p>Le prochain cadeau sera le $lastGiftDay<sup>ème</sup> jour.</p>";
                    } else {
                        // Le dernier cadeau est passé ou le cookie est obsolète, donc on génère un nouveau nombre
                        $newGiftDay = generateRandom();
                        echo "<p>Le prochain cadeau sera le $newGiftDay<sup>ème</sup> jour.</p>";
                        
                        // Met à jour le cookie avec la nouvelle valeur
                        setcookie('last_gift_day', $newGiftDay, time() + 3600 * 24 * 30); // Expire dans 30 jours
                    }
                } else {
                    // Si le cookie n'existe pas, on génère un nouveau nombre et on crée le cookie
                    $newGiftDay = generateRandom();
                    echo "<p>Le prochain cadeau sera le $newGiftDay<sup>ème</sup> jour.</p>";
                    
                    // Crée le cookie avec le nombre généré
                    setcookie('last_gift_day', $newGiftDay, time() + 3600 * 24 * 30); // Expire dans 30 jours
                }
                ?>
                
            </main>

             
        <footer>
            <p>Jonas Du Bois 2024, en galère</p>
        </footer>
    </body>
</html>
