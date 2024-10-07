<?php

$tab = [4, 5, 7, 2, 8, 1, 20, 4, 3];

function rendMinMax($unTab) {
    
    sort($unTab);
    $min = $unTab[0];
    $max = $unTab[array_key_last($unTab)];
    return ['min' => $min, 'max' => $max];
}

$minMax = rendMinMax($tab);

echo 'min : ', $minMax['min'], '<br>';
echo 'max : ', $minMax['max'], '<br>';
