<?php
$nombreColone = 9;
$nombreLigne = 3;
$nombreImg = 25;
$nombrePhotoLigne = 7;

$newNbLigne = round($nombreImg/$nombreColone); 

echo "question 1 --> ".$newNbLigne;
echo "<br>";

$newNbColonne = round($nombreImg/$nombreLigne);

echo "question 2 --> ".$newNbColonne;
echo "<br>";

$newNbLigne2 =($nombreImg/$nombreColone);

echo "question 3 --> ".(int)$newNbLigne2;
echo "<br>";

$newNbColonne2 = $nombreImg/$nombreLigne;

echo "question 4 --> ".(int)$newNbColonne2;
echo "<br>";

$nbPhotoDerniereLigne = $nombreImg%$nombrePhotoLigne;

echo "question 5 --> ".$nbPhotoDerniereLigne;
