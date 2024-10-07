<?php

function afficheTab($message, $unTab) {
    $chaine = '[';
    $chaine .= implode(',', $unTab);
    $chaine .= ']';
    echo $message, $chaine,'<br>';
}

$tab1 = [5,2,3,4,5,6];
$tab2 = [3,5,1,6,5];

$tabInter = array_intersect($tab1,$tab2);

afficheTab('Intersection entre $tab1 et $tab2 ',$tabInter);

