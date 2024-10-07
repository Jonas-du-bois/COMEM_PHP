<?php
echo "Exemples de boucle for",'<br>';
$min = 10;
$max = 20;
for ($varBoucle=$min; $varBoucle<=$max; $varBoucle++) {
    echo $varBoucle,'<br>';
};

echo '<br><br>';
for ($i=$max; $i>=$min; $i-=2) {
    echo $i,'<br>';
};

echo '<a href="http://php.net/manual/fr/control-structures.for.php">Documentation officielle</a>','<br>';