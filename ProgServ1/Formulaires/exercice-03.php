<?php

if (filter_has_var(INPUT_POST, 'submit')) {
    if (filter_has_var(INPUT_POST, 'livret')) {
        $livret = filter_input(INPUT_POST, 'livret', FILTER_VALIDATE_INT, ['options' => ['min_range' => 2, 'max_range' => 12]]);
        echo "Voici le livret ",$livret,':<br>';
        $masque = '%d x %d = %d <br>';
        for ($nbFois = 1; $nbFois <= 12; $nbFois++) {
            printf($masque, $nbFois, $livret, $nbFois * $livret);
        }
    } else {
        echo "Il faut sélectionner un livret !";
    }
} else {
    $html = "<html>
            <head>
                <meta charset='UTF-8'>
                <title>Boutons radios dynamiques</title>
            </head>
            <body>
                <form action='' method='post'>
                    <div>
                        Sélectionne le livret à afficher : 
                    </div>";
    for ($livret = 2; $livret <= 12; $livret++) {
        $html .= "  <div>
                        <input type='radio' id='bouton" . $livret . "' name='livret' value='" . $livret . "'>
                        <label for='bouton" . $livret . "'>" . "Livret " . $livret . "</label>
                    </div>";
    }
    $html .= "      <div>
                        <button type='submit' name='submit'>Envoyer</button>
                    </div>
                </form>
            </body>
        </html>";
    echo $html;
}