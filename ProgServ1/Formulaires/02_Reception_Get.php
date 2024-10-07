<?php

// La variable globale $_GET permet de récupérer les données d'un formulaire envoyées à l'aide de la méthdoe GET
// REMARQUE : Regardez bien l'URL de votre navigateur lorsqu'il affiche la réponse. Le prénom et le nom sont visibles !

if (filter_has_var(INPUT_GET, "nom") && filter_has_var(INPUT_GET, "prenom")) {
    $varPrenomRecup = filter_input(INPUT_GET, 'prenom', FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[A-ZÇÉÈÊËÀÂÎÏÔÙÛ]{1}([a-zçéèêëàâîïôùû]+|([a-zçéèêëàâîïôùû]+-[A-ZÇÉÈÊËÀÂÎÏÔÙÛ]{1}[a-zçéèêëàâîïôùû]+)){1,19}$/"]]);
    $varNomRecup = filter_input(INPUT_GET, 'nom', FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[A-ZÇÉÈÊËÀÂÎÏÔÙÛ]{1}([a-zçéèêëàâîïôùû]+|([a-zçéèêëàâîïôùû]+-[A-ZÇÉÈÊËÀÂÎÏÔÙÛ]{1}[a-zçéèêëàâîïôùû]+)){1,19}$/"]]);
    if ($varNomRecup && $varPrenomRecup) {
        echo 'Le serveur a bien reçu le prénom : ', $varPrenomRecup, '<br>';
        echo 'Le serveur a bien reçu le nom : ', $varNomRecup, '<br>';
    }
}


