<html>
    <head>
        <title>La fonction str_word_count</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
        // Remarque importante ! Ne fonctionne pas si les mots contiennent des accents :-O
        // Car les caractères accentués nécessitent plusieurs bytes... pffff...
        echo "Exemple 1 (Certaines fonctions vendent du rêve...)", "<br>";
        $chaine = "Ceci est une belle phrase pleine de mots";
        printf('Il y a %d mots dans la phrase "%s" <br> Les mots sont : <br>', str_word_count($chaine), $chaine);
        foreach (str_word_count($chaine, 1) as $mot) {
            printf('&emsp;%s <br>', $mot);
        }

        // Oups problème...
        echo "<br>", "Exemple 2 (Mais la réalité est parfois tout autre... VEILLEZ-VOUS DES ACCENTS !)", "<br>";
        $chaine2 = "       Un     été un être     a rêvé avoir été un hêtre     ";
        printf('Il y a %d mots dans la phrase "%s" <br> Les mots sont : <br>', str_word_count($chaine2), $chaine2);
        foreach (str_word_count($chaine2, 1) as $mot) {
            printf('&emsp;%s <br>', $mot);
        }

        // Problème résolu :-)
        echo "<br>", "Exemple 3 (Du coup, il faut trouver des alternatives :-))", "<br>";
        $chaine3 = "       Un     été un être     a rêvé avoir été un hêtre     ";
        $chaineSansEspacesSuperfux = trim(preg_replace('/[\t\n\r\s]+/', ' ', $chaine3));
        $mots = explode(" ", $chaineSansEspacesSuperfux);
        printf('Il y a %d mots dans la phrase "%s" <br> Les mots sont : <br>', count($mots), $chaineSansEspacesSuperfux);
        foreach ($mots as $mot) {
            echo $mot . "<BR>";
        }
        ?>
    </body>
</html>