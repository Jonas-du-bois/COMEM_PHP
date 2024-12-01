<?php
// Chargement automatique des classes et des fonctions personnalisées
require_once 'vendor/autoload.php';
require_once 'includes/functions.php';

use M521\Taskforce\dbManager\DbManagerCRUD;
use M521\Taskforce\dbManager\Task;

// Initialisation du gestionnaire de base de données
$dbManager = new DbManagerCRUD();

// Démarrer la session si elle n'est pas déjà active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialisation des variables
$statut = 'a_faire'; // Statut par défaut
$email = $_SESSION['email_user'] ?? '';

// Vérification de l'email utilisateur et récupération des informations
$userInfo = getUserByEmail($email, $dbManager);
if (!$userInfo) {
    die("Utilisateur non trouvé.");
}

// Récupération de tous les utilisateurs pour le champ de sélection multiple
$allUsers = $dbManager->rendAllUtilisateur();

// Traitement du formulaire d'ajout de tâche
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et validation des données du formulaire
    $titre = $_POST['titre'] ?? '';
    $description = $_POST['description'] ?? '';
    $dateEcheance = $_POST['dateEcheance'] ?? '';
    $statut = $_POST['statut'] ?? 'a_faire';

    // Récupération des IDs des utilisateurs assignés ou utilisateur courant par défaut
    $userIds = isset($_POST['userIds']) ? $_POST['userIds'] : [$userInfo->rendId()];

    // Validation des champs obligatoires
    if (empty($titre) || empty($dateEcheance)) {
        $errorMessage = "Le titre et la date d'échéance sont obligatoires.";
    } elseif (!in_array($statut, ['a_faire', 'en_cours', 'termine'])) {
        $errorMessage = "Le statut est invalide. Valeurs acceptées : 'a_faire', 'en_cours', 'termine'.";
    } else {
        try {
            // Création de l'objet tâche
            $task = new Task(
                $titre,
                $description,
                $userIds,
                $dateEcheance,
                $statut
            );

            // Ajout de la tâche à la base de données
            $taskId = $dbManager->createTask($task);
            $task->setId($taskId);
            $successMessage = "Tâche ajoutée avec succès !";
        } catch (\Exception $e) {
            $errorMessage = "Erreur : " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de tâches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/styleSheet.css" rel="stylesheet">
</head>
<body>
<div class="d-flex flex-column flex-md-row vh-100">
    <!-- Inclusion de la barre latérale -->
    <?php include 'includes/sidebar.php'; ?>

    <main class="container py-4">
        <div class="main-content ms-auto col-md-9 col-lg-10 pt-4">
            <h2 class="text-center mb-4">Ajouter une nouvelle tâche</h2>

            <!-- Affichage des messages de succès ou d'erreur -->
            <?php if (isset($errorMessage)): ?>
                <div class="alert alert-danger">
                    <?php echo htmlspecialchars($errorMessage); ?>
                </div>
            <?php elseif (isset($successMessage)): ?>
                <div class="alert alert-success">
                    <?php echo htmlspecialchars($successMessage); ?>
                </div>
            <?php endif; ?>

            <!-- Formulaire d'ajout de tâche -->
            <form method="POST" action="">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" required
                               value="<?php echo htmlspecialchars($titre ?? ''); ?>" placeholder="Entrez le titre de la tâche">
                    </div>

                    <div class="col-md-6">
                        <label for="statut" class="form-label">Statut</label>
                        <select class="form-select" id="statut" name="statut" required>
                            <option value="a_faire" <?php echo ($statut === 'a_faire') ? 'selected' : ''; ?>>À faire</option>
                            <option value="en_cours" <?php echo ($statut === 'en_cours') ? 'selected' : ''; ?>>En cours</option>
                            <option value="termine" <?php echo ($statut === 'termine') ? 'selected' : ''; ?>>Terminé</option>
                        </select>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Décrivez la tâche">
                            <?php echo htmlspecialchars($description ?? ''); ?>
                        </textarea>
                    </div>
                </div>

                <div class="row g-3 mt-3">
                    <div class="col-md-6">
                        <label for="dateEcheance" class="form-label">Date d'échéance</label>
                        <input type="date" class="form-control" id="dateEcheance" name="dateEcheance" required
                               value="<?php echo htmlspecialchars($dateEcheance ?? ''); ?>">
                    </div>

                    <div class="col-md-6">
                        <label for="userIds" class="form-label">Assigner des utilisateurs</label>
                        <select multiple class="form-select" id="userIds" name="userIds[]" size="4">
                            <?php 
                            if (!empty($allUsers)) {
                                foreach ($allUsers as $user) {
                                    echo "<option value='" . htmlspecialchars($user->rendId()) . "'>" 
                                         . htmlspecialchars($user->rendNom() . " " . $user->rendPrenom()) 
                                         . "</option>";
                                }
                            } else {
                                echo "<option disabled>Aucun utilisateur disponible</option>";
                            }
                            ?>
                        </select>
                        <small class="form-text text-muted">Utilisez Ctrl (ou Cmd sur Mac) pour sélectionner plusieurs utilisateurs.</small>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">Ajouter la tâche</button>
                </div>
            </form>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
