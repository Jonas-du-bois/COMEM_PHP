<?php

//Soit une chaine contenant un nombre variable de prénoms séparés par des espaces.
//$chaine1 = "Jules Max Zoé Alphonse";
//Ecrire un code qui affiche les noms de la manière suivante :
//	Jules	                    (si la chaîne ne contient qu'un prénom)
//	Jules et Max                (si la chaîne contient deux prénoms)
//	Jules, Max et Zoé           (si la chaîne contient trois prénoms)
//	Jules, Max, Zoé et Alphonse (si plus de x prénoms)

$chaine1 = "Jules Max Zoé Alphonse";

function traiteChaine($chaine) {
    $tab1 = explode(" ", $chaine);
    $chaineTmp = '';
    $nb = count($tab1) - 1;
    if ($nb > 0) {
        for ($i = 0; $i < $nb; $i++) {
            if ($i === $nb - 1) {
                $chaineTmp .= $tab1[$i];
            } else {
                $chaineTmp .= $tab1[$i] . ', ';
            }
        }
        $chaineTmp .= " et " . $tab1[$i];
    } else {
        $chaineTmp = $chaine;
    }
    return $chaineTmp;
}

$chaine2 = traiteChaine($chaine1);
echo $chaine2;
