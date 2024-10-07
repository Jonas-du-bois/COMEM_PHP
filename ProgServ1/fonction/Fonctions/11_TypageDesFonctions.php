<?php
declare(strict_types=1); // force le contrôle des types

//
// TYPAGE DES PARAMETRES DES FONCTIONS ET DU TYPE DE RETOUR
//

// on peut typer les paramètres d'une fonction et celle de son type de retour
// Dans le mesure du possible, c'est une option hautement recommandée !
function rendSomme(float $a, float $b) : float {
    echo '$a : ', var_dump($a), '<BR>'; // pour contrôler le type reçu
    return ($a + $b);
}

// EXEMPLE 1 (normal)
echo 'Sans transtypage' . '<BR>';
$var1 = 24.5;
echo '$var2 : ', var_dump($var1), '<BR>'; // pour visualiser le type
$somme1 = rendSomme($var1, 25.5);
var_dump($somme1);
echo '<BR><BR>';

// EXEMPLE 2 (AVEC TRANSTYPAGE AUTOMATIQUE)
// Le transtypage automatique reste valable (si c'est possible)
echo 'Avec transtypage automatique' . '<BR>';
$var2 = 20;
echo '$var2 : ', var_dump($var2), '<BR>'; // pour visualiser le type
$somme2 = rendSomme($var2, 30);
var_dump($somme2);
echo '<BR><BR>';
//
//
//// EXEMPLE 3 (pour visualiser ce qui se passe en cas de problèmes)
function afficheMessage(string $message) {
    echo $message,"<BR>";
}
////Décommenter la ligne suivante pour voir le message d'erreur dans la fenêtre de sortie
//afficheMessage(12); // Génère une exception lors de l'exécution car les types ne correspondent pas ("int" -> "string")
afficheMessage("En voilà une bonne nouvelle non ?");