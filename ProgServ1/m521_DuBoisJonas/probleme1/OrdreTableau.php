<?php

$tab1 = [8, 1, 5, 2, 4, 6, 3, 7, 3, 6, 2, 10];

function pairImpaire($tab1) {

    $tabPair = [];
    $tabImpair = [];

    foreach ($tab1 as $num) {
        if (fmod($num, 2) == 0) {
            $tabPair[] = $num;
        } else {
            $tabImpair[] = $num;
        }
    }

    sort($tabPair);

    arsort($tabImpair);

    $result = array_merge_recursive($tabPair, $tabImpair);

    echo "<pre>";
    print_r($result);
    echo "<pre>";
}

pairImpaire($tab1);

