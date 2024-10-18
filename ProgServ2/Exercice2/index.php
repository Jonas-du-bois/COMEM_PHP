<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page 1</title>
    <link rel="stylesheet" href="stylesSheet.css">
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
        <p>Contenu de la Page 1.</p>
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
use dbManager\Personne;

$db = new DbManagerCRUD();
if ($db->creeTablePersonnes()) {
    echo "Création de la table 'personnes' réussie, tu gères BG !! <br>";
}
$user1 = new Personne("Philipe", "Catrine", "Philipe.c@gmail.com", "078'933'81'41");

$user2 = new Personne("Philipo", "Catrino", "Philipe.c@gmail.com", "078'933'81'41");

$id = $db->ajoutePersonne($user1);
if ($id>0) {
    echo "Philipe Caterine a bien été ajouté à la base de données <br>";
}else {
    echo "Strange";
};


$id = $db->ajoutePersonne($user2);
if ($id>0) {
    echo "Philipo Caterino a bien été ajouté à la base de données <br>";
}else {
    echo "Strange";
};


?>