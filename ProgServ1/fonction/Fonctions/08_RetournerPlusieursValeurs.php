<?php

//
// POUR RETOURNER PLUSIEURS VALEURS DEPUIS UNE FONCTION, 
// IL SUFFIT DE METTRE LES VALEURS DANS UN TABLEAU


// Une fonction peut retourner plusieurs résultats.
// On met alors ces résultats dans un tableau
function rendPrenoms() {
    return ["Blandin","Bill","Tuco"];
}

// Affichage des prénoms récupérés de la fonction
foreach (rendPrenoms() as $prenom) {
    echo $prenom,"<BR>";
}
echo "<BR>";

// La fonction list(...) permet d'affecter chaque valeur retournée par une fonction dans une variable distincte.
// Voici comment procéder
list($leBon, $laBrute, $leTruand) = rendPrenoms();

//$tab = rendPrenoms();
//$leBon = $tab[0];
//$laBrute = $tab[1];
//$leTruand = $tab[2];

echo $leBon,"<BR>";
echo $laBrute,"<BR>";
echo $leTruand,"<BR>";