<?php

echo '<h1>', "Différentes manières d'afficher des tableaux" ,'</h1>';

function afficheTab1($tab) {
    $chaine = '[';
    $chaine .= implode(',', $tab);
    $chaine .= ']';
    echo $chaine,'<br>';
}

function afficheTab2($tab) {
    echo '<pre/>'; var_dump($tab); echo '<br>';
}

function afficheTab3($tab) {
    echo "<pre/>"; print_r($tab); echo '<br>';
}

$tab1 = [1,2,3,4,5];
echo '1 AfficheTab1','<br>';
afficheTab1($tab1);
echo '2 AfficheTab2';
afficheTab2($tab1);
echo '3 AfficheTab3';
afficheTab3($tab1);

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

echo '4 AfficheTab1 => Messages Notice !','<br>';
afficheTab1($tab2);

echo '5 AfficheTab2';
afficheTab2($tab2);

echo '6 AfficheTab3';
afficheTab3($tab2);