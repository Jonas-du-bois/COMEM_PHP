<?php
// déclarer les variables utile pour tout le scipt
$varPrenomRecup = "";
$varAgeRecup = "";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulaire exercice 1</title>
    </head>
    <body>
        <p>Ecrire un code affichant un formulaire permettant de saisir :<br>
            - Un prénom (Commence par une majuscule, suivi de minuscules, au moins 2 lettre)<br>
            - Un âge (0-122)<br>
            Et qui affiche à nouveau le formulaire (avec messages d'erreurs) tant que les champs ne sont pas validés correctement</p>
        <form action='ex_1.php' method='post'>
            <div>
                Entrez votre Age :
                <input type='number' name='age'>
                <?php
                // Afficher un message d'erreur si l'âge n'est pas valide
                if (filter_has_var(INPUT_POST, 'submit') && !isset($varAgeRecup)) {
                    echo '<span style="color:red;">L\'âge est invalide. Il doit être un nombre entre 0 et 122.</span>';
                }
                ?>
            </div>
            <div>
                Entrez votre prenom :
                <input type='text' name='prenom'>
                <?php
// Afficher un message d'erreur si le prénom n'est pas valide
                if (filter_has_var(INPUT_POST,'submit') && !isset($varPrenomRecup)) {
                    echo '<span style="color:red;">Le prénom est invalide. Il doit commencer par une majuscule, suivi de minuscules, et contenir au moins 2 lettres.</span>';
                }
                ?>
            </div>
            <div>
                <input type='submit' name='submit' value='envoyer'>
            </div>
        </form>
        <?php
//Vérification que le formulaire à bien été envoyé 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Vérification du prénom
            if (filter_has_var(INPUT_POST,'prenom')) {
                $varPrenomRecup = filter_input(INPUT_POST, 'prenom', FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[A-ZÇÉÈÊËÀÂÎÏÔÙÛ]{1}([a-zçéèêëàâîïôùû]+|([a-zçéèêëàâîïôùû]+-[A-ZÇÉÈÊËÀÂÎÏÔÙÛ]{1}[a-zçéèêëàâîïôùû]+)){1,19}$/"]]);
                echo 'Le serveur a bien reçu le prénom : ', $varPrenomRecup, '<br>';
            }
            //Vérification de l'age
            if (filter_has_var(INPUT_POST,'age')) {
                $varAgeRecup = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 122]]);
                echo 'Le serveur a bien reçu l\'age : ', $varAgeRecup, '<br>';
            }
        }
        ?>
    </body>
</html>
