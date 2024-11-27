<?php
require_once 'vendor/autoload.php';
require_once 'includes/functions.php';

use M521\Taskforce\dbManager\DbManagerCRUD;

$dbManager = new DbManagerCRUD();

// Démarrer la session et récupérer l'email de l'utilisateur connecté
session_start();
$email = $_SESSION['email_user'];

// Vérifier si l'email est dans la session
if (!isset($email)) {
    die("Utilisateur non authentifié.");
}

$userInfo = getUserByEmail($email, $dbManager);
if (!$userInfo) {
    die("Utilisateur non trouvé.");
}

$userId = $userInfo->rendId();

if (!isset($_GET['task_id']) || $_GET['task_id'] <= 0) {
    die("ID de tâche invalide.");
}

$taskId = $_GET['task_id'];

// Récupérer les détails de la tâche depuis la base de données
$task = $dbManager->getTaskById($taskId);

// Si la tâche n'est pas trouvée
if (!$task) {
    die("Tâche non trouvée.");
}

// Récupérer les utilisateurs associés à cette tâche
$taskUsers = $dbManager->getTasksSharedByUserId($taskId);

// Gérer la soumission du formulaire de modification
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];
    $assignedUsers = $_POST['assigned_users'] ?? [];

    // Mettre à jour les informations de la tâche
    $task->setTitre($title);
    $task->setDescription($description);
    $task->setDateEcheance($deadline);
    $task->setStatut($status);

    // Mise à jour de la tâche dans la base de données
    $dbManager->updateTask($task, $taskId);


    // Rediriger vers la page de détail de la tâche après la mise à jour
    header("Location: task_details.php?task_id=" . $taskId);
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Tâche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/styleSheet.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <!-- Inclusion de la sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <div class="container mt-5">

            <h2 class="text-center mb-4">Détail de la tâche : <?php echo htmlspecialchars($task->rendTitre()); ?></h2>

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

                <h5>Assigner des utilisateurs</h5>
                <div class="mb-3">
                    <label for="assigned_users" class="form-label">Utilisateurs associés</label>
                    <select multiple id="assigned_users" name="assigned_users[]" class="form-select">
                        <?php
                        // Récupérer tous les utilisateurs disponibles
                        $allUsers = $dbManager->rendAllUtilisateur();
                        foreach ($allUsers as $user) {
                            $selected = in_array($user->rendId(), $taskUsers) ? 'selected' : '';
                            echo "<option value='" . $user->rendId() . "' $selected>" . htmlspecialchars($user->rendNom()) . " " . htmlspecialchars($user->rendPrenom()) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

