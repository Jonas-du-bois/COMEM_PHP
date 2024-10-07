<?php

function afficheTab($message, $unTab) {
    $chaine = '[';
    $chaine .= implode(',', $unTab);
    $chaine .= ']';
    echo $message, $chaine,'<br>';
}

$tab1 = [1,2,3,4,5];
$tab2 = [5,6,7,8,9];

$tabFus = array_merge($tab1,$tab2);
afficheTab("Tableau 1 : ",$tab1);
afficheTab("Tableau 2 : ",$tab2);
afficheTab("Tableaux 1 et 2 fusionnés : ",$tabFus);
echo '<br>';

// On peut fusionner des tableaux associatifs avec l'opérateur +
$tab3 = ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse'];
$tab4 = ['5' => 'Fritz', '1' => 'Louis', '8' => 'Chris', '7' => 'Auguste'];
// Attention : comme il y a deux fois la clé 5, php ne garde que la 1ère
echo '<pre/>';
echo 'Tableau 3','<br>';
print_r($tab3);
echo '<br>','Tableau 4','<br>';
print_r($tab4);
$tabFus2 = $tab3 + $tab4;
echo '<br>','Tableaux 3 et 4 fusionnés','<br>';
print_r($tabFus2);
echo '<br>','Les tableaux ont bien été fusionnés, mais Fritz a disparu car il y avait deux clés avec la valeur 5','<br>';

// Attention pièges !!!!!
// Piège 1 : Le + ne fusionne pas des tableaux conventionnels
echo '<br><br>Pièges : <br>';
$tabFus = $tab1 + $tab2;
afficheTab("Tableaux fusionnés (bis) : ",$tabFus);

// Piège 2 : La fonction array_merge(...) fonctionne avec les tableaux associatifs,
//           Mais ! ... réorganise les clés !!
$tabFus2 = array_merge($tab3,$tab4);
echo '<pre/>'; print_r($tabFus2);