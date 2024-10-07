<?php

$tab = [1,2,3,4,5,6,7,8,9];

$nbElemParTab = 4;
$tabs = array_chunk($tab,$nbElemParTab);

echo 'Le tableau $tab a été découpé en ',count($tabs)," tableaux de $nbElemParTab éléments",'<br>';
echo 'Le dernier tableau contient ',count($tabs[count($tabs)-1]),' élément(s).','<br>';