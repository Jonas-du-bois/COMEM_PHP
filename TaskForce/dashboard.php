<?php
require_once 'vendor/autoload.php';
require_once 'includes/functions.php';

use M521\Taskforce\dbManager\DbManagerCRUD;

$dbManager = new DbManagerCRUD();

// Démarrer la session si ce n'est pas déjà fait
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$email = $_SESSION['email_user'];

$userInfo = getUserByEmail($email, $dbManager);
if (!$userInfo) {
    die("Utilisateur non trouvé.");
}

$userId = $userInfo->rendId();
// Récupérer les tâches de l'utilisateur
$taches = $dbManager->getTasksByUserId($userId);

$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'], $_POST['statut'])) {
    $taskId = intval($_POST['task_id']);
    $formattedStatut = $_POST['statut'];

    // Tableau de correspondance des statuts
    $statutTraduction = [
        'À faire' => 'a_faire',
        'En cours' => 'en_cours',
        'Terminé' => 'termine',
    ];

    // Vérifier si le statut est valide
    $internalStatut = $statutTraduction[$formattedStatut] ?? null;

    if ($internalStatut) {
        $task = $dbManager->getTaskById($taskId);

        if ($task) {
            $task->setStatut($internalStatut);
            $dbManager->updateTask($task, $taskId);
            $successMessage = "Statut de la tâche mis à jour avec succès.";
        } else {
            $errorMessage = "Tâche introuvable.";
        }
    } else {
        $errorMessage = "Statut invalide sélectionné.";
    }

    // Recharger les tâches après mise à jour
    $taches = $dbManager->getTasksByUserId($userId);
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestion des Tâches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Inclure la sidebar -->
            <?php include 'Includes/sidebar.php'; ?>
            <!-- Contenu principal -->
            <div class="main-content ms-auto col-md-9 col-lg-10 p-5">
                <h2 class="text-center mb-4 text-primary">Tableau de bord</h2>


                <!-- Liste des tâches -->
                <h4 class="text-secondary">Mes Tâches</h4>
                

                <?php if (empty($taches)): ?>
                    <div class="alert alert-info mt-4" role="alert">
                        <p>Aucune tâche assignée pour le moment.</p>
                    </div>
                <?php else: ?>
                    <div class="table-responsive pt-4">
                        <table class="table align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th scope="col">Titre</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Date d'échéance</th>
                                    <th scope="col">Statut</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($taches as $task): ?>
                                    <tr>
                                        <td scope="row" class="fw-bold text-dark"><?php echo htmlspecialchars($task->rendTitre()); ?></td>
                                        <td class="text-truncate" style="max-width: 300px;">
                                            <?php echo htmlspecialchars($task->rendDescription()); ?>
                                        </td>
                                        <td class="text-muted"><?php echo htmlspecialchars($task->getFormattedDateEcheance()); ?></td>
                                        <td>
                                            <!-- Formulaire pour changer le statut -->
                                            <form method="POST" action="">
                                                <input type="hidden" name="task_id" value="<?php echo htmlspecialchars($task->rendId()); ?>">
                                                <select name="statut" class="statutActu form-select text-white bg-primary" onchange="this.form.submit()">
                                                    <?php foreach (['À faire', 'En cours', 'Terminé'] as $status): ?>
                                                        <option value="<?php echo htmlspecialchars($status); ?>"
                                                            <?php echo $status === $task->getFormattedStatut() ? 'selected' : ''; ?>>
                                                            <?php echo htmlspecialchars($status); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </form>
                                        </td>
                                        <td>
                                            <!-- Bouton de modification -->
                                            <form method="GET" action="task_details.php">
                                                <input type="hidden" name="task_id" value="<?php echo htmlspecialchars($task->rendId()); ?>">
                                                <button type="submit" class="btn btn-secondary btn-sm">Modifier</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>

                <!-- Alertes Bootstrap placées en bas -->
                <div class="container">
                    <?php if (!empty($successMessage)): ?>
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                            <?php echo htmlspecialchars($successMessage); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($errorMessage)): ?>
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            <?php echo htmlspecialchars($errorMessage); ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!-- 
    <script>
        const span = document.querySelector("badge");
        document.addEventListener("change", (e) => {
            if (e.target.classList.contains("statutActu")) {
                const taskId = e.target.dataset.taskId; // ID de la tâche
                const selectedValue = e.target.value; // Statut sélectionné

                // Tableau des classes CSS pour chaque statut
                const statusBadgeClasses = {
                    "À faire": "bg-danger",
                    "En cours": "bg-warning",
                    "Terminé": "bg-success"
                };

                // Supprime les anciennes classes de badge
                span.classList.remove("bg-danger", "bg-warning", "bg-success");

                // Ajoute la classe correspondant au statut sélectionné
                const newClass = statusBadgeClasses[selectedValue] || "badge-secondary";
                span.classList.add(newClass);

                console.log("Données envoyées :", {
                    taskId,
                    selectedValue
                });

                fetch("update_task_status.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            taskId: taskId,
                            statut: selectedValue,
                        }),
                    })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error(`Erreur HTTP : ${response.status}`);
                        }
                        return response.json(); // Assure que la réponse est au format JSON
                    })
                    .then((data) => {
                        if (data.success) {
                            console.log("Mise à jour réussie :", data);
                        } else {
                            console.error("Erreur serveur :", data.error);
                        }
                    })
                    .catch((error) => {
                        console.error("Erreur réseau ou serveur :", error);
                    });
            }
        });


        // Assurer que le JavaScript fonctionne correctement
        // document.addEventListener('DOMContentLoaded', function() {
        //     document.querySelectorAll('.clickable-row').forEach(row => {
        //         row.addEventListener('click', function() {
        //             window.location = this.dataset.href;
        //         });
        //     });
        // });    
    </script> -->