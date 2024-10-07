<?php
//
// EXEMPLE 1
//
// Il est possible de paramétrer une fonction
function fonctionParametree1($param1) {
    echo "Je suis le paramètre \$param1. Ma valeur est : $param1", "<BR>";
}
// Appel de la fonctionParametree1(...) en lui transmettant un entier
fonctionParametree1(2);
// Appel de la fonctionParametree1(...) en lui transmettant un entier
fonctionParametree1("Youpee");
// Appel de la fonctionParametree1(...) en lui transmettant un entier
fonctionParametree1(5.1415);

echo "<BR>";

//
// EXEMPLE 2
//
// Une fonction peut avoir autant de paramètres que nécessaire
function fonctionParametree2($param1, $param2, $param3) {
    echo "Je suis le paramètre \$param1. Ma valeur est : $param1", "<BR>";
    echo "Je suis le paramètre \$param2. Ma valeur est : $param2", "<BR>";
    echo "Je suis le paramètre \$param3. Ma valeur est : $param3", "<BR><BR>";
}

fonctionParametree2(1, 2, 3);


//
// EXEMPLE 2 (BIS)
//
// Cette fonction permet d'afficher dynamiquement tous les paramètres/valeurs
// De cette manière on peut ajouter ou enlever un paramètre de la fonction sans
// devoir modifier son code
function fonctionParametree2_Bis($param1, $param2, $param3, $param4, $param5) {
    // La classe ReflectionFunction permet la récupération des infomations relatives à une fonction
    // debug_backtrace()[0]["function"] => rend le nom de la fonction dans laquelle on est
    // L'association permet d'avoir dans un objet toutes les informations relatives à la fonction fonctionParametree2_Bis
    $infosDe_fonctionParametree2_Bis = new \ReflectionFunction(debug_backtrace()[0]["function"]);
    // Récupération des infos concernant les paramètres de la fonction fonctionParametree2_Bis
    $infosConcernant_parametresDeLaFonction = $infosDe_fonctionParametree2_Bis->getParameters();
    // Filtrage pour n'obtenir que le nom des paramètres
    // => $infosConcernant_parametresDeLaFonction ne contient plus que les noms des paramètres
    // Remarque : Notez l'usage de &$nom pour indiquer que l'on veut modifier l'original (passage par référence)
    array_walk($infosConcernant_parametresDeLaFonction, function(&$nom) {
        $nom = $nom->name;
    });
    // Récupération des valeurs des paramètres
    $valeursParams = func_get_args();
    // Mise en relation des noms de paramètres avec leur valeurs
    $nomsValeursParams = array_combine ($infosConcernant_parametresDeLaFonction , $valeursParams);
    // Affichage des informations
    foreach ($nomsValeursParams as $param => $valeur) {
        echo "Je suis le paramètre $$param. Ma valeur est : $valeur", "<BR>";
    }
    echo "<BR>";
}

fonctionParametree2_Bis(1, 2, 3, 4, 5);