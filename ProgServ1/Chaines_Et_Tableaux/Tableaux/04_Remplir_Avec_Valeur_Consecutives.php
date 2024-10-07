<?php

function afficheTab($message, $unTab) {
    $chaine = '[';
    $chaine .= implode(',', $unTab);
    $chaine .= ']';
    echo $message, $chaine,'<br>';
}

$tab1 = range(15,25);
afficheTab("Valeurs consécutives numériques : ",$tab1);

$tab2 = range('i','w');
afficheTab("Valeurs consécutives alphabet : ",$tab2);
