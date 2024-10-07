<?php
$tab1 = [1, 2, 3, 4, 5];
$tab2 = [5, 3, 1, 4, 2];

sort($tab2);
sort($tab1);

$ok = $tab1 === $tab2;

if ($ok) {
    echo "Les tableaux contiennent les mêmes valeurs";
}else{
    echo "Les tableaux ne contiennent pas les mêmes valeurs";
}

