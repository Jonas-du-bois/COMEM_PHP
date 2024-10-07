<?php

$chaine1 = "Jules, Max, Zoé, Alphonse, Jonas, Philipe, Michelle";
$prenoms = explode(", ", $chaine1);

for ($index = 0; $index < count($prenoms); $index++) {

    if ($index == count($prenoms) - 1) {
        echo " et ";
    }
    echo "$prenoms[$index] ";
}



