<?php
//Soit le texte suivant :
//$texte = "Malgré le froid, la Fourmi se chauffait au soleil.
//Tandis que la Fourmi mangeait, la Sauterelle arriva, son estomac criant famine.
//S'adressant à la Fourmi, elle quémanda une ou deux graines.
//« Eh bien, demanda la Fourmi, que faisiez-vous durant l'été ? »
//« Je sautais de feuille en feuille, je les mordillais, je chantais », répliqua la
//Sauterelle.";
//Ecrire une fonction permettant de changer toutes les occurences du mot Fourmi par un autre nom d'animal ou un prénom.

$texte = "Malgré le froid, la Fourmi se chauffait au soleil.
Tandis que la Fourmi mangeait, la Sauterelle arriva, son estomac criant famine.
S'adressant à la Fourmi, elle quémanda une ou deux graines.
« Eh bien, demanda la Fourmi, que faisiez-vous durant l'été ? »
« Je sautais de feuille en feuille, je les mordillais, je chantais », répliqua la
Sauterelle.";

echo $texte,'<br><br>';

$string = 'Le renard marron agile saute par dessus le chien paresseux.';
$recherche = ['/Fourmi/','/Sauterelle/'];
$remplacement = ['Gazelle','Giraffe'];
echo preg_replace($recherche, $remplacement, $texte);