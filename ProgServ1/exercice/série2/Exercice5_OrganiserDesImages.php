<html> 
    <head>
        <link rel="shortcut icon" href="#" /> <!-- pour éviter le message favicon.ico dans la fenêtre output -->
        <title>ex 5 img</title>
        
    </head>
    <body>
        <?php
        $nbColonne = 5;
        $nomImage = "img";
        $no = "01";
        $extension = ".png";
        $repertoire = "http://localhost/TraitementsDeBase/img/";
        $nomComplet = $repertoire . $nomImage . $no . $extension;

        for ($varBoucle = 0; $varBoucle <= 23; $varBoucle++) {
            $no++;
            if ($no < 10) {
                $nomComplet = $repertoire . $nomImage  ."0" .$no . $extension;
            } else {
                $nomComplet = $repertoire . $nomImage . $no . $extension;
            }
            echo '<div><img src="' . $nomComplet . '" alt="Image ' . $no . '" /></div>';
            echo'<br>';
        }
        ?>
    </body> 
</html>