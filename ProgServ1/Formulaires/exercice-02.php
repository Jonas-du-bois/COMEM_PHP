<?php

if (filter_has_var(INPUT_POST, 'submit')) {
    if (filter_has_var(INPUT_POST, 'marques')) {
        $marques = filter_input(INPUT_POST, 'marques', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
         echo '<pre/>';var_dump ($marques);
    } else {
        echo "Aucune marque n'a été sélectionnée";
    }
} else {
    $tab = ["Toyota", "BMW", "Citroën", "Fiat", "Mazda", "Lancia", "Peugeot"];
    $html = "<html>
            <head>
                <meta charset='UTF-8'>
                <title>Envoi cases à cocher multiples</title>
            </head>
            <body>
                <form action='' method='post'>
                    <div>
                        Sélectionne des marques : 
                    </div>";
    foreach ($tab as $marque) {
        $html .= "  <div>
                        <input type='checkbox' id='checkbox" . $marque . "' name='marques[]' value='" . $marque . "'>
                        <label for='checkbox" . $marque . "'>" . $marque . "</label>
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