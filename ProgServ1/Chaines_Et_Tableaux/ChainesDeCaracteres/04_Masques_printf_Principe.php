<?php
// https://www.php.net/manual/fr/function.printf.php
echo 'Signification des paramètres pour les masques à l\'aide de la commande printf(...) : ' ,'<br>';
echo '&emsp;', '%s pour les chaines de caractères' ,'<br>';
echo '&emsp;', '%d pour un entier signé' ,'<br>';
echo '&emsp;', '%u pour un entier non signé' ,'<br>';
echo '&emsp;', '%f pour un réel (f pour float ;-)' ,'<br>';
echo '&emsp;', '%b pour afficher un entier en binaire' ,'<br>';
echo '&emsp;', '%o pour afficher un entier en octal (base 8)' ,'<br>';
echo '&emsp;', '%x pour afficher un entier en hexadécimal minuscule (base 16)' ,'<br>';
echo '&emsp;', '%X pour afficher un entier en hexadécimal majuscule (base 16)' ,'<br><br><br>';
$prenom = "James";
$nom = "Bond";
$code = "007";
$numero = 7;
$entier = 15;
$reel = 3.14159265359;
$entierNegatif = -6;
$entierNonSigne = 6;
$br='<br>';

$masque1 = '%s %s %s est le %de agent secret %s';
$masque2 = "Attention, ne pas confondre '%s' et %d %s";
$masque3 = "En binaire : %b, En octal : %o, En hexadécimal (minuscule) : %x, En hexadécimal (majuscule) : %X %s";
$masque4 = "Je suis un réel qui vaut : %f %s";
$masque5 = "La valeur absolue de %d n'est pas %u %s";
$masque6 = "La valeur absolue de -%u est %d %s";

printf('Exemples : %s',$br);
printf($masque1, $prenom, $nom, $code, $numero, $br);
printf($masque2, $numero, $numero, $br);
printf($masque3, $entier, $entier, $entier, $entier, $br);
printf($masque4, $reel, $br);
printf($masque5, $entierNegatif, $entierNegatif, $br);
printf($masque6, $entierNonSigne, $entierNonSigne, $br);