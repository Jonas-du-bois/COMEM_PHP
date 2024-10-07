<?php

$chaine = 'Le tag <br> est un tag pratique.'; // oups problème ... la chaîne sera coupée en deux
echo $chaine, '<br><br>';
echo htmlentities($chaine), '<br><br>'; // YES ! Problème résolu

$chaine2 = "Les accents &eacute;&egrave;&acirc;&ocirc;&ugrave; sont chouettes.";
echo 'La chaine "', htmlentities($chaine2), "\" n'est pas facile à lire...", '<br>';
echo 'La chaine "', html_entity_decode($chaine2), '" par contre beaucoup plus', '<br><br>';

$chaine3 = "<h1><strong>Salut</strong></h1>";
echo $chaine3, '<br>';
// La fonction strip_tags permet de nettoyer une chaîne contenant du html
echo "Exemple 1 strip_tags(...) : ", strip_tags($chaine3), '<br>'; // N'autorise aucune balise
echo "Exemple 2 strip_tags(...) : ", strip_tags($chaine3, "<strong>"), '<br>'; // Autorise la balise <strong>

