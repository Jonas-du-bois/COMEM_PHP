<?php
echo "<br>", "<h1>Exercice 7 : Nombres faciles à lire</h1>", "<br>";

const LIMITE_MIN = 1;
const LIMITE_MAX = 1000;

$nombreAleatoire = rand(LIMITE_MIN, LIMITE_MAX);

$unite = "";
$dizaine = "";
$centaine = "";
$nombreFrancais = "";

//Récupération des centaines
$centaine = (int) ($nombreAleatoire / 100);
//Récupération des dizaines
$dizaine = (int) (($nombreAleatoire - $centaine * 100) / 10);
//Récupération des unités
$unite = (int) ($nombreAleatoire - $centaine * 100 - $dizaine * 10);

//conversion en français

//Conversion des centaines
if ($centaine > 0) { //Si le nombre possède des centaines
    if ($centaine > 1) { //Si les centaines sont plus grande que 1
        $centaine = convertirNombreText($centaine);
        $centaine .= "-cent";
    } else if ($centaine == 1) { //Si il n'y qu'une centaine
        $centaine = "cent"; //On note simplement cent
    }
    $nombreFrancais .= $centaine;
}

//Conversion des dizaines et unités
if (($dizaine * 10 + $unite) >= 20) { //Si l'addition des dizaines et unités est supérieure à 20
    $dizaine = convertirNombreText($dizaine * 10);
    $unite = convertirNombreText($unite);

    //Construction du nombre en français
    //ajout du trait d'union avant les dizaines s'il y a des centaines
    if($centaine !=0){ 
        $nombreFrancais.="-";
    }
    $nombreFrancais .= $dizaine;
    //Construction du nombre suivant s'il y a des unités
    if ($unite > 0) {
        //Si le nombre contient un en unité, ajout de la conjonction "et"
        if ($unite == "un") {
            $nombreFrancais .= "-et";
        }
        $nombreFrancais .= "-".$unite;
    }

} else { //Si l'addition des dizaines et unités est inférieur à 20
    $dizaine = $dizaine * 10 + $unite;
    $dizaine = convertirNombreText($dizaine);
    if($centaine != 0){
        $nombreFrancais .="-" ;
    }
    $nombreFrancais .= $dizaine;
}

echo "<br> Le nombre aléatoire         : ", $nombreAleatoire;
echo "<br> Son équivalent en français  : ";

echo $nombreAleatoire == LIMITE_MAX ? "mille" : $nombreFrancais;

echo "<br>";


function convertirNombreText($nombre)
{
    $nombreConvertit = "";


    if ($nombre < 20) {
        switch ($nombre) {
            case 1:
                $nombreConvertit = "un";
                break;
            case 2:
                $nombreConvertit = "deux";
                break;
            case 3:
                $nombreConvertit = "trois";
                break;
            case 4:
                $nombreConvertit = "quatre";
                break;
            case 5:
                $nombreConvertit = "cinq";
                break;
            case 6:
                $nombreConvertit = "six";
                break;
            case 7:
                $nombreConvertit = "sept";
                break;
            case 8:
                $nombreConvertit = "huit";
                break;
            case 9:
                $nombreConvertit = "neuf";
                break;
            case 10:
                $nombreConvertit = "dix";
                break;
            case 11:
                $nombreConvertit = "onze";
                break;
            case 12:
                $nombreConvertit = "douze";
                break;
            case 13:
                $nombreConvertit = "treize";
                break;
            case 14:
                $nombreConvertit = "quatorze";
                break;
            case 15:
                $nombreConvertit = "quinze";
                break;
            case 16:
                $nombreConvertit = "seize";
                break;
            case 17:
                $nombreConvertit = "dix-sept";
                break;
            case 18:
                $nombreConvertit = "dix-huit";
                break;
            case 19:
                $nombreConvertit = "dix-neuf";
                break;
        }
    }

    if ($nombre >= 20) {
        switch ($nombre) {
            case 20:
                $nombreConvertit = "vingt";
                break;
            case 30:
                $nombreConvertit = "trente";
                break;
            case 40:
                $nombreConvertit = "quarante";
                break;
            case 50:
                $nombreConvertit = "cinquante";
                break;
            case 60:
                $nombreConvertit = "soixante";
                break;
            case 70:
                $nombreConvertit = "septante";
                break;
            case 80:
                $nombreConvertit = "huitante";
                break;
            case 90:
                $nombreConvertit = "nonante";
                break;
        }
    }

    return $nombreConvertit;
}

