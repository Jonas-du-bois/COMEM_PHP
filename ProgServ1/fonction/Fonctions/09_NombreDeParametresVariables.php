<?php

// Une fonction peut avoir un nombre variable de paramètres
// Ils sont alors mis dans un tableau
function fonctionAvecParams(...$params) {
    echo 'Tu as appelé la fonctionAvecParams avec ', count($params), " paramètres", "<BR>"; //count(...) retourne le nombre d'éléments du tableau spécifié
    echo 'Voici les valeurs : ' . '<BR>';
    foreach($params as $param) {
        var_dump($param);
        echo '<BR>';
    }
}

fonctionAvecParams(1,2,3,4,5,6,7,8,56,4,3,3,2,8);

// Attention ;-) un tableau peut en cacher un autre
fonctionAvecParams(1, 2.0, "trois", ['quatre', ['cinq', 6, 7.0]]); // Il y a bien 4 éléments !! (le dernier est un tableau contenant un tableau)
//
//
// Idem, mais avec des paramètres définis
function fonctionAvecParamsBis($param1, $param2, ...$params) {
    echo 'Tu as appelé la fonctionAvecParamsBis avec ', func_num_args(), " paramètres", "<BR>"; //func_num_args() est une fonction qui retourne le nombre d'arguments de la fonction
    echo "$param1", "<BR>";
    echo "$param2", "<BR>";
    echo 'Voici les valeurs : ' . '<BR>';
    foreach($params as $param) {
        echo $param . '<BR>';
    }
}

fonctionAvecParamsBis(1, 2.0, "trois", ['quatre', ['cinq', 6, 7.0]]); // Il y a bien 4 éléments !! (le dernier est un tableau contenant un tableau)
echo "<br><br>";