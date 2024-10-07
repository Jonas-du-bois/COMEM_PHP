<?php

function afficheTab($message, $unTab) {
    $chaine = '[';
    $chaine .= implode(',', $unTab);
    $chaine .= ']';
    echo $message, $chaine,'<br>';
}

$tab = [1,2,3,4,5,6,7,8];
afficheTab("Tableau initial : ",$tab);

$sousTab = array_slice($tab,2,3); // a partir de l'index 2 récupérer trois valeurs
afficheTab("Portion du tableau initial : ",$sousTab);

$sousTab2 = array_slice($tab,3); // tout récupérer à partir le l'index 3
afficheTab("Portion du tableau initial : ",$sousTab2);

$artistes = array(
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

echo '<pre/>';print_r($artistes);'<br>';
$noms = array_column($artistes,'nom');
echo '<br>','Noms : ','<pre/>';print_r($noms);'<br>';

