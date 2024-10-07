<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire Adaptatif</title>
    <style>
        /* Ajout d'un peu de style pour une meilleure présentation */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            width: 50%;
        }
        div {
            margin-bottom: 20px;
        }
        label {
            display: inline-block;
            width: 80px;
        }
        input[type="text"] {
            padding: 5px;
            width: 200px;
        }
    </style>
</head>
<body>
    <form action="AffichePrenom.php" method="post">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['nombre'])) {
                $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_NUMBER_INT); // Validation sécurisée

                if ($nombre && ctype_digit($nombre)) {
                    $_SESSION['nombre'] = $nombre;

                    // Génération du formulaire dynamique pour chaque personne
                    for ($i = 1; $i <= $nombre; $i++) {
                        echo "<div style='border: 1px solid #ccc; background-color: #f9f9f9; padding: 10px;'>";
                        echo "<h3>Personne $i</h3>";
                        
                        // Champ pour le nom
                        echo "<div style='margin-bottom: 10px;'>";
                        echo "<label for='name_$i'>Nom :</label>";
                        echo "<input type='text' name='name[]' id='name_$i' required />";
                        echo "</div>";

                        // Champ pour le prénom
                        echo "<div>";
                        echo "<label for='forname_$i'>Prénom :</label>";
                        echo "<input type='text' name='forname[]' id='forname_$i' required />";
                        echo "</div>";

                        echo "</div>";
                    }
                } else {
                    echo "<p>Le nombre doit être un entier valide.</p>";
                }
            }
        }
        ?>

        <input type="submit" value="Envoyer" />
    </form>
</body>
</html>
