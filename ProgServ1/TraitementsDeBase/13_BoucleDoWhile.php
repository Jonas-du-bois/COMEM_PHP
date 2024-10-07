<?php
/*
 * Ce programme génére des nombres aléatoires entre 1 et 50 et s'arrête quand la valeur 25 a été atteinte
 */
echo "Exemple de boucle do/while",'<br><br>';
const MAX = 50;
const CIBLE = MAX/2;
do {
    // Ce code s'execute au moins une fois
    $nombre = mt_rand(1,CIBLE);
    if ($nombre!==CIBLE) {
        echo "La cible " . CIBLE . " n'a pas été atteinte ($nombre)",'<br>';
    };
} while ($nombre !== CIBLE);
echo 'La cible ', $nombre, ' a été atteinte','<br><br>';

echo '<a href="http://php.net/manual/fr/control-structures.do.while.php">Documentation officielle</a>','<br>';
