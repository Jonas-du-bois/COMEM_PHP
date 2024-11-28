<?php
require_once 'vendor/autoload.php';
require_once 'includes/functions.php';

use M521\Taskforce\dbManager\DbManagerCRUD;

$dbManager = new DbManagerCRUD();

// Récupérer l'email de l'utilisateur connecté (assumé que la session est déjà démarrée)
session_start();
$email = $_SESSION['email_user'];

$userInfo = getUserByEmail($email, $dbManager);
if (!$userInfo) {
    die("Utilisateur non trouvé.");
}

$userId = $userInfo->rendId();

// Récupérer les tâches en cours de l'utilisateur
$tachepartager = $dbManager->getTasksSharedByUserId($userId);

// Fonction pour formater les tâches
function formatTaskData($task)
{
    $task['dateEcheance'] = formatDateEcheance($task['dateEcheance']);
    $task['statut'] = formatStatut($task['statut']);
    return $task;
}

// Formatage de la date
function formatDateEcheance($dateEcheance)
{
    if ($dateEcheance) {
        $d = DateTime::createFromFormat('Y-m-d', $dateEcheance);
        return $d ? $d->format('d.m.Y') : null;
    }
    return null;
}

// Formatage du statut
function formatStatut($statut)
{
    $statutTraduction = [
        'a_faire' => 'À faire',
        'en_cours' => 'En cours',
        'termine' => 'Terminé',
    ];
    return $statutTraduction[$statut] ?? 'Inconnu';
}

// Formater toutes les tâches avant affichage
$tachepartager = array_map('formatTaskData', $tachepartager);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tâches partagées</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/styleSheet.css" rel="stylesheet">
</head>

<body>
    <div class="d-flex">
        <!-- Inclusion de la sidebar -->
        <?php include 'includes/sidebar.php'; ?>

        <div class="main-content ms-auto col-md-9 col-lg-10 p-5">

            <h2 class="text-center mb-4">Tâches partagées</h2>

            <?php if (empty($tachepartager)): ?>
                <p>Aucune tâche partagée pour le moment.</p>
            <?php else: ?>
                <div class="table-responsive p-3">
                    <table class="table table-hover">
                        <thead>
                            <tr class="table-dark">
                                <th scope="col">Titre</th>
                                <th scope="col">Description</th>
                                <th scope="col">Date d'échéance</th>
                                <th scope="col">Statut</th>
                                <th scope="col">Utilisateurs partagés</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tachepartager as $task): ?>
                                <tr>
                                    <td scope="row"><?php echo htmlspecialchars($task['titre']); ?></td>
                                    <td class="text-truncate" style="max-width: 200px; overflow: hidden; white-space: nowrap;"><?php echo htmlspecialchars($task['description']); ?></td>
                                    <td><?php echo htmlspecialchars($task['dateEcheance']); ?></td>
                                    <td>
                                        <span class="badge <?php echo getStatusBadgeClass($task['statut']); ?> me-1">
                                            <?php echo htmlspecialchars($task['statut']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php
                                        // Transformer les noms d'utilisateurs partagés en badges
                                        $sharedUsers = explode(',', $task['shared_user_names']);
                                        foreach ($sharedUsers as $userEmailFromTask):
                                            // Si l'e-mail de l'utilisateur correspond à l'e-mail de la session, ne pas l'afficher
                                            if ($_SESSION['email_user'] === $userEmailFromTask) {
                                                continue; // Ignore cet utilisateur
                                            }
                                        ?>
                                            <span class="badge <?php echo $isCurrentUser ? 'bg-secondary' : 'bg-primary'; ?> me-1" data-bs-toggle="tooltip"
                                                title="<?php echo htmlspecialchars($userEmailFromTask); ?>">
                                                <?php echo htmlspecialchars(strlen($userEmailFromTask) > 10 ? substr($userEmailFromTask, 0, 10) . '...' : $userEmailFromTask); ?>
                                            </span>
                                        <?php endforeach; ?>
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
    <script>
        // Initialisation des tooltips Bootstrap
        let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        let tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
</body>

</html>