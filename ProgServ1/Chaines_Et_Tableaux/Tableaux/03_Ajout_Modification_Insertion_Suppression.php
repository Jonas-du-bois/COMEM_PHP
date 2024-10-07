<?php

$tab = ['nom' => "Bond",
        'prenom' => "James"];

function afficheTab($message, $unTab) {
    $chaine = '[';
    foreach($unTab as $cle => $valeur) {
        $chaine .= "<br>'" . $cle . "' => " . $valeur;
    }
    $chaine .= ']';
    echo $message, $chaine,'<br><br>';
}

afficheTab("Tableau initial : ",$tab);

$tab['numero'] = '007';  // pour ajouter un element à la fin
afficheTab("Ajout à la fin : ",$tab);

$tab['nom'] = 'Brown'; // Attention, ne décale pas les éléments
afficheTab("Modification d'une valeur : ", $tab);

$val1 = array_shift($tab); //supprime la 1ère valeur du tableau et la récupère avec $val
afficheTab("Suppression 1e valeur du tableau : ", $tab);

$val2 = array_pop($tab); //supprime la dernière valeur du tableau
afficheTab("Suppression de la dernière valeur du tableau : ", $tab);

echo '$val1 : ', $val1, '<br>';
echo '$val2 : ', $val2, '<br>';

array_unshift($tab, 1); //ajout au début du tableau, MAIS AVEC DECALAGE ;-)
afficheTab("Ajout au début du tableau. Comme aucune clé n'a été spécifiée php en crée une : ", $tab);

$val = -666;
$position = 1;
$remplacement = 0;
array_splice($tab, $position, $remplacement, $val); // ajout d'une valeur dans le tableau à la position 3
afficheTab("Ajout au milieu du tableau (Comme la clé n'existe pas, elle est créee) : ", $tab);

unset($tab[1]); //supprime la valeur du tableau et décale les éléments
afficheTab("Suppression au milieu du tableau : ", $tab);

unset($tab['prenom']); //supprime la clé et la valeur associée
afficheTab("Suppression d'une clé-valeur : ", $tab);