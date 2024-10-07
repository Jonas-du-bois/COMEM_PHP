<?php

echo "vsprintf(...) équivaut à sprintf(...) mais plutôt que d'utiliser plusieurs variables, on utilise un tableau",'<br><br>';
echo 'Exemple : ','<br>';
$tab=["James","Bond","007",7];
$masque1 = '%s %s %s est le %de agent secret';

echo vsprintf($masque1, $tab);