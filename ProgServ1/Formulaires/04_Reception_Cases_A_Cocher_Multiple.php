<?php

// La variable globale $_POST permet de récupérer les données d'un formulaire envoyées à l'aide de la méthdoe POST
if (isset($_POST['languages'])) {
    echo '<pre/>';
    var_dump($_POST['languages']);
} else {
    echo "Aucun language n'a été coché !";
}