<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="styleSheet.css" />
        <title>Générateur de mot de passe</title>
    </head>

    <body>
        <br>
        <h2>Attention nombre de caractère max 255 et min 0</h2>
        <form action="GénérateurdeMotDePasse.php" method="post">
            <label for="nbCarSpeciaux">Nombre de caractères spéciaux :</label>
            <input type="number" min="0" max="255" id="nbCarSpeciaux" name="nbCarSpeciaux">
            <label for="nbChiffres">Nombre de chiffres (0-9) :</label>
            <input type="number" min="0" max="255" id="nbChiffres" name="nbChiffres">
            <label for="nbMinuscules">Nombre de minuscules (a-z) :</label>
            <input type="number" min="0" max="255" id="nbMinuscules" name="nbMinuscules">
            <label for="nbMajuscules">Nombre de majuscules (A-Z) :</label>
            <input type="number" min="0" max="255" id="nbMajuscules" name="nbMajuscules">
            <input type="submit" name="submit" value="Envoyer">
        </form>

        <div id="passwordCount"></div>

        <div id="result"></div>

        <form action="clearPasswords.php" method="post">
            <input type="submit" name="clear" value="Vider le fichier de mots de passe">

            <?php
            require_once 'MotDePasseAleatoire.php';

            // Options de validation pour les champs de formulaire
            $options = [
                'options' => [
                    'min_range' => 0,
                    'max_range' => 255,
                ]
            ];

            // Vérifie si le formulaire a été soumis
            if (filter_has_var(INPUT_POST, 'submit')) {
                // Récupère et valide les valeurs des champs de formulaire
                $nbCarSpeciaux = filter_input(INPUT_POST, 'nbCarSpeciaux', FILTER_VALIDATE_INT, $options);
                $nbChiffres = filter_input(INPUT_POST, 'nbChiffres', FILTER_VALIDATE_INT, $options);
                $nbMinuscules = filter_input(INPUT_POST, 'nbMinuscules', FILTER_VALIDATE_INT, $options);
                $nbMajuscules = filter_input(INPUT_POST, 'nbMajuscules', FILTER_VALIDATE_INT, $options);

                // Vérifie si les valeurs sont valides
                if (!$nbCarSpeciaux || !$nbChiffres|| !$nbMinuscules || !$nbMajuscules ) {
                    // Affiche un message d'erreur si les valeurs ne sont pas valides
                    echo "<script>
                    document.getElementById('result').innerHTML = '<div class=\"result\">Veuillez entrer des valeurs valides pour tous les champs.</div>';
                  </script>";
                } else {
                    // Génère le mot de passe si les valeurs sont valides
                    $motDePasse = MotDePasseAleatoire::genereMotDePasse($nbCarSpeciaux, $nbChiffres, $nbMinuscules, $nbMajuscules);

                    // Affiche le mot de passe généré
                    echo "<script>
                    document.getElementById('result').innerHTML = '<div class=\"result\">Votre mot de passe généré est : <strong>" . $motDePasse . "</strong></div>';
                  </script>";
                }
            }
            ?>

    </body>

</html>