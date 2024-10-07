<?php

// Soit les deux tableaux suivants :
// $tab1 = ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse'];
// $tab2 = ['5' => 'Fritz', '1' => 'Louis', '8' => 'Chris', '7' => 'Auguste'];
//Ecrire un code qui fusionne deux tableaux. Si des clés sont identiques, on associera leur valeurs dans un sous-tableau.
//Exemple :
//$tabFusion devra contenir  ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => ['Alphonse', 'Fritz'],
//                         '1' => 'Louis', '8' => 'Chris', '7' => 'Auguste']


$tab1 = ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse'];
$tab2 = ['5' => 'Fritz', '1' => 'Louis', '8' => 'Chris', '7' => 'Auguste'];

function estUnTabAssociatif($tab) {
    return array_keys($tab) !== range(0, count($tab) - 1);
}

function fusionne($tab1, $tab2) {
    $tabTmp = [];
    if (is_array($tab1) && estUnTabAssociatif($tab1) &&
            is_array($tab2) && estUnTabAssociatif($tab2)) {
        foreach ($tab1 as $cle => $valeur) {
            if (array_key_exists($cle, $tab2)) {
                if ($valeur !== $tab2[$cle]) {
                    $tabTmp[$cle] = [$valeur, $tab2[$cle]];
                } else {
                    $tabTmp[$cle] = $valeur;
                }
            } else {
                $tabTmp[$cle] = $valeur;
            }
        }
        foreach ($tab2 as $cle => $valeur) {
            if (!array_key_exists($cle, $tabTmp)) {
                $tabTmp[$cle] = $valeur;
            }
        }
    }
    return $tabTmp;
}

echo '<pre/>'; var_dump(fusionne($tab1, $tab2));


