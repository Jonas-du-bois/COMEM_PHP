<html>
    <head>
        <link rel="shortcut icon" href="#" /> <!-- pour éviter le message favicon.ico dans la fenêtre output -->
        <meta charset="utf-8" />
        <title>Opérateur ternaire</title>
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
        Exemple 1 :
        <br>
        <br>
        <table>
            <?php
            $a = 5;
            $b = 7;
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
                    <td><?php echo $a; ?></td>
                </tr>
                <tr>
                    <td>$b</td>
                    <td><?php echo $b; ?></td>
                </tr>
            </tbody>
        </table>
        <br>
        L'opérateur ternaire comprend trois opérandes. 
        <br>
        Il retourne la valeur du second si le premier vaut true, sinon retourne la valeur du troisième.
        <br>
        <br>
        Soit l'expression suivante :
        <br>
        <br>
        &ensp; echo $a < $b ? 'A est inférieur à B' : 'A est supérieur ou égal à B';
        <br>
        <br>
        Le 1er opérande est : $a < $b
        <br>
        Le 2e opérande est : 'A est inférieur à B'
        <br>
        Le 3e opérande est : 'A est supérieur ou égal à B'
        <br>
        <br>
        Le résultat de l'expression affichera donc : 
        <?php
        echo $a < $b ? 'A est inférieur à B' : 'A est supérieur ou égal à B';
        ?>
        <br>
        <br>
        Exemple 2 :
        <br>
        <br>
        <table>
            <?php
            $machineEstEnPanne = true;
            ?>
            <thead>
                <tr>
                    <th>Variable</th>
                    <th>Valeur</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$machineEstEnPanne</td>
                    <td><?php echo $machineEstEnPanne ? 'true' : 'false'; ?></td>
                </tr>
            </tbody>
        </table>
        <br>
        Soit l'expression suivante :
        <br>
        <br>
        &ensp; $couleurLed = $machineEstEnPanne ? 'rouge' : 'verte';
        <br>
        <br>
        Le 1er opérande est : $machineEstEnPanne
        <br>
        Le 2e opérande est : 'rouge'
        <br>
        Le 3e opérande est : 'verte'
        <br>
        <br>
        La variable $couleurLed vaudra donc : 
        <?php
        $couleurLed = $machineEstEnPanne ? 'rouge' : 'verte';
        echo $couleurLed;
        ?>
        <br><br>
        Exemple 3 (Opérateur Elvis) : 
        <br>
        <img src="imgOp/OperateurElvis.png" alt="Mon image" height="100" width="90" />
        <br>
        On peut omettre le second opérande ! Ce qui transforme l'opérateur ternaire en opérateur Elvis.
        <br>
        L'opérateur retournera ce qu'il y a dans le premier opérande si celui-ci est vrai, sinon retourne ce qu'il y a après les deux points.
        <br>
        <table>
            <br>
            <thead>
                <tr>
                    <th>Variable</th>
                    <th>Valeur</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$couleur</td>
                    <td><?php
                        $couleur = "";
                        echo $couleur;
                        ?></td>
                </tr>
            </tbody>
        </table>
        <br>
        &ensp; echo $couleur ?: 'rouge (couleur par défaut)';
        <br>
        <br>
        Affichera donc : 
        <?php
        echo $couleur ?: 'rouge (couleur par défaut)'; // Rappel : Est considéré comme false :
        //                                                       - l'entier 0 
        //                                                       - le réel 0.0
        //                                                       - une chaine vide
        //                                                       - la chaine "0",
        //                                                       - un tableau avec aucun élément,
        //                                                       - null
        //                                                       - une variable non définie
        //                                                       - SimpleXML créé avec des balises vides
        ?>
        <br><br>
        Exemple 3 Bis (Opérateur Elvis) :
        <br>
        <table>
            <br>
            <thead>
                <tr>
                    <th>Variable</th>
                    <th>Valeur</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>$couleur</td>
                    <td><?php
                        $couleur = "vert";
                        echo $couleur;
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        &ensp; echo $couleur ?: 'rouge (couleur par défaut)';
        <br>
        <br>
        Affichera donc : 
        <?php
        echo $couleur ?: 'rouge (couleur par défaut)';
        ?>
        <br>
        <br>
        <br>
        Exemple 4 (Opérateur de nullité) :
        <br>
        L'opérateur retournera ce qu'il y a après les ?? si le premier opérande n'est pas défini
        <br>
        &ensp; $prenom = $unPrenom ?? "Bibi"; <br>
        &ensp; echo $prenom; // affichera <?php echo $unPrenom ?? "Bibi"; ?> car $prenom n'a pas été définie<br>
        <br>
        <br>
        &ensp; Est équivalent à : 
        <br>
        <br>
        &ensp; if (!isset($unPrenom)) { <br>
        &emsp;   $prenom = "Bibi"; <br>
        &ensp; } else { <br>
        &emsp;   $prenom = $unPrenom; <br>
        &ensp; }; <br>
        <br>
    </body>
</html>