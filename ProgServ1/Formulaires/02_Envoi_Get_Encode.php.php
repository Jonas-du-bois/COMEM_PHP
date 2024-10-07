<?php

$prenom = "Archibald";
$nom = "Ad'hoc";
$lien = "02_Reception_Get.php?";

// Pour éviter les problèmes d'encodage (avec les apostrophes par exemple)
//
// On peut encoder les variables à l'aide de fonctions prédéfinies :
//    urlencode(...)           : pour les variables simples
//    http_build_query(...)    : pour un tableau
//    
// Pour afficher correctement les variables encodées on utilise la fonction prédéfinie :
//    htmlspecialchars(...)

$queryString = $lien . 'nom=' . urlencode($nom) . '&prenom=' . urlencode($prenom);
echo "<a href='" . $queryString . "'>Capitaine Ad'hoc</a><br>";

$donnees = ['prenom' => 'Tim', 'nom' => "O'Reilly"];
$queryString2 = $lien . http_build_query($donnees);
echo "<a href='" . $queryString2 . "'>Tim O'Reilly</a><br><br>";

// https://www.php.net/manual/fr/function.urlencode.php
// https://www.php.net/manual/fr/function.http-build-query.php
