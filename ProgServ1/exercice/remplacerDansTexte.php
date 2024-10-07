<?php

// Fonction pour remplacer toutes les occurrences d'un mot dans un texte
function remplacerMot($texte, $motARemplacer, $nouveauMot) {
    // Utilisation de str_replace pour remplacer toutes les occurrences
    $texteModifie = str_replace($motARemplacer, $nouveauMot, $texte);
    return $texteModifie;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>RemplacerDansLetexte</title>
    </head>
    <body>
        <form action="" method="post">
            <label for="message">Texte :</label>
            <textarea id="message" name="message"></textarea>
            <br><br>
        <br>
        <form action="" method="post">
            <label for="message">mot :</label>
            <textarea id="mot" name="mot"></textarea>
            <input type="submit" value="Envoyé">
        </form>
    </body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['message'])) {
        // Récupérer la note envoyée via le formulaire
        $texte = $_POST['message'];
        if (isset($_POST['mot'])) {
            // Récupérer la note envoyée via le formulaire
            $mot = $_POST['mot'];

// Remplacement du mot "Fourmi" par "Souris"
            $texteModifie = remplacerMot($texte, "Fourmi", $mot);

// Affichage du texte modifié
            echo "<pre>";
            echo $texteModifie;
            echo "</pre>";
        }
    }
}
?>

