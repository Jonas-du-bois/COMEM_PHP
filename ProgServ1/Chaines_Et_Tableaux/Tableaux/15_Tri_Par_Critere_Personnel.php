<?php

function afficheTab($message, $unTab) {
    $chaine = '[';
    $chaine .= implode(',', $unTab);
    $chaine .= ']';
    echo $message, $chaine,'<br>';
}

$tabFruits = ['fraise','pamplemousse','kiwi'];

afficheTab("Tableau initial : ",$tabFruits);

// tri à l'aide d'une fonction anonyme.
// la fonction doit retourner <0, 0 ou >0 pour que usort(...) fonctionne
usort($tabFruits, function ($chaine1, $chaine2) {
    return strlen($chaine1) <=> strlen($chaine2); // comparaison des longueurs de chaînes
});
afficheTab("Tableau trié par longueur de chaînes : ",$tabFruits);

echo '<a href="https://www.php.net/manual/fr/function.usort.php">Documentation officielle usort</a><br>';