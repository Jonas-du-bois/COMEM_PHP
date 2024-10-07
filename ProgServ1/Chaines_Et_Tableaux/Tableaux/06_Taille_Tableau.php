<?php

$tab0 = [1,2,3,4,5];
echo 'La taille du tableau $tab1 est : ',count($tab0),'<br>';

$tab1 = [1,2,[10,20,30],4,5];
echo 'La taille du (sous) tableau dans $tab1 est : ',count($tab1[2]),'<br>';

$matrice = [[1,2],
            [10,20],
            [100,200]];
$pt1 = $matrice[0];
echo '(',$pt1[0],',',$pt1[1],')','<br>';
$pt2 = $matrice[1];
echo '(',$pt2[0],',',$pt2[1],')','<br>';
echo 'La taille de $matrice est : ',count($matrice),'<br>';
echo 'La taille complète (avec indices 0,1 et 2) de $matrice est : ',count($matrice,COUNT_RECURSIVE),'<br>';

$tab2 = array(
    array(
        "nom" => "Amy",
        "prenom" => "Winehouse",
        "dateNaissance" => new DateTime('14-09-1983')
    ),
    array(
        "nom" => "Janis",
        "prenom" => "Joplin",
        "dateNaissance" => new DateTime('19-01-1943')
    ),
    array(
        "nom" => "Jo",
        "prenom" => "Bar",
        "dateNaissance" => new DateTime('19-01-1943')
    ),
    array(
        "nom" => "Janis",
        "prenom" => "Siegel",
        "dateNaissance" => new DateTime('12-01-1990')
    ),
);
echo 'La taille de $tab2 est : ',count($tab2),'<br>';
echo 'La taille du (sous) tableau (nom, prenom, dateNaissance) est : ',count($tab2[0]),'<br>';
echo 'Date : ',$tab2[3]["dateNaissance"]->format("d-m-y");
