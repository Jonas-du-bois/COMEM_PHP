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
    <title>Spotlight Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/styleSheet.css" rel="stylesheet">
    <style>
        /* Styles pour la barre Spotlight */
        .spotlight {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 50%;
            max-width: 600px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            padding: 1rem;
            z-index: 1050;
            display: none; /* Masquée par défaut */
            animation: fadeIn 0.3s ease-in-out;
        }

        .spotlight input[type="search"] {
            width: 100%;
            border: none;
            outline: none;
            font-size: 1.2rem;
            padding: 0.5rem;
        }

        .spotlight input[type="search"]::placeholder {
            color: #bbb;
        }

        /* Animation d'apparition */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -45%);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%);
            }
        }

        /* Overlay sombre en arrière-plan */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none; /* Masquée par défaut */
        }

        /* Rendre le bouton "échap" fonctionnel */
        body.spotlight-open {
            overflow: hidden;
        }
    </style>
</head>

<body>
    <!-- Overlay pour effet sombre -->
    <div class="overlay" id="overlay"></div>

    <!-- Barre de recherche façon Spotlight -->
    <div class="spotlight" id="spotlight">
        <form action="search_results.php" method="GET">
            <input 
                type="search" 
                name="query" 
                placeholder="Tapez pour rechercher..." 
                aria-label="Recherche" 
                autofocus
            />
        </form>
    </div>

    <!-- Contenu principal -->
    <div class="d-flex">
        <?php include 'includes/sidebar.php'; ?>
        <div class="main-content ms-auto col-md-9 col-lg-10 p-4">
            <div class="container">
                <h1>Bienvenue</h1>
                <p>Appuyez sur <kbd>⌘</kbd> + <kbd>Espace</kbd> ou <kbd>Ctrl</kbd> + <kbd>Espace</kbd> pour activer la recherche.</p>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Gestion de l'apparition de la barre Spotlight
        const spotlight = document.getElementById('spotlight');
        const overlay = document.getElementById('overlay');
        const spotlightInput = spotlight.querySelector('input[type="search"]');
        const body = document.body;

        // Fonction pour ouvrir Spotlight
        function openSpotlight() {
            spotlight.style.display = 'block';
            overlay.style.display = 'block';
            body.classList.add('spotlight-open');
            spotlightInput.focus();
        }

        // Fonction pour fermer Spotlight
        function closeSpotlight() {
            spotlight.style.display = 'none';
            overlay.style.display = 'none';
            body.classList.remove('spotlight-open');
        }

        // Écoute des touches clavier
        document.addEventListener('keydown', (e) => {
            if ((e.key === ' ' && e.ctrlKey) || (e.key === ' ' && e.metaKey)) {
                e.preventDefault();
                openSpotlight();
            } else if (e.key === 'Escape') {
                closeSpotlight();
            }
        });

        // Fermeture sur clic en dehors
        overlay.addEventListener('click', closeSpotlight);
    </script>
</body>
</html>

