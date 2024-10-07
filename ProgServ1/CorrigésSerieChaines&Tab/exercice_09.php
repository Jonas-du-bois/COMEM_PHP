<?php

//Ecrire un code qui affiche le contenu d'un tableau associatif sur une ligne, comme à sa déclaration
//Exemple : 
//$tab1 = ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse'];
//afficheTab($tab1); // Doit afficher ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse']





function estUnTabAssociatif($tab) {
    return array_keys($tab) !== range(0, count($tab) - 1);
}

function afficheTab($tab, &$premiereFois = true, $cle = '') {

    if (is_array($tab)) {
        $premiereFois = true;
        $cache = true;
        if (estUnTabAssociatif($tab)) {
            $cache = false;
        }
        echo '[';
        foreach ($tab as $cle => $valeur) {
            if ($cache) {
                afficheTab($valeur, $premiereFois);
            } else {
                if ($premiereFois) {
                    echo "'", $cle, "' => ";
                    $premiereFois = false;
                } else {
                    echo ", '", $cle, "' => ";
                }
                afficheTab($valeur, $premiereFois, $cle);
            }
        }
        echo ']';
    } else {
        if ($premiereFois) {
            echo "'", $tab, "'";
            $premiereFois = false;
        } else {
            echo $cle!=='' ? " '" : ", '";
            echo $tab, "'";
        }
    }
}

$tab1 = ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse'];
afficheTab($tab1);
echo '<br>';

$tab2 = ['4' => ['Zoé', 'zigi'], '2' => 'Jules', '10' => ['Max', 'Fritz', 'James'], '5' => ['nom' => 'Joe', 'prenom' => 'Bar']];
afficheTab($tab2);

