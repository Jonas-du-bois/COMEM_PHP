<?php
$ok = false;
$prenom="";
$age="";
$erreurs["prenom"]="";
$erreurs["age"]="";
if (filter_has_var(INPUT_POST, 'submit')) {
    $ok = true;
    $prenom = filter_input(INPUT_POST, 'prenom', FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[A-ZÇÉÈÊËÀÂÎÏÔÙÛ]{1}([a-zçéèêëàâîïôùû]+){1,19}$/"]]);
    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 122]]);
    if ($prenom === false) {
        $erreurs['prenom'] = " Ton prénom n'est pas valide";
        $ok = false;
    }
    if ($age === false) {
        $erreurs['age'] = " Ton âge n'est pas valide";
        $ok = false;
    }
    if ($ok) {
        echo "Tu t'appelles " . $prenom . " et tu as " . $age . " an(s)";
    }
}
$html = "
<html>
    <head>
        <meta charset='UTF-8'>
        <title>Validation de formulaire</title>
    </head>
    <body>
        <form action='' method='post'>
            <div>
                Entre ton prénom :
                <input type='text' name='prenom' value='" . $prenom . "'>" . $erreurs['prenom'] . "
            </div>
            <div>
                Entre ton âge :
                <input type='text' name='age' value='" . $age . "'>" . $erreurs['age'] . "
            </div>
            <div>
                <input type='submit' name='submit' value='envoyer'>
            </div>
        </form>
    </body>
</html>";

if (!$ok) {
    echo $html;
}