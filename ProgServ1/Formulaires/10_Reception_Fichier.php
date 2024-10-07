<?php

// https://www.php.net/manual/fr/features.file-upload.errors.php
error_reporting(32767); //32767 => E_ALL
ini_set("display_errors",1);


$codeErreur = $_FILES['fichier']['error'];
if ($codeErreur == UPLOAD_ERR_INI_SIZE) {
    echo "Le fichier est plus grand que la taille max autorisée par PHP", '<br>';
} elseif ($codeErreur == UPLOAD_ERR_FORM_SIZE) {
    echo "Le fichier est plus grand que la taille autorisée par le formulaire", '<br>';
} elseif ($codeErreur == UPLOAD_ERR_PARTIAL) {
    echo "Le fichier n'a été que partiellement uploadé", '<br>';
} elseif ($codeErreur == UPLOAD_ERR_NO_FILE) {
    echo "Aucun fichier n'a été uploadé", '<br>';
} elseif ($codeErreur != 0) {
    echo "bizzare : " . $codeErreur . '<br>';
} else {
    echo "Fichier correctement uploadé !", '<br>';
    $nomFichier = $_FILES['fichier']['name'];
    $tailleFichier = $_FILES['fichier']['size'];
    $nomTemporaire = $_FILES['fichier']['tmp_name'];
    $typeFichier = $_FILES['fichier']['type'];

    echo 'Nom du fichier source : ', $nomFichier, '<br>';
    echo 'Taille du fichier : ', $tailleFichier, '<br>';
    echo 'Nom du fichier temporaire sur le serveur : ', $nomTemporaire, '<br>';
    echo 'Type de fichier : ', $typeFichier, '<br>';
    // Si on ne sauvegarde pas le fichier temporaire quelque part, il est supprimé automatiquement
    $destination = 'tmp_ne_pas_effacer_svp/tmp.txt';
    if (move_uploaded_file($nomTemporaire, $destination)) {
        echo "Le fichier a été correctement déplacé dans le réperoitre /tmp_ne_pas_effacer_svp et se nomme maintenant 'tmp.txt'", '<br>';
        echo "Voici le contenu du fichier : ", '<br>';
        // voici un exemple de code permettant de parcourir l'entier du fichier
        $lignes = file($destination);
        foreach ($lignes as $ligne) {
            echo $ligne, '<br>';
        }
        echo '<br><br>';
    }
}