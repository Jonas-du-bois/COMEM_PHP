<?php

function afficheTab($message, $unTab) {
    $chaine = '[';
    $chaine .= implode(',', $unTab);
    $chaine .= ']';
    echo $message, $chaine,'<br>';
}

$tab = ['img1','img2','img3','img4','img5','img6','img7','img8','img9','img10','img11','img12'];
shuffle($tab);

afficheTab("Tableau initial : ",$tab);

// Attention img1 et suivi de img11 (ordre alphabétique !)
sort($tab);
afficheTab("Tableau trié ????? : ",$tab);

// Du coup c'est natsort() qui faut utiliser
natsort($tab);
afficheTab("Tableau trié par ordre naturel : ",$tab);


