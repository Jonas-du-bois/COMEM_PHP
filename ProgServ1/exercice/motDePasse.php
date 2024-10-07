<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Formulaire de mot de passe</title>
</head>
<body>
    <form action="motDePasse.php" method="post">
        <label for="motDePasse">Mot de passe :</label>
        <input type="password" id="motDePasse" name="motDePasse">
        <br>
        <input type="submit" name="submit" value="Envoyer">
    </form>
</body>
</html>

<?php
 //Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer le mot de passe
    $motDePasse = filter_input(INPUT_POST, 'motDePasse');

    // Vérifier si le mot de passe est présent et non vide
    if (!empty($motDePasse)) {
        // Hasher le mot de passe
        $motDePasseHash = password_hash($motDePasse, PASSWORD_DEFAULT);

        // Simuler un hash stocké en base de données (à remplacer par le vrai hash stocké)
        $hashStocke = '$2y$10$pyAm0vhMLIpnUuI26jkWnuasjfGMUyP8Sa6PwozAPIqCSA7DduaV.';

        // Vérifier si le mot de passe correspond au hash stocké
        if (password_verify($motDePasse, $hashStocke)) {
            echo "Mot de passe correct. Vous pouvez accéder aux fonctionnalités sécurisées.";
            // Ici, vous pouvez rediriger l'utilisateur vers une autre page ou afficher du contenu sécurisé.
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Veuillez entrer un mot de passe.";
    }
}
?>



<!--

hash du mot de passe 

// Mot de passe réel saisi par l'utilisateur
$motDePasse = "monSuperMotDePasse";

// Hasher le mot de passe
$motDePasseHash = password_hash($motDePasse, PASSWORD_DEFAULT);

// Afficher le hash généré (à des fins d'illustration seulement)
echo "Hash généré : " . $motDePasseHash;

-->

