<?php

$chaine = "Ceci est une string";

for ($i=0; $i<$taille=strlen($chaine); $i++) {
    printf('%02d : %s <br>', $i , $chaine[$i]);
}