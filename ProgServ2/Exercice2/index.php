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
            <ul>
                <li><a href="index.php">Page 1</a></li>
                <li><a href="page2_protected.php">Page 2</a></li>
                <li><a href="login.php">Se connecter</a></li>
                <li><a href="signup.php">S'inscrire</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <h1>Bienvenue sur la Page 1</h1>
        <p>Bienvenue sur la page 1 la page ou tu peux faire tout se que tu veux même s'il n'y a rien à faire de bien interréssant</p>
    </main>
    
    <footer>
        <p>Jonas Du Bois 2024, en galère</p>
    </footer>
</body>
</html>

<?php

//phpinfo();
require_once('./config/autoload.php');

use dbManager\DbManagerCRUD;
use dbManager\Users;

$dbUser = new DbManagerCRUD();
if ($dbUser->creeTable()) {
    echo "Création de la table 'user' réussie, tu gères BG !! <br>";
}


?>