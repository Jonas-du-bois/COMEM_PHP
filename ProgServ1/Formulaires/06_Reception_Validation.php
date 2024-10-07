<?php

// Documentation officielle : http://php.net/manual/fr/function.filter-input.php
// Vive les expressions régulières : https://www.lucaswillems.com/fr/articles/25/tutoriel-pour-maitriser-les-expressions-regulieres
$prenom = filter_input(INPUT_POST, 'prenom', FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[A-ZÇÉÈÊËÀÂÎÏÔÙÛ]{1}([a-zçéèêëàâîïôùû]+|([a-zçéèêëàâîïôùû]+-[A-ZÇÉÈÊËÀÂÎÏÔÙÛ]{1}[a-zçéèêëàâîïôùû]+)){1,19}$/"]]);
$npa = filter_input(INPUT_POST, 'npa', FILTER_VALIDATE_INT);
$mail = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$ageMin = 0;
$ageMax = 122; // Le record d'ancienneté officiel est de 122 ans (Le record innofficiel est de 147 ans.)
$age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT, ['options' => ['min_range' => $ageMin, 'max_range' => $ageMax]]);

if (!$prenom) {
    echo "Votre prénom n'est pas valide", '<br>';
} else {
    echo 'Votre prénom est : ', $prenom, '<br>';
}

if (!$npa) {
    echo "Votre npa n'est pas valide", '<br>';
} else {
    echo 'Votre npa est : ', $npa, '<br>';
}

if (!$mail) {
    echo "Votre email n'est pas valide", '<br>';
} else {
    echo 'Votre email est : ', $mail, '<br>';
}

if (!$age) {
    echo "Votre age n'est pas valide", '<br>';
} else {
    echo "Votre age est : ", $age, '<br>';
}