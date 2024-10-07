<?php

function afficheTab($message, $unTab) {
    $chaine = '[';
    $chaine .= implode(',', $unTab);
    $chaine .= ']';
    echo $message, $chaine,'<br>';
}

$tab1 = [1,2,3,4,5,6];
$tab2 = [2,8,1,4,5];

$tabDiff1 = array_diff($tab1,$tab2);

afficheTab('Différence entre $tab1 et $tab2 ',$tabDiff1);