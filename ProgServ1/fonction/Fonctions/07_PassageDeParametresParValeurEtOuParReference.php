<?php
//
// TRANSMISSION PAR VALEUR (copie)
//
// La transmission des paramètres se fait par défaut par valeur (On modifie une copie de la source)
function ajouteUnTransmissionParValeur($paramTransmissionParValeur) {
    $paramTransmissionParValeur++;
    echo '$paramTransmissionParValeur : ',$paramTransmissionParValeur,'<BR>';
}

$variable1 = 1;
ajouteUnTransmissionParValeur($variable1);
echo '$variable1 : ',$variable1,"<BR><BR>";

//
// TRANSMISSION PAR REFERENCE (original)
//
// Par contre, il est possible de les transmettre les paramètres par référence (On modifie la source !)
function ajouteUnTransmissionParReference(&$paramTransmissionParReference) {
    $paramTransmissionParReference++;
    echo '$paramTransmissionParReference : ',$paramTransmissionParReference,'<BR>';
}

$variable2 = 1;
ajouteUnTransmissionParReference($variable2);
echo '$variable2 : ',$variable2,"<BR>";