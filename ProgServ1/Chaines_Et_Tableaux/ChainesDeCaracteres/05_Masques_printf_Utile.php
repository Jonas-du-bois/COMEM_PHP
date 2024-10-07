<?php
//https://www.php.net/manual/fr/function.printf.php

$numero = 1;
$pi = 3.14159265359;

echo 'On peut mettre des 0 avant : ','<BR>';
printf('%d',$numero);
echo '<br>';
printf('%02d',$numero);
echo '<br>';
printf('%03d',$numero);
echo '<br>';
printf('%04d',$numero);
echo '<br><br>';

echo 'Ou des caractères de notre choix :','<BR>';
printf("%'-2d",$numero);
echo '<br>';
printf("%'#3d",$numero);
echo '<br>';
printf("%'*4d",$numero);
echo '<br><br>';

echo 'Ou peut formater des nombres :','<BR>';
printf("%08.4f",$pi); // Force à avoir 8 chiffres au total mais avec 4 décimales
echo '<br>';
printf("%.1f",$pi);
echo '<br>';
printf("%.2f",$pi);
echo '<br>';
printf("%'/10.2f",$pi);
echo '<br>';

