<?php

// La variable globale $_POST permet de récupérer les données d'un formulaire envoyées à l'aide de la méthdoe POST
// Remarque : Lorsqu'une case à cocher n'est pas cochée, rien n'est envoyé au serveur 
//            Raison pour laquelle il faut d'abord tester que la variable existe à l'aide de "isset"
if (isset($_POST['souscrire'])) {
    var_dump($_POST['souscrire']);
    echo '<br>';
}
if (isset($_POST['souscrire2'])) {
    var_dump($_POST['souscrire2']);
    echo '<br>';
}