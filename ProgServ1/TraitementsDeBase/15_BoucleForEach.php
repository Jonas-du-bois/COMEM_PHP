<?php

$tab = [2,3,4,5,5,6];

foreach ($tab as $elem) {
    echo $elem,'<br>';
}

echo '<br>';

$tabPoints = [
    "Julie" => 78,
    "Jean" => 12,
    "Simon" => 34,
    "Lise" => 36];

foreach ($tabPoints as $prenom => $nbPoints) {
    echo $prenom, " : ", $nbPoints, " points.", "<br>";
}