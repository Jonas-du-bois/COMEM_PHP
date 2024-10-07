<?php

$tab = ["Toyota", "BMW", "Citroën", "Fiat", "Mazda", "Lancia", "Peugeot"];

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Formulaire exercice 4 - multiplication</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <p>Bienvenue sur l'ex de la table de multiplication, attention c'est trop la classe<br></p>
    <form action='formulaireTableauDynamic.php' method='post'>
        <?php
        foreach ($tab as $marqueDeVoiture) {
            echo "<label><input type='checkbox' name='marque[]' value='$marqueDeVoiture'> $marqueDeVoiture</label><br>";      //move très très smart
        }
        ?>
        <br>
        <input type="submit" value="Envoyer">
        <br><br>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifie si un nombre a été sélectionné
        if (isset($_POST['marque'])) {
            $marqueSelectionne = $_POST['marque'];
            echo "<h2>Vous avez choisi la table de multiplication de : </h2>";
            echo "<table>
                <tr>
                    <th>Marque de voiture</th>
                </tr>";
            // Affichage des données dans le tableau
            foreach ($marqueSelectionne as $marque) {
                echo "<tr>";
                echo "<td>" . $marque . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Aucune marque n'a été sélectionné.</p>";
        }
    }
    ?>
</body>
</html>

