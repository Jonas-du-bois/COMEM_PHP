<?php
//Soit deux tableaux :
//$tab1 = [1,2,3,4,5,6];
//$tab2 = [2,8,1,4,5];
//Ecrire un code qui détermine quels éléments ne se trouvent pas dans les deux tableaux
//Ex : 3,6,8

$tab1 = [1,2,3,4,5,6];
$tab2 = [2,8,1,4,5];

$tab = array_merge(array_diff($tab1,$tab2),array_diff($tab2,$tab1));

echo '<pre/>'; var_dump($tab);