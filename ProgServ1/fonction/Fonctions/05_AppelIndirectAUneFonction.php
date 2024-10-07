<?php

//Une fonction pour additionner trois paramètres
function additionne($param1, $param2, $param3) {echo $param1+$param2+$param3,"<BR>";}
//Une fonction pour multiplier trois paramètres
function multiplie($param1, $param2, $param3) {echo $param1*$param2*$param3,"<BR>";}

//Une fonction qui rend des noms (de fonctions) au hasard
function rendNomFonctionAuHasard() {
    $nomAuHasard = mt_rand(0,1) ? "additionne" : "multiplie";
    return $nomAuHasard;
}


// Cinq appels indirects à une fonction paramétrée (en mettant les paramètres les uns à la suite des autres)
for ($i=1; $i<=5; $i++) {
    // Soit on met les paramètres les uns à la suite des autres
    call_user_func(rendNomFonctionAuHasard(),10,20,30);
}
echo "<BR>";
//
// Cinq appels indirects à une fonction paramétrée (en mettant les paramètres dans un tableau)
for ($i=1;$i<=5;$i++) {
    // Soit on met les paramètres dans un tableau
    $tab = [10,20,30];
    call_user_func_array(rendNomFonctionAuHasard(),$tab);
}