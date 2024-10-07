<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Exemple de tableau</title>
    </head>
    <body>
        <form action="" method="post">
            <label for="ajouteNote">Ajoute une note :</label>
            <textarea id="ajouteNote" name="ajouteNote"></textarea>
            <br>
            <input type="submit" name="submit" value="Envoyer">
        </form>
        <br>
        <a href="?reset=1">Reset</a>
        <?php
        // Démarrer la session
        session_cache_expire(15);
        session_start();

        
        if (isset($_GET['reset']) && $_GET['reset'] == 1) {
            // Réinitialiser la session
            $_SESSION['eleve'] = [
            'nom' => 'Jonas',
            'prenom' => 'Du Bois',
            'notes' => []
            ];
            header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
        exit;
        }
        
        // Initialiser l'élève à partir de la session si disponible, sinon créer un nouvel élève
        if (isset($_SESSION['eleve'])) {
            $eleve = $_SESSION['eleve'];
        } else {
            $eleve = [
                'nom' => 'Jonas',
                'prenom' => 'Du Bois',
                'notes' => [6, 5.5, 4.5]
            ];
        }

        // Vérification si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['ajouteNote'])) {
                if (filter_input(INPUT_POST, 'ajouteNote')) {
                    // Récupérer la note envoyée via le formulaire
                    $note = $_POST['ajouteNote'];

                    // Valider la note avec une expression régulière
                    if (preg_match('/^(6(\.0)?|[1-5](\.5)?)$/', $note)) {
                        // Assurer que $eleve['notes'] est un tableau
                        if (!isset($eleve['notes']) || !is_array($eleve['notes'])) {
                            $eleve['notes'] = [];
                        }

                        // Ajouter la note à l'array des notes de l'élève
                        $eleve['notes'][] = $note;

                        // Sauvegarder $eleve dans la session
                        $_SESSION['eleve'] = $eleve;

                        // Afficher un message de confirmation
                        echo "<p>Note '$note' ajoutée avec succès à l'élève $eleve[nom] $eleve[prenom].</p>";
                    } else {
                        echo "<p>Veuillez entrer une note valide (de 1 à 6 par pas de 0.5).</p>";
                    }
                }
            }
        }

        // Afficher le tableau de manière graphique
        echo "<pre>";
        print_r($eleve);
        echo "</pre>";
        ?>
    </body>
</html>
