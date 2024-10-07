<?php

function afficheTab($message, $unTab) {
    $chaine = '[';
    $chaine .= implode(',', $unTab);
    $chaine .= ']';
    echo $message, $chaine,'<br>';
}

$tabAvecDoublons = [5,2,3,4,5,4,5];
afficheTab('Avec doublons ',$tabAvecDoublons);

$tabSansDoublons = array_unique($tabAvecDoublons);

afficheTab('Sans doublons ',$tabSansDoublons);