<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="#" /> <!-- pour éviter le message favicon.ico dans la fenêtre output -->
        <meta charset="utf-8" />
        <title>Opérateurs arithmétiques</title>
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
        <?php $a = 2;
              $b = 3; ?>
        Voici la liste des opérateurs arthmétiques de php <br><br>
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
                <tr>
                    <td>$b</td>
                    <td><?php echo $b; ?></td>
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
                    <td>+</td>
                    <td>Addition</td>
                    <td>echo $a + $b;</td>
                    <td>Calcule la somme</td>
                    <td><?php echo $a + $b;?></td>
                </tr>
                <tr>
                    <td>-</td>
                    <td>Soustraction</td>
                    <td>echo $a - $b;</td>
                    <td>Calcule la différence</td>
                    <td><?php echo $a - $b ?></td>
                </tr>
                <tr>
                    <td>*</td>
                    <td>Multiplication</td>
                    <td>echo $a * $b;</td>
                    <td>Calcule le produit</td>
                    <td><?php echo $a * $b;?></td>
                </tr>
                <tr>
                    <td>**</td>
                    <td>Puissance</td>
                    <td>echo $a ** $b;</td>
                    <td>Calcule la puissance</td>
                    <td><?php echo $a ** $b;?></td>
                </tr>
                <tr>
                    <td>/</td>
                    <td>Division</td>
                    <td>echo $a / $b;</td>
                    <td>Calcule la division</td>
                    <td><?php echo $a / $b;?></td>
                </tr>
                <tr>
                    <td>%</td>
                    <td>Modulo</td>
                    <td>echo $a % $b;</td>
                    <td>Calcule le modulo</td>
                    <td><?php echo $a % $b;?></td>
                </tr>
            </tbody>
        </table>
        <br>
        Partie entière et fractionnaire :
        <br>
        <table>
            <?php
            $a = 5;
            $b = 3;
            ?>
            <thead>
                <tr>
                    <th>Variable</th>
                    <th>Valeur</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$a</td>
                    <td><?php echo $a;?></td>
                </tr>
                <tr>
                    <td>$b</td>
                    <td><?php echo $b;?></td>
                </tr>
            </tbody>
        </table>
        echo $a/$b; // affichera <?php echo $a/$b;?>
        <br>
        Pour obtenir la partie entière on utilisera soit :
        <br>
        &nbsp; echo (int)($a/$b); // affichera <?php echo (int)($a/$b);?>
        <br>
        &nbsp; echo (integer)($a/$b); // affichera <?php echo (integer)($a/$b);?>
        <br>
        &nbsp; echo intdiv($a,$b); // affichera <?php echo intdiv($a,$b);?>
        <br>
        Pour obtenir la partie fractionnaire on procédera ainsi :
        <br>
        &nbsp; echo $a/$b-(int)($a/$b); // affichera <?php echo $a/$b-(int)($a/$b);?>
        <br>
        &nbsp; echo $a/$b-(integer)($a/$b); // affichera <?php echo $a/$b-(integer)($a/$b);?>
        <br>
        &nbsp; echo $a/$b-intdiv($a,$b); // affichera <?php echo $a/$b-intdiv($a,$b);?>
        <br>
    </body>
</html>)