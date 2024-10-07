<?php

$chaine = "Ceci est une longue phrase pleine de mots uniques";
$sousChaine = "un";
$sousChaine2 = "coeur";
$sousChaine3 = "Ceci";

// strpos(...)
// https://www.php.net/manual/fr/function.strpos.php
echo 'strpos(...) permet de chercher une sous chaine précise <br><br>';
printf('Position du début de la souchaine "%s" dans la chaine "%s" : %d %s', $sousChaine, $chaine, strpos($chaine, $sousChaine), '<br>');
printf('Position du début de la souchaine "%s" dans la chaine "%s" : %d %s', $sousChaine2, $chaine, strpos($chaine, $sousChaine2), '<br>');
printf('Position du début de la souchaine "%s" dans la chaine "%s" : %d %s', $sousChaine3, $chaine, strpos($chaine, $sousChaine3), '<br><br>');
echo 'Attention à ne pas confondre 0 et false <br>';
var_dump(strpos($chaine, $sousChaine2)); // Il n'y a pas le mot "coeur" dans la phrase "Ceci est une longue phrase pleine de mots uniques" 
echo '<br>';
var_dump(strpos($chaine, $sousChaine3)); // La chaine "Ceci" se trouve à la position 0 de "Ceci est une longue phrase pleine de mots uniques"
echo '<br><br>';
echo 'strpos(...) permet aussi de chercher depuis une position <br>';
printf('Position suivante de la souchaine "%s" dans la chaine "%s" : %d %s', $sousChaine, $chaine, strpos($chaine, $sousChaine, 10), '<br><br>');

// stripos(...)
// https://www.php.net/manual/fr/function.stripos.php
$sousChaine4 = "MOTS";
echo 'stripos(...) permet de chercher une sous chaine SANS tenir compte de la casse <br>';
printf('Position du début de la souchaine "%s" dans la chaine "%s" : %d %s', $sousChaine4, $chaine, stripos($chaine, $sousChaine4), '<br><br>');

// strrpos(...)
// https://www.php.net/manual/fr/function.strrpos.php
echo 'strrpos(...) permet de chercher une sous chaine depuis la fin <br>';
printf('Position du début de la souchaine "%s" dans la chaine "%s" : %d %s', $sousChaine, $chaine, strrpos($chaine, $sousChaine), '<br><br>');
echo 'strrpos(...) permet aussi de chercher depuis une position <br>';
printf('Position suivante de la souchaine "%s" dans la chaine "%s" : %d %s', $sousChaine, $chaine, strrpos($chaine, $sousChaine, -8), '<br><br>'); // si négatif cherche de droite à gauche, si positif cherche de gauche à droite



