<!DOCTYPE html>
<html>
    <head>
        <title>Affichage problématique</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        Portion de la table Unicode (Problèmes classiques d'enocdages de caractères)<br>
        <br>
        <table>
            <tr>
                <?php
                // Affichage des codes des caractères ASCII et leur caractères équivalent
                for ($i = 32; $i < 1024; $i++) {
                    if ($i % 16 == 0) {
                        echo '</tr><tr>';
                    }
                    echo '<td align="right">' . $i . '</td><td align="center"><strong> ' . chr($i) . ' </strong></td>';
                }
                ?>
            </tr>
        </table>
    </body>
</html>