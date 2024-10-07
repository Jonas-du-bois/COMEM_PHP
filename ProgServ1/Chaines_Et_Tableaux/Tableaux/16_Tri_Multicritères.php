<?php

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

echo "On peut trier les tableaux multidimensionnel selon plusieurs critères","<BR>"; // http://php.net/manual/en/function.array-multisort.php 
$dates = array_column($artistes, "dateNaissance");
$noms  = array_column($artistes, "nom");
array_multisort($noms, SORT_DESC, $dates, SORT_ASC, $artistes);
echo "<pre/>"; print_r($artistes);

