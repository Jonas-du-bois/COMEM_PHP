<?php

function recure($nombre) {
    // Condition d'arrêt : si $nombre est inférieur ou égal à zéro, on arrête la récursion
    if ($nombre <= 15) {
        echo "recure($nombre) <br>";
        $nombre++;
        recure($nombre);
    }
}

// Appel de la fonction récursive avec un argument initial de 5
recure(1);
