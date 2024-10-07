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
    <form action='TableDeMultiplication.php' method='post'>
        <?php
        for ($num = 2; $num <= 12; $num++) {
            echo "<label><input type='radio' name='nombre' value='$num'> $num</label><br>";      //move très très smart
        }
        ?>
        <br>
        <input type="submit" value="Voir la table">
        <br><br>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Vérifie si un nombre a été sélectionné
        if (isset($_POST['nombre'])) {
            $nombreSelectionne = $_POST['nombre'];
            echo "<h2>Vous avez choisi la table de multiplication de : " . htmlspecialchars($nombreSelectionne) . "</h2>";
            echo "<table>
                <tr>
                    <th>Nombre</th>
                    <th>Multiplicateur</th>
                    <th>Résultat</th>
                </tr>";
            // Affichage des données dans le tableau
            for ($i = 1; $i <= 12; $i++) {
                echo "<tr>";
                echo "<td>" . $nombreSelectionne . "</td>";
                echo "<td>" . $i . "</td>";
                echo "<td>" . $nombreSelectionne * $i . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Aucun nombre n'a été sélectionné.</p>";
        }
    }
    ?>
</body>
</html>
