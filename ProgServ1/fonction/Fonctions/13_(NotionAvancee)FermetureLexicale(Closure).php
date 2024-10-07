<?php

// EXEMPLE 1
// Une fermeture lexicale (Closure) est un complément à une fonction anonyme.
// Elle permet d'injecter dans une fonction anonyme des variables issues du contexte de leur déclaration.
echo 'Exemple 1', '<br>';
$param1 = "fermeture";
$param2 = "lexicale";
$fonction1 = function() use ($param1, $param2) {
    echo "Je suis une ", $param1, " ", $param2, "<BR>";
};
$fonction1();
echo "<BR>";

// EXEMPLE 2
// Si la fonction doit modifier une variable injectée, il faut la passer par référence
echo 'Exemple 2', '<br>';
$var1 = 10;
$ajoute = function($param) use (&$var1) {
    $var1 += $param;
};
$ajoute(2);
echo $var1, "<BR>";
echo "<BR>";

// EXEMPLE 3
// Attention à ne pas confondre ce principe avec les variables globales
// Voici un exemple qui va aider à comprendre
echo 'Exemple 3', '<br>';
$message = "message avant déclaration fonction";
$fonction2 = function() use ($message, &$reference) {
    echo "Dans fonction2", "<BR>";
    echo $message, "<BR>";
    echo $reference, "<BR>";
};
$fonction2(); // appel à la fonction
// $message vaut la valeur définie avant la déclaration de la fonction
// $reference ne vaut rien puisqu'elle n'a pas été définie

$message = "message après déclaration fonction";
$reference = "définition reference";
$fonction2(); // appel à la fonction
// $message a changé après la déclaration de la fonction => la modification ne sera pas prise en compte
// $reference est définie après la déclaration de la fonction. 
// Mais comme il y a un lien fort (&) elle vaut "définition reference" lors de l'appel à la fonction2()

$reference = "modificatoin reference";
$fonction2(); // appel à la fonction;
// $reference a changé après la déclaration de la fonction. 
// Mais comme il y a un lien fort (&) elle vaut "modification reference" lors de l'appel à la fonction2()
echo '<br>';

// EXEMPLE 4
// Création de 11 fonctions pour afficher les différentes livrets
echo 'Exemple 4', '<br>';
for ($i = 2; $i <= 12; $i++) {
    ${"afficheLivret" . $i} = function() use ($i) { // création d'une fonction afficheLivretX() où X est une valeur de 2 à 12
        echo "Voici le livret ", $i, " : <BR>";
        for ($j = 1; $j <= 12; $j++) {
            echo '&nbsp;', $j, '*', $i, '=', $j * $i, '<br>';
        }
    };
}

$numeroLivretAleatoire = random_int(2, 12); // Choix aléatoire d'un des livret
${"afficheLivret" . $numeroLivretAleatoire}(); // Execution de la fonction correspondante
echo "<BR>";
$afficheLivret7(); //Execution de la fonction qui affiche le livret 7
echo "<BR>";