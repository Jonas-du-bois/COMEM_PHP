<?php

function afficheTab($message, $unTab) {
    $chaine = '[';
    $chaine .= implode(',', $unTab);
    $chaine .= ']';
    echo $message, $chaine,'<br>';
}

$tab = ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse'];
echo "Tableau original : ['2' => 'Jules', '10' => 'Max', '4' => 'Zoé', '5' => 'Alphonse']",'<br>';
$cles = array_keys($tab);
afficheTab("Clés : ",$cles);

$valeurs = array_values($tab);
afficheTab("Valeurs : ",$valeurs);

echo '<br>','On flippe le tableau','<br>';
$tabFlippe = array_flip($tab);
echo "Tableau flippé : ['Jules' => '2', 'Max' => '10', 'Zoé' => '4', 'Alphonse' => '5']",'<br><br>';

$cles2 = array_keys($tabFlippe);
afficheTab("Clés : ",$cles2);

$valeurs2 = array_values($tabFlippe);
afficheTab("Valeurs : ",$valeurs2);