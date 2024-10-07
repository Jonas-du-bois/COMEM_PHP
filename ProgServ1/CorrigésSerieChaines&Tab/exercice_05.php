<?php

//Idem 5 mais ne tenir compte que des valeurs (pas les clés)
//$tab1 = ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse'];
//$tab2 = ['22' => 'Alphonse', '11' => 'Jules', '44' => 'Max', '55' => 'Zoé'];

$tab1 = ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse'];
$tab2 = ['22' => 'Alphonse', '11' => 'Jules', '44' => 'Max', '55' => 'Zoé'];

function estUnTabAssociatif($tab) {
    return array_keys($tab) !== range(0, count($tab) - 1);
}

function sontEquivalent($tab1, $tab2) {
    $ok = false;
    if (is_array($tab1) && estUnTabAssociatif($tab1) &&
            is_array($tab1) && estUnTabAssociatif($tab1)) {
        $valeursTab1 = array_values($tab1);
        $valeursTab2 = array_values($tab2);
        sort($valeursTab1);
        sort($valeursTab2);
        $ok = $valeursTab1 === $valeursTab2;
    }
    return $ok;
}

var_dump(sontEquivalent($tab1, $tab2));
