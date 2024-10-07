<?php

$tab = array(
    array(
        "nom" => "Amy",
        "prenom" => "Winehouse",
        "dateNaissance" => new DateTime('14-09-1983')
    ),
    array(
        "nom" => "Janis",
        "prenom" => "Joplin",
        "dateNaissance" => new DateTime('19-01-1943')
    ),
    array(
        "nom" => "Jo",
        "prenom" => "Bar",
        "dateNaissance" => new DateTime('19-01-1943')
    ),
    array(
        "nom" => "Janis",
        "prenom" => "Siegel",
        "dateNaissance" => new DateTime('12-01-1990')
    ),
);

// $tab ne contient pas de clé correspondantes à la valeur "Jo", il contient des sous tableaux
$cle0 = array_search("Jo",$tab);
echo !$cle0 ? 'Pas de clé correspondante à "Jo"' : 'La clé correspondante à "JO" est '.$cle0, '<br>';
// $tab[2] contient la valeur "Jo", sa clé est "nom"
$cle1 = array_search("Jo",$tab[2]);
echo !$cle1 ? 'Pas de clé correspondante à "Jo"' : 'La clé correspondante à "JO" est '.$cle1, '<br>';

// $tab ne contient pas de clé nommée 'nom'
echo array_key_exists('nom',$tab) ? "La clé 'nom' existe" : "La clé 'nom' n'existe pas", '<br>';
// $tab[2] contient une clé nommée 'nom'
echo array_key_exists('nom',$tab[2]) ? "La clé 'nom' existe" : "La clé 'nom' n'existe pas", '<br>';