<?php
//Soit deux tableaux :
//$tab1 = [1,2,3,4,5,6];
//$tab2 = [2,8,1,4,5];
//Ecrire un code qui détermine quels éléments se trouvent dans les deux tableaux
//Ex : 1,2,4,5


$tab1 = [1,2,3,4,5,6];
$tab2 = [2,8,1,4,5];

echo '<pre/>'; var_dump(array_intersect($tab1, $tab2));