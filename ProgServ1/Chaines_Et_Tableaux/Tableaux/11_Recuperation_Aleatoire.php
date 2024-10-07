<?php

$tab = [1,2,3,4,5,6,7,8,9,10];


// Attention à ne pas se faire avoir !!!!
// Ce ne sont pas les valeurs qui sont tirées au hasard mais les indices !
$troisIndicesAuHasard = array_rand($tab,3);

foreach ($troisIndicesAuHasard as $indice) {
    echo "L'indice $indice a été choisi, ce qui correspond à la valeur $tab[$indice]",'<br>';
}