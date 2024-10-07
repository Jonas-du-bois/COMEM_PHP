<?php

function afficheTab($tab) {
    echo "<pre/>"; print_r($tab); echo '<br><br>';
}

// chaque coureur a un numéro de dossard
echo 'Tableau initial : ';
$tab = ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse'];
afficheTab($tab);
echo '<br>';

echo 'Tri par nom : ';
asort($tab);
afficheTab($tab);
echo '<br>';

echo 'Tri par nom (alphabétique inverse) : ';
arsort($tab);
afficheTab($tab);
echo '<br>';

echo 'Tri par clé : ';
ksort($tab);
afficheTab($tab);
echo '<br>';

echo 'Tri par clé (décroissantes) : ';
krsort($tab);
afficheTab($tab);
echo '<br>';


