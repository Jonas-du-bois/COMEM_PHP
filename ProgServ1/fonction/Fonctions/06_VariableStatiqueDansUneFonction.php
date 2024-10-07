<?php

// Une fonction peut contenir une variable statique
// Celle-ci doit alors être initialisée
function affiche($message, $afficheCompteur=false) {
    static $compteurAppel = 0; // REMARQUE : Cette affectation n'aura lieu que lors du 1e appel ! (Lorsque cette variable n'existe pas)
    $compteurAppel++;
    echo $message,"<BR>";
    echo $afficheCompteur ? 'La fonction affiche() a été appelée ' . $compteurAppel . " fois<BR>" : '';    
}

affiche("Salut");
affiche("Bonjour");
affiche("Hello");
affiche("Ciao",true);