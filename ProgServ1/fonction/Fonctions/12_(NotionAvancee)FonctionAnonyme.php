<?php
// Une fonction anonyme est une fonction qui n'a pas de nom
// C'est une fonctionnalité qui se révèlera très utile ! (Callback)

//
// EXEMPLE 1
//
echo 'Exemple 1', '<BR>';
// Une variable peut "contenir" une fonction
$uneVariableContenantUneFonctionAnonyme = function($param){
    echo "En voilà quelque chose " . $param, "<BR>";
}; //Attention à ne pas oublier le point virgule !

// Pour exécuter la fonction, il suffit le mettre les "()" après le nom de la variable 
$uneVariableContenantUneFonctionAnonyme(" d'interessant non ?");
echo '<BR><BR>';

//
// EXEMPLE 2
//
echo 'Exemple 2', '<BR>';
// Cette fonction d'affichage s'adapte aux besoins :-)
function affiche($param1, $uneFonctionAffichage) {
    $uneFonctionAffichage($param1);
}

// Affichage simple (avec echo)
$var1 = [1,2,"3",4];
affiche($var1, function($param) { // La fonction n'a pas de nom
    echo "affiche : " . $param . '<BR>';
});

// Affichage plus précis (avec print_r)
$var2 = [1,2,"3",4];
affiche($var2, function($param) { // La fonction n'a pas de nom
    echo "affiche : ";
    print_r($param);
    echo '<BR>';
});

// Affichage plus précis (avec var_dump)
$var3 = [1,2,"3",4];
affiche($var3, function($param) { // La fonction n'a pas de nom
    echo "affiche : ";
    var_dump($param);
    echo '<BR>';
});


//
// EXEMPLE 3
//
// Fonction anonyme que l'on appelle directement
(function($param) {
    echo $param,"<BR>";
})("Je suis aussi une fonction anonyme");