<?php
session_start();
$nombre = $_SESSION['nombre'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si des noms et prénoms ont été soumis
    if (isset($_POST['name']) && isset($_POST['forname'])) {
        $name = $_POST['name'];
        $forname = $_POST['forname'];
        ?>

        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Liste des Personnes</title>
            <style>
                body {
                    font-family: 'Arial', sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 40px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }
                .container {
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 10px;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                    width: 100%;
                    max-width: 600px;
                }
                h2 {
                    color: #333;
                    margin-bottom: 20px;
                }
                ul {
                    list-style-type: none;
                    padding: 0;
                }
                ul li {
                    background-color: #f9f9f9;
                    padding: 10px;
                    margin-bottom: 10px;
                    border: 1px solid #ddd;
                    border-radius: 5px;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
                ul li span {
                    font-weight: bold;
                    color: #555;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Vous avez choisi les <?= $nombre ?> personnes suivantes :</h2>
                <ul>
                <?php
                // Affichage des données dans une liste
                for ($index = 0; $index < count($name); $index++) {
                    echo "<li><span>Prénom :</span> $forname[$index] <span>Nom :</span> $name[$index]</li>";
                }
                ?>
                </ul>
            </div>
        </body>
        </html>

        <?php
    } else {
        echo "<p>Vous n'avez choisi personne</p>";
    }
}
?>
