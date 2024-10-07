<?php

$numero = 1;
$pi = 3.14159265359;

echo 'sprintf(...) est une fonction qui retourne une chaîne formatée','<br>';
$var0 = sprintf('%d',$numero);
$var1 = sprintf('%02d',$numero);
$var2 = sprintf('%03d',$numero);
$var3 = sprintf('%04d',$numero);
echo $var0,'<br>';
echo $var1,'<br>';
echo $var2,'<br>';
echo $var3,'<br><br>';

echo 'Ou des caractères de notre choix :','<br>', sprintf("%'-2d",$numero), '<br>';
$var4 = sprintf("%'#3d",$numero);
$var5 = sprintf("%'*4d",$numero);
echo $var4,'<br>';
echo $var5,'<br><br>';

echo 'Ou peut formater des nombres :','<br>', sprintf("%08.4f",$pi), '<br>';
$var6 = sprintf("%.1f",$pi);
$var7 = sprintf("%.2f",$pi);
$var8 = sprintf("%'/10.2f",$pi);
echo $var6,'<br>';
echo $var7,'<br>';
echo $var8,'<br>';