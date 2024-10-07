<?php
//Ecrire un code qui permette de déterminer si deux tableaux contiennent les mêmes valeurs
//$tab1 = ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse'];
//$tab2 = ['10' => 'Max', '2' => 'Jules', '5' => 'Alphonse', '4' => 'Zoé'];

$tab1 = ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse'];
$tab2 = ['10' => 'Max', '2' => 'Jules', '5' => 'Alphonse', '4' => 'Zoé'];

function estUnTabAssociatif($tab) {
    return array_keys($tab) !== range(0, count($tab) - 1);
}

function sontEquivalent($tab1, $tab2) {
    $ok = false;
    if (is_array($tab1) && estUnTabAssociatif($tab1) &&
            is_array($tab1) && estUnTabAssociatif($tab1)) {
        ksort($tab1);
        ksort($tab2);
        $ok = $tab1 === $tab2;
    }
    return $ok;
}

var_dump(sontEquivalent($tab1, $tab2));