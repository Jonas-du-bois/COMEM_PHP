<?php

require_once 'vendor/autoload.php';

use M521\Taskforce\dbManager\DbManagerCRUD;
use M521\Taskforce\dbManager\Users;

// Création d'une instance du gestionnaire de base de données
$dbManager = new DbManagerCRUD();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/styleSheet.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex">
        <!-- Inclusion de la barre latérale -->
        <?php include 'includes/sidebar.php'; ?>

        <?php
        // Récupération de l'email de l'utilisateur connecté à partir de la session
        $userEmail = $_SESSION['email_user'];

        // Récupération des informations de l'utilisateur à partir de la base de données
        $userInfoArray = $dbManager->rendPersonnes($userEmail);
        if (empty($userInfoArray)) {
            die("Utilisateur introuvable."); // Si l'utilisateur n'est pas trouvé, on arrête l'exécution
        }

        // L'utilisateur est unique, récupération de ses informations
        $userInfo = $userInfoArray[0];

        // Définition des expressions régulières pour valider les champs
        $namePattern = "/^[a-zA-ZÀ-ÿ' -]{3,20}$/";  // Prénom et Nom : 3 à 20 caractères, lettres et espaces
        $telPattern = "/^\+?[0-9]{10,15}$/";  // Téléphone : 10 à 15 chiffres (format international ou local)
        $passwordPattern = "/^(?=.*[A-Z])(?=.*[\W_])(?=.{8,})/";  // Mot de passe : minimum 8 caractères, une majuscule et un caractère spécial

        // Initialisation des erreurs
        $errors = [];
        ?>

        <div class="main-content ms-auto col-md-9 col-lg-10 p-4">
            <main class="container py-5">
                <div class="p-4">
                    <h1 class="text-center mb-4">Mon Profil</h1>

                    <!-- Formulaire de mise à jour du profil -->
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($userInfo->rendPrenom()) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($userInfo->rendNom()) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($userInfo->rendEmail()) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="noTel" class="form-label">Numéro de téléphone</label>
                            <input type="tel" class="form-control" id="noTel" name="noTel" value="<?= htmlspecialchars($userInfo->rendNoTel()) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="motDePasse" class="form-label">Mot de passe (laisser vide pour ne pas modifier)</label>
                            <input type="password" class="form-control" id="motDePasse" name="motDePasse">
                        </div>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>

                    <?php
                    // Traitement du formulaire après soumission
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        try {
                            // Récupération et validation des données du formulaire
                            $prenom = htmlspecialchars(trim($_POST['prenom']));
                            $nom = htmlspecialchars(trim($_POST['nom']));
                            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                            if (!$email) {
                                $errors[] = "L'adresse email n'est pas valide.";
                            }

                            if (!preg_match($namePattern, $prenom)) {
                                $errors[] = "Le prénom est invalide. Veuillez utiliser uniquement des lettres et des espaces.";
                            }

                            if (!preg_match($namePattern, $nom)) {
                                $errors[] = "Le nom est invalide. Veuillez utiliser uniquement des lettres et des espaces.";
                            }

                            // Validation du numéro de téléphone
                            $noTel = preg_match($telPattern, $_POST['noTel']) ? trim($_POST['noTel']) : null;
                            if (!$noTel) {
                                $errors[] = "Le numéro de téléphone n'est pas valide.";
                            }

                            // Vérification du mot de passe s'il est renseigné
                            $motDePasse = !empty($_POST['motDePasse']) ? trim($_POST['motDePasse']) : '';
                            if ($motDePasse && !preg_match($passwordPattern, $motDePasse)) {
                                $errors[] = "Le mot de passe doit comporter au moins 8 caractères, dont une majuscule et un caractère spécial.";
                            }

                            // Si des erreurs existent, on les affiche
                            if (!empty($errors)) {
                                foreach ($errors as $error) {
                                    echo "<p style='color: red;'>$error</p>";
                                }
                            } else {
                                // Si aucune erreur, on procède à la mise à jour de l'utilisateur
                                $motDePasseHash = !empty($motDePasse) ? password_hash($motDePasse, PASSWORD_DEFAULT) : $userInfo->rendMotDePasse();
                                $updatedUser = new Users(
                                    $prenom,
                                    $nom,
                                    $email,
                                    $noTel,
                                    $motDePasseHash,
                                    $userInfo->rendId()
                                );

                                // Mise à jour dans la base de données
                                $dbManager->modifiePersonne($userInfo->rendId(), $updatedUser);

                                // Mise à jour de la session avec le nouvel email
                                $_SESSION['email_user'] = $email;

                                // Réactualisation des informations utilisateur après mise à jour
                                $userInfoArray = $dbManager->rendPersonnes($email);
                                $userInfo = $userInfoArray[0];

                                // Message de succès
                                $message = ['type' => 'success', 'text' => 'Profil mis à jour avec succès.'];
                            }
                        } catch (Exception $e) {
                            // Gestion des erreurs spécifiques
                            if ($e->getCode() == 23000) {
                                $message = ['type' => 'danger', 'text' => 'Le numéro de téléphone ou l\'adresse mail que vous avez fourni est déjà utilisé.'];
                            } else {
                                $message = ['type' => 'danger', 'text' => 'Une erreur est survenue : ' . $e->getMessage()];
                            }
                        }

                        // Rechargement de la page après 2 secondes pour éviter le renvoi multiple du formulaire
                        header("Refresh:2");
                    }
                    ?>

                    <!-- Affichage des erreurs ou succès -->
                    <?php if (isset($message)) : ?>
                        <div class="alert alert-<?= htmlspecialchars($message['type']) ?>">
                            <?= htmlspecialchars($message['text']) ?>
                        </div>
                    <?php endif; ?>

                </div>
            </main>
        </div>
    </div>

    <!-- Intégration de Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
