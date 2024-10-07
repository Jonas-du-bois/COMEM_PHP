<!DOCTYPE html>
<html>
    <head>
        <title>Affichage résolu</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport">
        <style>
            table, th, td {
                border: 1px solid black;
            }
            table tr:nth-child(odd){
                background-color:#F0F0F0;
            }
        </style>
    </head>
    <body>
        Portion de la table Unicode <br>
        <br>
        <table>
            <tr>
                <?php

                function chrBis($entier) {
                    //https://www.php.net/manual/fr/function.mb-convert-encoding.php
                    $codeHTML = '&#' . $entier . ';' ;
                    return mb_convert_encoding($codeHTML, 'UTF-8', 'HTML-ENTITIES');
                }

                // Affichage des codes des caractères ASCII et leur caractères équivalent
                for ($i = 32; $i <= 1024; $i++) {
                    if ($i % 16 == 0) {
                        echo '</tr><tr>';
                    }
                    echo '<td align="right">' . $i . '</td><td align="center"><strong> ' . chrBis($i) . ' </strong></td>';
                }
                ?>
            </tr>
        </table>
    </body>
</html>