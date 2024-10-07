<?php

$tabCouleurs = ['Rouge','Vert','Bleu'];
$elementATrouver = 'Rouge';

if (in_array($elementATrouver,$tabCouleurs)) {
    echo "L'élément $elementATrouver a été trouvé";
} else {
    echo "L'élément $elementATrouver n'a pas été trouvé";
}
echo '<br>';


$tabCouleurs2 = array_map('strtolower', $tabCouleurs);
$elementATrouver2 = 'RoUgE';
if (in_array(strtolower($elementATrouver),$tabCouleurs2)) {
    echo "L'élément $elementATrouver2 a été trouvé";
} else {
    echo "L'élément $elementATrouver2 n'a pas été trouvé";
}
echo '<br><br>';

echo '<a href="https://www.php.net/manual/fr/function.array-map.php">Documentation officielle array_map</a><br>';
echo '<a href="https://www.php.net/manual/fr/function.in-array.php">Documentation officielle in_array</a>';