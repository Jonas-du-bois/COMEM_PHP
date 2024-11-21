<?php
// Connexion à la base de données et chargement des classes nécessaires
require_once('./dbManager/DbManagerCRUD.php');
require_once('./dbManager/Users.php');
require_once('./dbManager/I_ApiCRUD.php');

use dbManager\DbManagerCRUD;
use dbManager\Users;

$dbUser = new DbManagerCRUD();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleSheet.css">
    <title>Confirmation du mail</title>
</head>
<body>
<div class="confirmation-container">
    <?php
    // Récupération du token depuis l'URL et validation
    $token = filter_input(INPUT_GET, 'token', FILTER_DEFAULT);

    if ($token) {
        // Vérifier l'utilisateur correspondant au token
        $user = $dbUser->getUserByToken($token);
        if ($user) {
            // Confirmer l'inscription pour l'utilisateur avec l'ID spécifique
            if ($dbUser->confirmeInscription($user['id'])) {
                echo "<p class='message-confirmation success'>Votre inscription a été confirmée avec succès !</p>";
            } else {
                echo "<p class='message-confirmation error'>Une erreur est survenue lors de la confirmation. Veuillez réessayer plus tard.</p>";
            }
        } else {
            echo "<p class='message-confirmation error'>Lien de confirmation invalide ou expiré.</p>";
        }
    } else { 
        echo "<p class='message-confirmation error'>Aucun token fourni pour la confirmation.</p>";
    }
    ?>

    <!-- Bouton de retour à la page de connexion -->
    <div class="back-to-login">
        <a href="login.php">Retour à la page de connexion</a>
    </div>
</div>
</body>
</html>
