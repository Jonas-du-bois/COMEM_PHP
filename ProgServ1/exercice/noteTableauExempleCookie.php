<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exemple de Cookies</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        textarea {
            resize: vertical;
            height: 100px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background-color: #007BFF;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .output {
            margin-top: 20px;
            padding: 20px;
            background-color: #e9ecef;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestion des Notes</h1>
        <form action="" method="post">
            <label for="ajouteNote">Ajoutez une note :</label>
            <textarea id="ajouteNote" name="ajouteNote"></textarea>
            <input type="submit" name="submit" value="Envoyer">
        </form>
        <br>
        <a href="?reset=1">Réinitialiser les notes</a>

        <?php
        require_once 'RequestHandler.php';

        // Démarrer la session
        session_start();

        // Définir la durée de vie du cookie (par exemple, 1 jour)
        $cookie_lifetime = time() + (86400 * 1); // 86400 secondes = 1 jour

        // Fonction pour récupérer les données de l'élève depuis le cookie
        function getEleveFromCookie() {
            if (isset($_COOKIE['eleve'])) {
                return unserialize($_COOKIE['eleve']);
            }
            return [
                'nom' => 'Jonas',
                'prenom' => 'Du Bois',
                'notes' => []
            ];
        }

        // Fonction pour sauvegarder les données de l'élève dans le cookie
        function saveEleveToCookie($eleve, $cookie_lifetime) {
            setcookie('eleve', serialize($eleve), $cookie_lifetime, "/");
        }

        // Fonction pour traiter la réinitialisation des notes
        function handleReset($eleve, $cookie_lifetime) {
            if (RequestHandler::getGet('reset') == 1) {
                $eleve['notes'] = [];
                saveEleveToCookie($eleve, $cookie_lifetime);
            }
            return $eleve;
        }

        // Fonction pour ajouter une note
        function addNoteIfValid($eleve, $cookie_lifetime) {
            if (RequestHandler::getServer("REQUEST_METHOD") == "POST" && RequestHandler::getPost('ajouteNote') !== null) {
                $note = RequestHandler::getPost('ajouteNote');
                if (preg_match('/^(6(\.0)?|[1-5](\.5)?)$/', $note)) {
                    // Ajouter la note au tableau des notes
                    $eleve['notes'][] = (float) $note;

                    // Sauvegarder toutes les notes dans le cookie
                    saveEleveToCookie($eleve, $cookie_lifetime);

                    echo "<p>Note '$note' ajoutée avec succès à l'élève {$eleve['nom']} {$eleve['prenom']}.</p>";
                } else {
                    echo "<p>Veuillez entrer une note valide (de 1 à 6 par pas de 0.5).</p>";
                }
            }
            return $eleve;
        }

        // Récupérer l'élève depuis le cookie
        $eleve = getEleveFromCookie();

        // Traiter la réinitialisation
        $eleve = handleReset($eleve, $cookie_lifetime);

        // Ajouter la note si valide
        $eleve = addNoteIfValid($eleve, $cookie_lifetime);

        // Afficher les notes sous forme de tableau
        echo '<div class="output">';
        if (!empty($eleve['notes'])) {
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Nom</th>';
            echo '<th>Prénom</th>';
            echo '<th>Notes</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            echo '<tr>';
            echo '<td>' . htmlspecialchars($eleve['nom']) . '</td>';
            echo '<td>' . htmlspecialchars($eleve['prenom']) . '</td>';
            echo '<td>';
            echo '<ul>';
            foreach ($eleve['notes'] as $note) {
                echo '<li>' . htmlspecialchars($note) . '</li>';
            }
            echo '</ul>';
            echo '</td>';
            echo '</tr>';
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>Aucune note à afficher.</p>';
        }
        echo '</div>';
        ?>
    </div>
</body>
</html>
