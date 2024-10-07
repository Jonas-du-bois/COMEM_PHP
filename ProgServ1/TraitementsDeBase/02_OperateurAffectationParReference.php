<html>
    <head>
        <link rel="shortcut icon" href="#" /> <!-- pour éviter le message favicon.ico dans la fenêtre output -->
        <meta charset="utf-8" />
        <title>Affectation par référence</title>
    </head>
    <body>
        <?php
        $reference = 1;
        $copieReferencee = &$reference; // la copie est intimement liée à origine
        $reference++;                   // On incrémente de 1 $reference
        ?>
        L'affectation par référence = & permet de "lier" deux variables.
        <br>
        <br>
        Soit le code suivant :
        <br>
        &ensp; $reference = 1;
        <br>
        &ensp; $copieReferencee = &$reference;
        <br>
        &ensp; $reference++;
        <br>
        &ensp; echo $reference; //affiche <?php echo $reference; ?>
        <br>
        &ensp; echo $copieReferencee; //affiche <?php echo $copieReferencee; ?>
        <br>
        <br>
        Une modification de la copie référencée modifiera aussi la référence !!!! :
        <br>
        <?php
        $copieReferencee = 5;           // ET VICE-VERSA !!!!!!
        ?>
        &ensp; $copieReferencee = 5;
        <br>
        &ensp; echo $reference; //affiche <?php echo $reference; ?>
        <br>
        &ensp; echo $copieReferencee; //affiche <?php echo $copieReferencee; ?>
        <br>
        <br>
        Autrement dit : cela correspond à avoir une même information qui porte deux noms différents !
        <br>
        <br>
        Exemple d'utilisation :
        <br>
        &ensp;Soit le tableau suivant :
        <br>
        &ensp;$tab = [1,2,3,4];
        <br>
        &ensp;Auquel on voudrait ajouter 2 à chaque valeur du tableau
        <br><br>
        <?php
        
        $tab = [1,2,3,4];
        echo "Sans utilisation de l'affectation par référence : ","<br>";
        foreach ($tab as $element) {
            $element = $element + 2;
        }
        foreach ($tab as $element) {
            echo $element,"<BR>";
        }
        echo "   Cela ne fonctionne pas ! Car \$element reçoit une copie de la valeur du tableau => le résultat de l'addition est perdu";
        echo "<br><br>";
        echo "Avec utilisation de l'affectation par référence : ","<br>";
        foreach ($tab as &$element) {
            $element = $element + 2;
        }
        unset($element); // FORTEMENT CONSEILLE !!   c.f. modifie sinon la dernière valeur du tableau !!!
        foreach ($tab as $element) {
            echo $element,"<BR>";
        }
        echo "   Cela fonctionne ! Car \$element reçoit une référence à la valeur du tableau => le résultat de l'addition affecte la valeur originale";
        echo "<br><br>";
        
        $tab2 = [10,20,30,40];
        
        // Comme les tableaux en php ne sont pas passé en référence par défaut (contrairement à java), il faut le spécifier
        function ajouteDeux(&$tab) {
            $nbElements = count($tab);
            for ($i=0;$i<$nbElements;$i++) {
                $tab[$i]=$tab[$i]+2;
            }
        }
        
        ajouteDeux($tab2);
        
        echo "Voir le fichier source pour cette partie<BR>";
        
        foreach ($tab2 as $element) {
            echo $element,"<BR>";
        }
        
        ?>
    </body>
</html>