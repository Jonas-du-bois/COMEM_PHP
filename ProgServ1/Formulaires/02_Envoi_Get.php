<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Envoi avec méthode Get</title>
    </head>
    <body>
        <?php
        $prenom = "Archibald";
        $nom1 = "Addock";   // Pas de problèmes
        // PROBLEME
        $nom2 = "Ad'hoc";  // Problème de construction du a href à cause de l'apostrophe (Visualisez le code html côté client)
        ?>
        <a href='02_Reception_Get.php?prenom=<?php echo $prenom; ?>&nom=<?php echo $nom1; ?>'>Archibald Addock (OK)</a><br>
        <a href='02_Reception_Get.php?prenom=<?php echo $prenom; ?>&nom=<?php echo $nom2; ?>'>Archibald Ad'hoc (Problème)</a>
        <!-- REMARQUE IMPORTANTE : La longueur d'une URL est limitée à environ 3000 caractères ! -->
    </body>
</html>