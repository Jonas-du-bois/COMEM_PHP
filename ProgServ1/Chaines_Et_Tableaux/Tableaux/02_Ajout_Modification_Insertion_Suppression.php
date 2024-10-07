<?php

$tab = [1, 2, 3, 4];

function afficheTab($message, $unTab) {
    $chaine = '[';
    $chaine .= implode(',', $unTab);
    $chaine .= ']';
    echo $message, $chaine,'<br>';
}

afficheTab("Tableau initial : ",$tab);

$tab[] = 5;  // pour ajouter un element à la fin
afficheTab("Ajout à la fin : ",$tab);

$tab[0] = 0; // Attention, ne décale pas les éléments
afficheTab("Modification d'une valeur : ", $tab);

$val1 = array_shift($tab); //supprime la 1ère valeur du tableau et la récupère avec $val
afficheTab("Suppression première valeur du tableau : ", $tab);
echo "La valeur $val1 a été supprimée", '<br>';

$val2 = array_pop($tab); //supprime la dernière valeur du tableau
afficheTab("Suppression de la dernière valeur du tableau : ", $tab);
echo "La valeur $val2 a été supprimée", '<br>';

array_unshift($tab, 1); //ajout au début du tableau, Tous les éléments sont automatiquement décalés ;-)
afficheTab("Ajout au début du tableau : ", $tab);

$val = -666;
$position = 2;
$remplacement = 0;
array_splice($tab, $position, $remplacement, $val); // ajout d'une valeur dans le tableau à la position 3
afficheTab("Ajout au milieu du tableau : ", $tab);

unset($tab[2]); //supprime la valeur du tableau et décale les éléments
afficheTab("Suppression au milieu du tableau : ", $tab);