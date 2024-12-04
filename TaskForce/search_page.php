<?php
require_once 'vendor/autoload.php';
require_once 'includes/functions.php';

use M521\Taskforce\dbManager\DbManagerCRUD;

// Création de l'objet DbManager pour interagir avec la base de données
$dbManager = new DbManagerCRUD();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/styleSheet.css" rel="stylesheet">
</head>

<body>
    <div class="container pb-5">
        <p>Rechercher une tâche :</p>
        <div class="input-group w-50 d-flex align-items-center">
            <i class="fas fa-search pe-2"></i>
            <input type="text" id="main-search" class="form-control" placeholder="Rechercher...">
            <button class="btn btn-primary" id="search-btn" type="button">Chercher</button>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Écoute du clic sur le bouton "Chercher"
        const searchBtn = document.getElementById('search-btn');
        const mainSearchInput = document.getElementById('main-search');

        searchBtn.addEventListener('click', () => {
            const query = mainSearchInput.value.trim();
            if (query) {
                // Rediriger vers la page de résultats avec la requête
                window.location.href = `search_results.php?query=${encodeURIComponent(query)}`;
            } else {
                alert("Veuillez entrer un texte pour la recherche.");
            }
        });

        // Optionnel: Permet de rechercher avec la touche Entrée
        mainSearchInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                searchBtn.click();
            }
        });
    </script>
</body>

</html>