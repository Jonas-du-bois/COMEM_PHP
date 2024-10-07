<?php

//
// EXEMPLE 1
//
// Une fonction peut retourner une valeur 
function fonctionRetour() {
    return 5;
}

// permet de récupérer la valeur retournée par la fonction
$retour = fonctionRetour();
echo $retour, "<BR>";


//
// EXEMPLE 2
//
// Une fonction paramètrée avec valeur de retour
function fonctionAdditionne($val1, $val2, $val3=0) {
    $total = $val1 + $val2 + $val3;
    return $total;
}

echo fonctionAdditionne(10, 20), "<BR>";
echo fonctionAdditionne(10, 20, 25.5), "<BR>";
