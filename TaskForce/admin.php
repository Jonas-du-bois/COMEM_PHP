<?php
// Autoload des dépendances via Composer et inclusion des fonctions externes
require_once 'vendor/autoload.php';  // Pour charger les dépendances via Composer
require_once 'includes/functions.php'; // Pour inclure des fonctions personnalisées

use M521\Taskforce\dbManager\DbManagerCRUD; // Utilisation de la classe DbManagerCRUD

// Démarrage de la session
session_start();

// Vérifie si l'utilisateur est connecté et si c'est l'administrateur
if (!isset($_SESSION['user_connected']) || !$_SESSION['user_connected'] || $_SESSION['email_user'] !== 'jonas.du.bois@outlook.com') {
    header("Location: login.php"); // Redirige les utilisateurs non autorisés vers la page de connexion
    exit;
}

// Initialisation de la gestionnaire de base de données
$dbManager = new DbManagerCRUD();

// Récupération de tous les utilisateurs depuis la base de données
$utilisateurs = $dbManager->rendAllUtilisateur();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Liste des utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/styleSheet.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet"> <!-- Icônes Bootstrap -->
</head>

<body>
    <div class="d-flex">
        <!-- Inclusion de la sidebar (menu latéral) -->
        <?php include 'includes/sidebar.php'; ?>

        <!-- Contenu principal -->
        <div class="main-content ms-auto col-md-9 col-lg-10 p-5">
            <h2 class="text-center mb-4 text-primary">Liste des utilisateurs</h2>

            <?php
                if (isset($_SESSION['successMessage'])) {
                    echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['successMessage']) . '</div>';
                    unset($_SESSION['successMessage']);
                }
                if (isset($_SESSION['errorMessage'])) {
                    echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['errorMessage']) . '</div>';
                    unset($_SESSION['errorMessage']);
                }
            ?>

            <!-- Vérification s'il y a des utilisateurs dans la base de données -->
            <?php if (empty($utilisateurs)): ?>
                <div class="alert alert-warning mt-4" role="alert">
                    <p>Aucun utilisateur trouvé dans la base de données.</p>
                </div>
            <?php else: ?>
                <!-- Table des utilisateurs -->
                <div class="table-responsive pt-4">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <!-- En-têtes de la table -->
                                <th scope="col" style="width: 10%;">ID</th>
                                <th scope="col" style="width: 30%;">E-mail</th>
                                <th scope="col" style="width: 20%;">Num Tél</th>
                                <th scope="col" style="width: 20%;">Prénom</th>
                                <th scope="col" style="width: 20%;">Nom</th>
                                <th scope="col" style="width: 10%;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Boucle pour afficher chaque utilisateur -->
                            <?php foreach ($utilisateurs as $user): ?>
                                <tr>
                                    <!-- Affichage des informations de l'utilisateur -->
                                    <td scope="row" class="fw-bold text-dark p-3"><?php echo htmlspecialchars($user->rendId()); ?></td>
                                    <td class="text-muted"><?php echo htmlspecialchars($user->rendEmail()); ?></td>
                                    <td class="text-muted"><?php echo htmlspecialchars($user->rendNoTel()); ?></td>
                                    <td class="text-dark"><?php echo htmlspecialchars($user->rendPrenom()); ?></td>
                                    <td class="text-dark"><?php echo htmlspecialchars($user->rendNom()); ?></td>
                                    <td>
                                        <form method="GET" action="delete_user.php" onsubmit="return confirmDeleteUser();">
                                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user->rendId()); ?>">
                                            <button type="submit" class="btn btn-secondary btn-sm">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script>
    // Fonction JavaScript pour afficher une alerte de confirmation
    function confirmDeleteUser() {
        return confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?");
    }
</script>