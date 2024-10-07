<?php
for ($i=1; $i <=6; $i++){
    getDictons();
    echo "<br>";
}

function randomNombre(){
    $max = 8;
    $min = 1;

    $randomNb = rand($min, $max);  
    return $randomNb;
}

function getDictons (){
    $nbRandom = randomNombre();
    
    switch ($nbRandom) {
        case 1:
            echo "Le plaisir et le vouloir diminuent la peine du travail.";
            break;
        case 2:
            echo"Qui veut s'enrichir au travail mette la main à l'œuvre.";
            break;
        case 3:
            echo"Le travail d'aujourd'hui ne le laisse pas pour demain.";
            break;
        case 4:
            echo"Après le travail vient l'argent et le repos.";
            break;
        case 5:
            echo"Le jour où renaît la lune pour tout travail est fortune.";
            break;
        case 6:
            echo"Tends la main au travail, et non pas à l'aumône.";
            break;
        case 7:
            echo"Tout doucement vient la richesse, qu'accroissent travail et sagesse.";
            break;
        case 8:
            echo"Il en faut peut pour être heureux";
            break;
        default:
            break;
    }
    
}
