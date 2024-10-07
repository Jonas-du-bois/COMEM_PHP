<?php $a = 2; ?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="#" /> <!-- pour éviter le message favicon.ico dans la fenêtre output -->
        <meta charset="utf-8" />
        <title>Opérateurs combinés</title>
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
        Voici la liste des opérateurs combinés de php<br><br>
        <table>
            <thead>
                <tr>
                    <th>Variable</th>
                    <th>Valeur</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$a</td>
                    <td><?php echo $a; ?></td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <table>
            <thead>
                <tr>
                    <th>Opérateur</th>
                    <th>Opération</th>
                    <th>Exemple</th>
                    <th>Description</th>
                    <th>Résultat</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>+=</td>
                    <td>Addition</td>
                    <td>echo $a+=3</td>
                    <td>ajoute 3 à la variable $a et stocke le résultat dans $a</td>
                    <td><?php
                        $b = $a;
                        echo $a += 3;
                        $a = $b
                        ?></td>
                </tr>
                <tr>
                    <td>-=</td>
                    <td>Soustraction</td>
                    <td>echo $a-=3</td>
                    <td>Soustrait 3 à la variable $a et stocke le résultat dans $a</td>
                    <td><?php
                        $b = $a;
                        echo $a -= 3;
                        $a = $b
                        ?></td>
                </tr>
                <tr  style="background-color: #F7F7F7">
                    <td>*=</td>
                    <td>Multiplication</td>
                    <td>echo $a*=3</td>
                    <td>Multiplie par 3 la variable $a et stocke le résultat dans $a</td>
                    <td><?php
                        $b = $a;
                        echo $a *= 3;
                        $a = $b
                        ?></td>
                </tr>
                <tr>
                    <td>**=</td>
                    <td>Puissance</td>
                    <td>echo $a**=3</td>
                    <td>Elève la variable $a à la puissance 3 et stocke le résultat dans $a</td>
                    <td><?php
                        $b = $a;
                        echo $a **= 3;
                        $a = $b
                        ?></td>
                </tr>
                <tr>
                    <td>/=</td>
                    <td>Division</td>
                    <td>echo $a/=3</td>
                    <td>Divise la variable $a par 3 et stocke le résultat dans $a</td>
                    <td><?php
                        $b = $a;
                        echo $a /= 3;
                        $a = $b
                        ?></td>
                </tr>
                <tr>
                    <td>%=</td>
                    <td>Modulo</td>
                    <td>echo $a%=3</td>
                    <td>Rend le reste de la division entière de $a par 3 et stocke le résultat dans $a</td>
                    <td><?php
                        $b = $a;
                        echo $a %= 3;
                        $a = $b
                        ?></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
