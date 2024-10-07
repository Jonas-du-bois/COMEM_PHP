<?php
$nomImage = "img";
$no = "01";
$extension = ".png";
$repertoire = "img/";
$nomComplet = $repertoire . $nomImage . $no . $extension;
?>
<html> 
    <head>
        <link rel="shortcut icon" href="#" /> <!-- pour éviter le message favicon.ico dans la fenêtre output -->
        <title>Structure de base</title>
    </head>
    <body>
        <p>
            Voici ma première image :<br><br>
            <img src="<?php echo $nomComplet ?>" alt="Mon image" />
        </p>
    </body> 
</html>