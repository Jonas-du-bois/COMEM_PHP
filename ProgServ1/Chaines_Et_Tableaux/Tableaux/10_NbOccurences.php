<?php

$tab = [1,2,5,2,4,5,2,4,5,5,1];

echo 'Tableau des occurences';
$cmpt = array_count_values($tab);
echo '<pre>'; var_dump($cmpt);

foreach ($cmpt as $cle => $valeur) {
    echo "Le chiffre $cle est présent $valeur fois",'<br>';
}

