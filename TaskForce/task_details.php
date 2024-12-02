<?php
require_once 'vendor/autoload.php';
require_once 'includes/functions.php';

use M521\Taskforce\dbManager\DbManagerCRUD;

// Initialisation du gestionnaire de base de données
$dbManager = new DbManagerCRUD();

// Démarrer la session pour récupérer l'email de l'utilisateur connecté
session_start();

// Vérification si l'email est bien défini dans la session, sinon arrêter l'exécution
$email = $_SESSION['email_user'] ?? null;  // Utilisation de l'opérateur de coalescence null
if (!$email) {
    die("Utilisateur non authentifié.");
}

// Récupérer les informations de l'utilisateur connecté à partir de l'email
$userInfo = getUserByEmail($email, $dbManager);
if (!$userInfo) {
    die("Utilisateur non trouvé.");
}

// Récupérer l'ID de l'utilisateur
$userId = $userInfo->rendId();

// Vérification si l'ID de la tâche est bien passé dans l'URL
$taskId = $_GET['task_id'] ?? null;
if (!$taskId || $taskId <= 0) {
    die("ID de tâche invalide.");
}

// Récupérer les détails de la tâche en fonction de son ID
$task = $dbManager->getTaskById($taskId);
if (!$task) {
    die("Tâche non trouvée.");
}

// Récupérer les utilisateurs associés à cette tâche
$taskUsers = $dbManager->getTasksSharedByUserId($taskId);

// Vérification de la soumission du formulaire pour modifier la tâche
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données du formulaire
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $deadline = $_POST['deadline'] ?? '';
    $status = $_POST['status'] ?? '';
    $assignedUsers = $_POST['assigned_users'] ?? [];
    $unassignedUsers = $_POST['unassigned_users'] ?? [];

    try {
        // Mettre à jour les informations de la tâche
        $task->setTitre($title);
        $task->setDescription($description);
        $task->setDateEcheance($deadline);
        $task->setStatut($status);

        // Mettre à jour la tâche dans la base de données
        $dbManager->updateTask($task, $taskId);

         // Assigner des utilisateurs à la tâche
         if (!empty($assignedUsers)) {
            $dbManager->assignUsersToTask($taskId, $assignedUsers);
        }
        
        // Désassigner des utilisateurs de la tâche
        if (!empty($unassignedUsers)) {
            $dbManager->unassignUsersFromTask($taskId, $unassignedUsers);
        }

        // Ajouter un message de succès dans la session
        $_SESSION['successMessage'] = "Tâche modifiée avec succès!";
    } catch (\Exception $e) {
        // Ajouter un message d'erreur dans la session
        $_SESSION['errorMessage'] = "Erreur lors de la modification de la tâche : " . $e->getMessage();
    }

    // Rediriger vers la page de détails de la tâche après la mise à jour
    header("Location: task_details.php?task_id=" . $taskId);
    exit;  // Toujours utiliser exit après un header pour arrêter l'exécution du script
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Tâche</title>
    <!-- Inclusion de Bootstrap pour le style de la page -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/styleSheet.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex">
        <!-- Inclusion de la sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <div class="main-content ms-auto col-md-9 col-lg-10 p-5 pt-4">

            <h2 class="text-center mb-4">Détail de la tâche : <?php echo htmlspecialchars($task->rendTitre()); ?></h2>

            <!-- Affichage des messages de succès ou d'erreur -->
            <?php
            if (isset($_SESSION['successMessage'])) {
                echo '<div class="alert alert-success">' . htmlspecialchars($_SESSION['successMessage']) . '</div>';
                unset($_SESSION['successMessage']); // Supprimer le message après l'affichage
            }
            if (isset($_SESSION['errorMessage'])) {
                echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['errorMessage']) . '</div>';
                unset($_SESSION['errorMessage']); // Supprimer le message après l'affichage
            }
            ?>

            <!-- Formulaire pour modifier la tâche -->
            <form action="task_details.php?task_id=<?php echo $taskId; ?>" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Titre</label>
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($task->rendTitre()); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4"><?php echo htmlspecialchars($task->rendDescription()); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="deadline" class="form-label">Date d'échéance</label>
                    <input type="date" id="deadline" name="deadline" class="form-control" value="<?php echo $task->rendDateEcheance(); ?>">
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Statut</label>
                    <select id="status" name="status" class="form-select">
                        <option value="a_faire" <?php echo $task->rendStatut() == 'a_faire' ? 'selected' : ''; ?>>À faire</option>
                        <option value="en_cours" <?php echo $task->rendStatut() == 'en_cours' ? 'selected' : ''; ?>>En cours</option>
                        <option value="termine" <?php echo $task->rendStatut() == 'termine' ? 'selected' : ''; ?>>Terminé</option>
                    </select>
                </div>
                <div class="row">
                    <!-- Colonne pour assigner des utilisateurs -->
                    <div class="col-md-6">
                        <h5>Assigner des utilisateurs</h5>
                        <div class="mb-3">
                            <label for="assigned_users" class="form-label">Utilisateurs non associés</label>
                            <select multiple id="assigned_users" name="assigned_users[]" class="form-select">
                            <?php
                                // Parcourir tous les utilisateurs disponibles (non assignés)
                                $unassignedUsers = $dbManager->getUsersNotAssignedToTask($taskId);
                                foreach ($unassignedUsers as $user) {
                                    $selected = in_array($user['id'], $taskUsers) ? 'selected' : ''; 
                                    echo "<option value='" . $user['id'] . "' $selected>" . htmlspecialchars($user['nom']) . " " . htmlspecialchars($user['prenom']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <!-- Colonne pour désassigner des utilisateurs -->
                    <div class="col-md-6">
                        <h5>Désassigner des utilisateurs</h5>
                        <div class="mb-3">
                            <label for="unassigned_users" class="form-label">Utilisateurs associés</label>
                            <select multiple id="unassigned_users" name="unassigned_users[]" class="form-select">
                            <?php
                                // Récupérer tous les utilisateurs disponibles et les afficher dans le select
                                // Parcourir tous les utilisateurs assignés à la tâche
                                $assignedUsers = $dbManager->getUsersAssignedToTask($taskId);
                                foreach ($assignedUsers as $user) {
                                    $selected = in_array($user['id'], $taskUsers) ? 'selected' : ''; 
                                    echo "<option value='" . $user['id'] . "' $selected>" . htmlspecialchars($user['nom']) . " " . htmlspecialchars($user['prenom']) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Bouton pour soumettre les modifications -->
                <div class="d-flex justify-content-between align-items-center">
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>

            <!-- Formulaire pour supprimer la tâche -->
            <form method="POST" action="delete_task.php?task_id=<?php echo $taskId; ?>" class="mb-0">
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <button type="submit" name="delete_task" class="btn btn-danger">Supprimer la tâche</button>
                </div>
            </form>

        </div>
    </div>

    <!-- Inclusion de Bootstrap JS pour les interactions sur la page -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>