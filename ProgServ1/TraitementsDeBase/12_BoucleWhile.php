<?php
echo "Exemple de boucle while",'<br><br>';
const MAX = 50;
const CIBLE = 1;
$nombre = mt_rand(CIBLE,MAX);
while ($nombre !== CIBLE) {
    // Ce code ne s'executera peut-être pas
    if ($nombre!==CIBLE) {
        echo "La cible " . CIBLE . " n'a pas été atteinte ($nombre)",'<br>';
    };
    $nombre =  mt_rand(CIBLE,MAX);
};
echo 'La cible ', $nombre, ' a été atteinte','<br><br>';

echo '<a href="http://php.net/manual/fr/control-structures.while.php">Documentation officielle</a>','<br>';