<?php

function afficheTab($message, $unTab) {
    $chaine = '[';
    $chaine .= implode(',', $unTab);
    $chaine .= ']';
    echo $message, $chaine,'<br>';
}

$tab = range(1, 10);
shuffle($tab);
afficheTab("Tableau initial : ",$tab);

sort($tab);
afficheTab("Tableau trié : ",$tab);

rsort($tab);
afficheTab("Tableau trié dans l'ordre inverse : ",$tab);