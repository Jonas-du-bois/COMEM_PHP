<?php
// Démarrer la session
session_start();

// Créer un cookie
setcookie("nom_utilisateur", "Jonas", time() + 86400, "/");

// Lire le cookie
if(isset($_COOKIE["nom_utilisateur"])) {
    echo "Nom d'utilisateur : " . $_COOKIE["nom_utilisateur"];
} else {
    echo "Le cookie 'nom_utilisateur' n'existe pas.";
}

// Supprimer le cookie
setcookie("nom_utilisateur", "", time() - 3600, "/");

classExemple
?>


