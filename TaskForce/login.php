<?php
require_once 'vendor\autoload.php';

use M521\Taskforce\dbManager\DbManagerCRUD;

$dbUser = new DbManagerCRUD();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style/styleSheet.css">
    <title>Connexion</title>
</head>

<body>
    <?php include('includes/header.php'); ?>

    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mb-4">Connecte-toi !</h1>
                <div class="alert alert-info text-center">
                    <p>
                        <?php echo $dbUser->compterNbUsers() ?> utilisateurs s'est inscrit sur ce site.
                        <br><strong>Bravo à toi !!</strong>
                    </p>
                </div>

                <form action="login.php" method="POST" class="p-4 border rounded bg-light">
                    <div class="mb-3">
                        <label for="email" class="form-label">Adresse e-mail :</label>
                        <input type="email" id="email" name="email" class="form-control" required placeholder="Entrez votre adresse e-mail">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe :</label>
                        <input type="password" id="password" name="password" class="form-control" required minlength="6" placeholder="Entrez votre mot de passe">
                    </div>

                    <button type="submit" name="login" class="btn btn-primary w-100">Se connecter</button>
                </form>

                <div class="mt-3">
                    <?php
                    
                    if (isset($_SESSION['user_connected']) && $_SESSION['user_connected']) {
                        echo "<div class='alert alert-success text-center'>Bravo, tu es déjà connecté !</div>";
                    } else {
                        $_SESSION['user_connected'] = false;
                    }

                    if (filter_has_var(INPUT_POST, 'login')) {
                        // Récupérer les données du formulaire
                        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                        $motDePasse = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

                        // Vérifier si les données sont valides
                        if ($email && strlen($motDePasse) >= 8) {
                            // Appel de la méthode pour vérifier les identifiants
                            $loginStatus = $dbUser->verifierIdentifiants($email, $motDePasse);

                            if ($loginStatus === 'success') {
                                echo "<div class='alert alert-success'>Connexion réussie ! Bienvenue dans le paradis du fun !</div>";
                                $_SESSION['user_connected'] = true;
                                $_SESSION['email_user'] = $email;

                                header('Location: index.php');
                                exit();
                            } elseif ($loginStatus === 'not_confirmed') {
                                echo "<div class='alert alert-warning'>Erreur : Votre adresse e-mail n'a pas encore été confirmée.</div>";
                            } elseif ($loginStatus === 'wrong_password') {
                                echo "<div class='alert alert-danger'>Erreur : Mot de passe incorrect.</div>";
                            } else {
                                echo "<div class='alert alert-danger'>Erreur : Adresse e-mail non trouvée.</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>Veuillez entrer des informations valides.</div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <?php include('includes/footer.php'); ?>
</body>

</html>
