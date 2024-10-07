<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="#" /> <!-- pour éviter le message favicon.ico dans la fenêtre output -->
        <meta charset="utf-8" />
        <title>Opérateurs de comparaisons</title>
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
        Voici la liste des opérateurs de comparaison de php <br><br>
        <table>
            <thead>
                <tr>
                    <th>Opérateur</th>
                    <th>Signification</th>
                    <th>Exemple</th>
                    <th>Description</th>
                    <th>Resultat</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>==</td>
                    <td>Egal à</td>
                    <td>echo 5 == 6;</td>
                    <td>Renvoie false car 5 n'est pas égal à 6</td>
                    <td><?php var_dump(5 == 6) ?></td>
                </tr>
                <tr>
                    <td>&lt;</td>
                    <td>Inférieur à </td>
                    <td>echo 5 &lt; 6;</td>
                    <td>Renvoie true car 5 est inférieur à 6</td>
                    <td><?php var_dump(5 < 6) ?></td>
                </tr>
                <tr  style="background-color: #F7F7F7">
                    <td>&gt;</td>
                    <td>Supérieur à</td>
                    <td>echo 5 &gt; 6;</td>
                    <td>Renvoie false car 5 n'est pas supérieur à 6</td>
                    <td><?php var_dump(5 > 6) ?></td>
                </tr>
                <tr>
                    <td>&lt;=</td>
                    <td>Inférieur ou égal à </td>
                    <td>echo 5 &lt;= 6;</td>
                    <td>Renvoie true car 5 est inférieur ou égal à 6</td>
                    <td><?php var_dump(5 <= 6) ?></td>
                </tr>
                <tr  style="background-color: #F7F7F7">
                    <td>&gt;=</td>
                    <td>Supérieur ou égal à</td>
                    <td>echo 5 &gt;= 6;</td>
                    <td>Renvoie false car 5 n'est pas supérieur ou égal à 6</td>
                    <td><?php var_dump(5 >= 6) ?></td>
                </tr>
                <tr>
                    <td>&lt;=&gt;</td>
                    <td>Supérieur/Inférieur/Egal à</td>
                    <td>echo 5 &lt;=&gt; 6;</td>
                    <td>Renvoie -1 car 5 est inférieur 6</td>
                    <td><?php var_dump(5 <=> 6) ?></td>
                </tr>
                <tr>
                    <td>&lt;=&gt;</td>
                    <td>Supérieur/Inférieur/Egal à</td>
                    <td>echo 6 &lt;=&gt; 5;</td>
                    <td>Renvoie 1 si 6 est suppérieur à 5</td>
                    <td><?php var_dump(6 <=> 5) ?></td>
                </tr>
                <tr>
                    <td>&lt;=&gt;</td>
                    <td>Supérieur/Inférieur/Egal à</td>
                    <td>echo 5 &lt;=&gt; 5;</td>
                    <td>Renvoie 0 car les deux valeurs sont identiques</td>
                    <td><?php var_dump(5 <=> 5) ?></td>
                </tr>
                <tr  style="background-color: #F7F7F7">
                    <td>!=</td>
                    <td>Différent de</td>
                    <td>echo 5 != 6</td>
                    <td>Renvoie true car 5 est différent de 6</td>
                    <td><?php var_dump(5 != 6) ?></td>
                </tr>
                <tr>
                    <td>===</td>
                    <td>Identique en type et valeur</td>
                    <td>echo 5 === 6</td>
                    <td>Renvoie false car 5 n'a pas la même valeur que 6, mais ils sont du même type !</td>
                    <td><?php var_dump(5 === 6) ?></td>
                </tr>
                <tr>
                    <td>!==</td>
                    <td>Différent en valeur ou en type</td>
                    <td>echo 5 !== 6</td>
                    <td>Renvoie true car 5 est différent de 6, mais ils sont du même type !</td>
                    <td><?php var_dump(5 !== 6 ) ?></td>
                </tr>
            </tbody>
        </table>
        <br><br>
        <table>
            <thead>
                <tr>
                    <th>Exemple</th>
                    <th>Résultat</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>25 == '25'</td>
                    <td><?php var_dump(25 == '25') ?></td>
                </tr>
                <tr>
                    <td>25 === '25'</td>
                    <td><?php var_dump(25 === '25') ?></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>
