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
            <ul>
                <li><a href="index.php">Page 1</a></li>
                <li><a href="page2_protected.php">Page 2</a></li>
                <li><a href="login.php">Se connecter</a></li>
                <li><a href="signup.php">S'inscrire</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <h1>Bienvenue sur la Page 2, la page qui est protégé ! </h1>
        <p>Si tu es arrivée jusque là tu as réussi à créer un compte et tu n'as 
            pas tenté de casser mon code parce que tu es un bon utilisateur </p>
    </main>
    
    <footer>
        <p>Jonas Du Bois 2024, en galère</p>
    </footer>
</body>
</html>

<?php
//phpinfo();
require_once('./config/autoload.php');

?>

