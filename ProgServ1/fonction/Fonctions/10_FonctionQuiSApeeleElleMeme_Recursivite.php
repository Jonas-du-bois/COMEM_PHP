<?php

//
// FONCTION RECURSIVE
// Une fonction récursive est une fonction qui s'appelle elle-même
//

// Voici une fonction "récursive" permettant d'afficher ce qu'elle a reçu
// Remarque : Elle peut recevoir un tableau contenant un/des tableau(x) contenant un/des tableau(x) contenant un/des tableau(x) contenant un/des tableau(x) contenant un/des tableau(x) ...
function echoBis($param) {
    if (is_array($param)) {
        foreach ($param as $element) {
            echoBis($element); // APPEL RECURSIF (La fonction s'appelle elle-même)
        }
    } else {
        // 
        echo $param, '<BR>';
    }
}
//
echoBis([1,['a',[100,200,300,['-1','-2','-3'],500,600],'c'],3,4]);
echo '<BR>';
//
//$tab = [1, 2.0, "trois", ['quatre', ['cinq', 6, 7.0]], 8];
//echoBis($tab); // pratique non ?
//echo '<BR>';

// La difficulté avec une fonction recursive, c'est de la faire s'arrêter.
//function test() {
//    echo 'oups...' . '<BR>';
//    test();
//}
//
//test(); // Cette fonction s'appelle indéfiniment (mais non... elle s'appelle test() ;-)