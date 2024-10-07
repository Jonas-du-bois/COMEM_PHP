<link rel="shortcut icon" href="#" /> <!-- pour éviter le message favicon.ico dans la fenêtre output -->
<?php

echo 'Sans la clause else', '<br>';
//////////////////////////////////
$nombre1 = 5;
$nombre2 = 10;
if ($nombre1 < $nombre2) {
    echo "$nombre1 est plus petit que $nombre2" . "<br>";
}
echo '<a href="http://php.net/manual/fr/control-structures.if.php">Documentation officielle</a>','<br>';




echo '<br>', 'Avec la clause else', '<br>';
//////////////////////////////////////////
$nombre1 = 4;
$nombre2 = 2;
if ($nombre1 < $nombre2) {
    echo "$nombre1 est plus petit que $nombre2" . "<br>";
} else {
    echo "$nombre2 est plus petit que $nombre1" . "<br>";
}
echo "La même chose avec l'opérateur ternaire : ", '<br>';
echo $nombre1 < $nombre2 ? "$nombre1 est plus petit que $nombre2<br>" : "$nombre2 est plus petit que $nombre1<br>";
echo '<a href="http://php.net/manual/fr/control-structures.else.php">Documentation officielle</a>','<br>';




echo '<br>', "L'instruction elseif permet d'éviter de trop imbriquer des if", '<br>';
/////////////////////////////////////////////////////////////////////////////
$nombre1 = 21;
if ($nombre1 >= 0 && $nombre1 <= 9) {
    echo "$nombre1 est compris entre 0 et 9", "<br>";
} elseif ($nombre1 >= 10 && $nombre1 <= 19) {
    echo "$nombre1 est compris entre 10 et 19", "<br>";
} elseif ($nombre1 >= 20 && $nombre1 <= 29) {
    echo "$nombre1 est compris entre 20 et 29", "<br>";
} elseif ($nombre1 >= 30 && $nombre1 <= 39) {
    echo "$nombre1 est compris entre 30 et 39", "<br>";
} else {
    echo "$nombre1 est plus petit que 0 ou plus grand que 39", "<br>";
}
echo '<a href="http://php.net/manual/fr/control-structures.elseif.php">Documentation officielle</a>','<br>';

echo '<br>', "L'instruction switch permet aussi d'éviter de trop imbriquer des if", '<br>';
///////////////////////////////////////////////////////////////////////////////////////////
$n = 0;
switch ($n) {
    case 0:
        echo '$n égal 0';
        break;
    case 10:
        echo '$n égal 1';
        break;
    default :
        echo "\$n vaut $n";
}

echo '<br>';

$fruit = 'banane';
switch ($fruit) {
    case "pomme":
        echo '$fruit est une pomme';
        break;
    case 'poire':
        echo '$fruit est une poire';
        break;
    case "banane":
        echo '$fruit est une banane';
        break;
    default :
        "$fruit n'est pas une pomme, pas une poire ni une banane";
}
echo '<br>', "Les instruction break; et default: ne sont pas obligatoire dans le switch (Attention ! à utiliser avec précautions !)", '<br>';
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$i = 0;
switch ($i) {
    case 0: echo 'coucou';
    case 1:
    case 2:
        echo '$i est plus petit que 3 mais n\'est pas négatif';
        break;
    case 3:
        echo "i égal 3";
}
echo '<br>','<a href="http://php.net/manual/fr/control-structures.switch.php">Documentation officielle</a>', '<br>';

echo '<br>', "L'expression match (nouveauté v.8) retourne une valeur basée sur la comparaison par égalité entre une expression et plusieurs expressions.", '<br>';
/////////////////////////////////////////////////////////////////////////////

$x = 2;
$alea = rand(0,10);
echo "\$alea = $alea",'<br>';
$resultat = match($alea) {
	rand(0,1)    => 'zéro ou un (première chance)',
	0,1          => 'zéro ou un (seconde chance)',
	2,3,5,7      => 'nombre premier',
	$x**2, $x**3 => 'puissance de '. $x,
	default      => 'autre nombre',
};
echo "\$resultat = $resultat", '<br><br>';


$age = 23;
echo "\$age = $age",'<BR>';
$resultat = match (true) {
    $age >= 65 => 'senior',
    $age >= 25 => 'adulte',
    $age >= 18 => 'jeune adulte',
    default => 'enfant',
};
echo "\$resultat = $resultat", '<br>';
echo '<a href="http://https://www.php.net/manual/fr/control-structures.match.php">Documentation officielle</a>', '<br>';
/////////////////////////////////////////////////////////////////////////////