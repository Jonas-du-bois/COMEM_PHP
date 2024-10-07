<?php

$nbMots = compteMots("Le ciel rouge à la fin du jour, du beau temps prédit le retour. Vous êtes des oufs, ");

echo $nbMots;

function compteMots($phrase) {
    $nbMots = 1;

    for ($i = 0; $i < strlen($phrase); $i++) {

            if ($phrase[$i] === ' ' && $i + 1 < strlen($phrase) && $phrase[$i + 1] !== ' ') {
                
                $nbMots++;
                
            }
    }
    return $nbMots;
}
