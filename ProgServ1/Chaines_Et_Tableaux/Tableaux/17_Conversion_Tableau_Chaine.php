<?php

function afficheTab($message, $unTab) {
    $chaine = '[';
    $chaine .= implode(',', $unTab);
    $chaine .= ']';
    echo $message, $chaine,'<br>';
}

$tab = [1,2,3,4,5,6,7,8,9,10];

// sépare chaque valeur du tableau par un espace + une virgule + un espace
$chaine = implode(' , ',$tab);

echo $chaine,'<br>';

// toutes les valeurs (séparées par un espace + une virgule + un espace) de la chaine sont mise dans un tableau
$tab2 = explode(' , ',$chaine);

afficheTab("Tableau reconstitué : ",$tab2);