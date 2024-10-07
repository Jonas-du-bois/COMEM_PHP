<!DOCTYPE html>
<html>
<head>
    <title>Tableau des Multiplications</title>
    <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>

<h2>Tableau des Multiplications</h2>

<table>
    <tr>
        <th></th>
        <?php
        // En-têtes de colonnes
        for ($i = 1; $i <= 12; $i++) {
            echo "<th>$i</th>";
        }
        ?>
    </tr>
    <?php
    // Corps du tableau
    for ($i = 1; $i <= 12; $i++) {
        echo "<tr>";
        echo "<th>$i</th>"; // En-tête de ligne
        for ($j = 1; $j <= 12; $j++) {
            echo "<td>" . ($i * $j) . "</td>"; // Valeur de la cellule
        }
        echo "</tr>";
    }
    ?>
</table>

</body>
</html>
