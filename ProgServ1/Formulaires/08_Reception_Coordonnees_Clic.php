<?php

// Avez-vous remarqué où se trouve la coordonnée (0,0) de l'image ?
// Documentation officielle : http://php.net/manual/fr/function.filter-input.php
$coordX = filter_input(INPUT_POST, 'monImage_x', FILTER_VALIDATE_INT);
$coordY = filter_input(INPUT_POST, 'monImage_y', FILTER_VALIDATE_INT);

echo 'Tu as cliqué à la position (', $coordX, ',', $coordY, ') de l\'image.';
