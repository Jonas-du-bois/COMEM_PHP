<!DOCTYPE html>
<html>
    <head>
        <link rel="shortcut icon" href="#" /> <!-- pour éviter le message favicon.ico dans la fenêtre output -->
        <meta charset="utf-8" />
        <title>Opérateurs logiques</title>
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
        Voici la liste des opérateurs logiques de php <br><br>
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
                    <td>!</td>
                    <td>Inverseur</td>
                    <td>echo !true;</td>
                    <td>Renvoie false</td>
                    <td><?php var_dump(!true); ?></td>
                </tr>
                <tr>
                    <td>&&</td>
                    <td>Et (Les deux doivent être vrai pour que le résultat soit vrai)</td>
                    <td>echo true && true;</td>
                    <td>Renvoie true, car les deux sont vrais</td>
                    <td><?php var_dump(true && true); ?></td>
                </tr>
                <tr  style="background-color: #F7F7F7">
                    <td>||</td>
                    <td>Ou (Un des deux ou les deux doivent être vrai pour que le résultat soit vrai)</td>
                    <td>echo true || false;</td>
                    <td>Renvoie true, car un des deux est vrai</td>
                    <td><?php var_dump(true || false); ?></td>
                </tr>
                <tr>
                    <td>AND</td>
                    <td>Et (Les deux doivent être vrai pour que le résultat soit vrai)</td>
                    <td>echo true AND true;</td>
                    <td>Renvoie true, car les deux sont vrais</td>
                    <td><?php var_dump(true AND true); ?></td>
                </tr>
                <tr  style="background-color: #F7F7F7">
                    <td>OR</td>
                    <td>Ou (Un des deux ou les deux doivent être vrai pour que le résultat soit vrai)</td>
                    <td>echo true OR false;</td>
                    <td>Renvoie true, car un des deux est vrai</td>
                    <td><?php var_dump(true OR false); ?></td>
                </tr>
                <tr>
                    <td>XOR </td>
                    <td>Ou exclusif (Soit l'un, soit l'autre doit être vrai (mais pas les deux) pour que le résultat doit vrai</td>
                    <td>echo true XOR true;</td>
                    <td>Renvoie false, car un seul des deux doit être vrai</td>
                    <td><?php var_dump(true XOR true); ?></td>
                </tr>
            </tbody>
        </table>
    </body>
</html>