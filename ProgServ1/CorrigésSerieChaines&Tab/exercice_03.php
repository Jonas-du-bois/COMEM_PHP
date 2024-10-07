<?php

//Soit deux tableaux :
//$tab1 = [1,2,3,4,5];
//$tab2 = [5,3,1,2,4];
//Ecrire un code qui permette de déterminer si deux tableaux contiennent les mêmes valeurs

$tab1 = [1, 2, 3, 4, 5];
$tab2 = [5, 3, 1, 4, 2];

function estUnTabAssociatif($tab) {
    return array_keys($tab) !== range(0, count($tab) - 1);
}

function sontEquivalent($tab1, $tab2) {
    $ok = false;
    if (is_array($tab1) && !estUnTabAssociatif($tab1) &&
            is_array($tab1) && !estUnTabAssociatif($tab1)) {
        sort($tab1);
        sort($tab2);
        $ok = $tab1 === $tab2;
    }
    return $ok;
}

var_dump(sontEquivalent($tab1, $tab2));