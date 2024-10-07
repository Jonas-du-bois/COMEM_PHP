<?php
$nbEssai = 0;
$nbMax = 150;

do {
    $randomNb = rand(100, 200);
    $nbEssai++;
    }while ($randomNb != 150);
    echo $nbEssai;

