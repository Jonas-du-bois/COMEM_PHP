<html>
    <head>
        <link rel="shortcut icon" href="#" /> <!-- pour éviter le message favicon.ico dans la fenêtre output -->
        <meta charset="utf-8" />
        <title>Opérateurs sur les bits</title>
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
        Soit les variables suivantes :
        <br>
        <br>
        <table>
            <?php 
            $a = 0b1010;
            $b = 0b1100; 
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
                    <td><?php printf('%b', $a);?></td>
                </tr>
                <tr>
                    <td>$b</td>
                    <td><?php printf('%b', $b);?></td>
                </tr>
            </tbody>
        </table>
        <br>
        Voici la liste des opérateurs sur les bits <br><br>
        <table>
            <thead>
                <tr>
                    <th>Opérateur</th>
                    <th>Signification</th>
                    <th>Exemple</th>
                    <th>Resultat</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>&</td>
                    <td>Et (met à 1 le bit de position x si les bits correspondants de $a et $b sont à 1)</td>
                    <td>printf('%b', $a & $b);</td>
                    <td><?php printf('%b', $a & $b);?></td>
                </tr>
                <tr>
                    <td>|</td>
                    <td>Ou (met à 1 le bit de position x si les bits correspondants de $a ou $b sont à 1)</td>
                    <td>printf('%b', $a | $b);</td>
                    <td><?php printf('%b', $a | $b);?></td>
                </tr>
                <tr  style="background-color: #F7F7F7">
                    <td>^</td>
                    <td>Ou exclusif (met à 1 le bit de position x si les bits correspondants de $a est à 1 ou $b est à 1, mais pas les deux)</td>
                    <td>printf('%b', $a ^ $b);</td>
                    <td><?php printf('%04b', $a ^ $b); // le 04 est pour forcer l'affichage du 1er zéro !'?></td>
                </tr>
                <tr>
                    <td>~</td>
                    <td>Négation (met à 1 le bit de position x si le bit correspondant de $a est à 0)</td>
                    <td>printf('%b', ~$a);</td>
                    <td><?php printf('%b', ~$a);?></td>
                </tr>
                <tr  style="background-color: #F7F7F7">
                    <td><<</td>
                    <td>Décalage à gauche (de 1 bit)</td>
                    <td>printf('%b', $a<<1);</td>
                    <td><?php printf('%b', $a<<1);?></td>
                </tr>
                <tr>
                    <td>>></td>
                    <td>Décalage à droite (de 1 bit)</td>
                    <td>printf('%b', $a>>1);</td>
                    <td><?php printf('%b', $a>>1);?></td>
                </tr>
            </tbody>
        </table>
        <?php
        echo "Quelques opérations : (Voir code source)","<BR>";
        $nombre1 = 10;
        echo base_convert($nombre1, 10, 2), "<BR>";  // conversion de nombre1 en base 10 à la base 2
        $nombre2 = 0b1010;                          // déclaration d'un entier d'après sa valeur binaire => nombre2 = 10;                                
        echo '$nombre2 : ', $nombre2, "<BR>";
        $chaine = decbin(10);                       // transformation de l'entier 10 en binaire (chaîne de caractère)
        echo '$chaine : ', $chaine, "<BR>";
        echo 'Avant décalage à gauche de 1 : ', decbin($nombre1), "<BR>"; // 01010  Remarque : 1er 0 n'est pas affiché !
        $nombre3 = $nombre1 << 1;
        echo 'Après décalage à gauche de 1 : ', decbin($nombre3), "<BR>"; // 10100  On décale les bits à gauche de 1
        $nombre4 = $nombre3 >> 2;
        echo 'Après décalage à droite de 2 : ', decbin($nombre4), "<BR>"; // 00101  On décale les bits à droite de 2
        $nombre5 = $nombre4 >> 1;
        echo 'Après décalage à droite de 1 : ', decbin($nombre5), "<BR>"; // 00010  On décale les bits à droite de 1 (1 bit de perdu ;-)
        $unEntierEnHexadecimal = 0xF2D8;            // F : 1111, 2 : 0010, D : 1101, 8 : 1000
        echo $unEntierEnHexadecimal, '=';
        printf('%b', $unEntierEnHexadecimal);        // Affiche la valeur binaire
        echo "<BR>";
        ?>
    </body>
</html>