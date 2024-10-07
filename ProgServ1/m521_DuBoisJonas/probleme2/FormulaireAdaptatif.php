<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Formulaire Adaptatif</title>
        <style>
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .container {
                background-color: #fff;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 500px;
            }
            fieldset {
                border: 1px solid #ddd;
                padding: 20px;
                border-radius: 8px;
            }
            legend {
                font-size: 1.2em;
                font-weight: bold;
                color: #333;
                padding: 0 10px;
            }
            label {
                display: block;
                margin-bottom: 10px;
                font-size: 1em;
                color: #333;
            }
            input[type="text"] {
                padding: 10px;
                width: 100%;
                font-size: 1em;
                border: 1px solid #ccc;
                border-radius: 4px;
                margin-bottom: 20px;
                transition: border 0.3s;
            }
            input[type="text"]:focus {
                border-color: #007BFF;
                outline: none;
            }
            input[type="submit"] {
                background-color: #007BFF;
                color: #fff;
                padding: 10px 20px;
                font-size: 1em;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s;
                display: block;
                width: 100%;
            }
            input[type="submit"]:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <form action="formulaireGenerer.php" method="post">
                <fieldset>
                    <legend>Formulaire Adaptatif</legend>

                    <label for="nombre">Combien de personnes voulez-vous saisir :</label>
                    <input type="text" name="nombre" id="nombre" required placeholder="Entrez un nombre de personnes" />

                    <input type="submit" value="Soumettre">
                </fieldset>
            </form>
        </div>
    </body>
</html>
