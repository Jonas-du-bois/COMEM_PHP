<?php
$tab1 = [1, 5, 7, 9, 11, 11, 13, 15, 18];
$tab2 = [1, 2, 6, 8, 10, 11, 14, 20];

$mixTab = MixTableau($tab1, $tab2);

function MixTableau($tab1, $tab2) {
    // Initialiser un tableau vide pour stocker les éléments mélangés
    $mixTab = [];

    // Concaténer les deux tableaux en un seul tableau
    $tabConcatene = array_merge($tab1, $tab2);

    // Trier le tableau concaténé
    sort($tabConcatene);

    // Ajouter chaque élément trié dans le tableau mixTab
    foreach ($tabConcatene as $element) {
        $mixTab[] = $element;
    }

    return $mixTab;
}

// Afficher le tableau résultant
echo "Tableau mélangé : ";
print_r($mixTab);



