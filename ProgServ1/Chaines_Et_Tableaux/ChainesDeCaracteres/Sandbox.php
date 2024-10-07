<?php

$chaine = "       L'été l'âne      va sous      l'hêtre      ";
$chaine = trim(preg_replace('/[\t\n\r\s]+/', ' ', $chaine));
$mots = explode(" ", $chaine);
var_dump($mots);
foreach($mots as $mot) {
    echo $mot . "<BR>";
}



$masque1 = "%s est plus malin que %s qui n'aime pas %s et %s";

printf($masque1, "Jules", "Max", "Zoé", "Aplhonse");
