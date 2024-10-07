<?php

$tab1 = [1,5,7,9,11,11,13,15,18];
$tab2 = [1,2,6,8,10,11,14,20,25,40];

ComparateurDeTableau($tab1,$tab2);

function ComparateurDeTableau($tab1,$tab2){
    
    $longueurTab1 = count($tab1);
    $longueurTab2 = count($tab2);
    
    if ($longueurTab1 == $longueurTab2) {
        echo 0;
    }
    if ($longueurTab1 > $longueurTab2) {
        echo -1;
    }
    if ($longueurTab1 < $longueurTab2) {
        echo 1;
    }
}
