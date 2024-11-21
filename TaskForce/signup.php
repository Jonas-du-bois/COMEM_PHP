<?php

require_once 'vendor\autoload.php';

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

use M521\Taskforce\dbManager\DbManagerCRUD;
use M521\Taskforce\dbManager\Users;

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - TaskForce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include('includes/header.php'); ?>

    <main class="container mt-5">
        <h1 class="text-center mb-4">Inscription à TaskForce</h1>
        <p class="text-center mb-5">Crée un compte et rejoins-nous dans cette aventure (sans récompenses pour l'instant) !</p>

        <!-- Formulaire d'inscription -->
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <form action="signup.php" method="POST">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">Prénom :</label>
                        <input type="text" id="firstname" name="firstname" class="form-control" required minlength="3" maxlength="20" placeholder="Entrez votre prénom" value="<?php echo isset($_POST['firstname']) ? htmlspecialchars($_POST['firstname']) : ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="lastname" class="form-label">Nom :</label>
                        <input type="text" id="lastname" name="lastname" class="form-control" required minlength="3" maxlength="20" placeholder="Entrez votre nom" value="<?php echo isset($_POST['lastname']) ? htmlspecialchars($_POST['lastname']) : ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail :</label>
                        <input type="email" id="email" name="email" class="form-control" required placeholder="Entrez votre adresse e-mail" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Numéro de téléphone :</label>
                        <input type="tel" id="phone" name="phone" class="form-control" required placeholder="076 123 45 67" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe :</label>
                        <input type="password" id="password" name="password" class="form-control" required minlength="8" placeholder="Entrez votre mot de passe">
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary w-100">Créer un compte</button>
                </form>

                <?php
                $dbUser = new DbManagerCRUD();
                $dbUser->creeTable();

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Récupérer les données du formulaire avec filter_input
                    $nom = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
                    $prenom = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
                    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                    $noTel = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_SPECIAL_CHARS);
                    $motDePasse = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

                    // Regex pour valider les prénoms et noms (lettres et espaces uniquement)
                    $namePattern = "/^[a-zA-ZÀ-ÿ' -]{3,20}$/";

                    // Regex pour le numéro de téléphone (format international ou local)
                    $telPattern = "/^\+?[0-9]{10,15}$/";

                    // Regex pour le mot de passe avec les caractères spéciaux
                    $passwordPattern = "/^(?=.*[A-Z])(?=.*[\W_])(?=.{8,})/";

                    $errors = []; // Tableau pour stocker les messages d'erreur
                    // Validation du prénom
                    if (!preg_match($namePattern, $prenom)) {
                        $errors[] = "Le prénom est invalide. Veuillez utiliser uniquement des lettres et des espaces.";
                    }

                    // Validation du nom
                    if (!preg_match($namePattern, $nom)) {
                        $errors[] = "Le nom est invalide. Veuillez utiliser uniquement des lettres et des espaces.";
                    }

                    // Validation de l'adresse e-mail
                    if (!$email) {
                        $errors[] = "L'adresse e-mail est invalide.";
                    }

                    // Validation du numéro de téléphone
                    if (!preg_match($telPattern, $noTel)) {
                        $errors[] = "Le numéro de téléphone est invalide. Veuillez entrer un numéro valide (10 à 15 chiffres).";
                    }

                    // Validation du mot de passe
                    if (!preg_match($passwordPattern, $motDePasse)) {
                        $errors[] = "Le mot de passe doit comporter au moins 8 caractères, dont une majuscule et un caractère spécial.";
                    }

                    // Afficher les erreurs
                    if (!empty($errors)) {
                        foreach ($errors as $error) {
                            echo "<p style='color: red;'>$error</p>";
                        }
                    } else {
                        // Si toutes les validations passent, traiter les données
                        // Création d'un nouvel utilisateur
                        $newUser = new Users($prenom, $nom, $email, $noTel, $motDePasse);

                        // Génération du token de confirmation
                        $token = $newUser->rendToken();

                        try {
                            // Ajout du nouvel utilisateur dans la base de données
                            $id = $dbUser->ajoutePersonne($newUser);

                            // Lien de confirmation
                            $confirmationLink = "http://localhost/Taskforce/confirmation.php?token=" . urlencode($token);

                            // Envoi du mail de confirmation
                            $transport = Transport::fromDsn('smtp://localhost:1025'); 
                            $mailer = new Mailer($transport);
                            $message = (new Email())
                                ->from('support@taskforce.com')
                                ->to($email)
                                ->subject('Confirmation de votre inscription')
                                ->html("
                                <p>Bonjour $prenom,</p>
                                <p>Merci de vous être inscrit ! Veuillez confirmer votre inscription en cliquant sur le lien ci-dessous :</p>
                                <p><a href='$confirmationLink'>Confirmer mon inscription</a></p>
                                ");

                            $mailer->send($message);
                            echo "<p style='color: green;'>Bravo, tu as réussi ton inscription ! Un mail de confirmation a été envoyé.</p>";
                        } catch (PDOException $e) {
                            // Vérification du code d'erreur pour la contrainte d'unicité
                            if ($e->getCode() == 23000) {  // 23000 est le code pour les violations de contrainte d'unicité
                                echo "<p style='color: red;'>Le numéro de téléphone ou l'adresse mail que vous avez fourni est déjà utilisé. Veuillez en essayer un autre.</p>";
                            } else {
                                // Pour d'autres types d'erreurs
                                echo "<p style='color: red;'>Une erreur est survenue lors de l'ajout de l'utilisateur. Veuillez réessayer.</p>";
                            }
                        }
                    }
                }
                ?>
            </div>
        </div>
    </main>

    <?php include('includes/footer.php'); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
