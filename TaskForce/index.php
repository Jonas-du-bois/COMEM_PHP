<?php include('includes/header.php'); ?>

<main class="container mt-5">
    <div class="row">
        <!-- Colonne de gauche : Description de l'application -->
        <div class="col-md-6">
            <h1 class="mb-4">Bienvenue sur <span class="text-primary">TaskForce</span></h1>
            <p>
                TaskForce est votre nouvel allié pour organiser, planifier et suivre vos tâches au quotidien.
                Que vous soyez étudiant, professionnel ou chef de projet, cette application a été conçue pour 
                rendre votre gestion de tâches simple, intuitive et efficace.
            </p>
            <p>
                Avec TaskForce, vous pouvez :
                <ul>
                    <li>Créer et organiser vos listes de tâches.</li>
                    <li>Attribuer des priorités et des échéances.</li>
                    <li>Collaborer avec votre équipe en temps réel.</li>
                </ul>
            </p>
            <p class="mt-4">
                Rejoignez dès maintenant notre communauté d'utilisateurs et boostez votre productivité !
            </p>

            <?php
            // Vérifie si l'utilisateur est connecté et affiche un message en conséquence
            if (isset($_SESSION['user_connected']) && $_SESSION['user_connected']) {
                // L'utilisateur est connecté, affichage d'un message de bienvenue
                echo "<p class='text-success'><strong>Bravo, tu es connecté. Prêt à organiser tes tâches ?</strong></p>";
            } else {
                // L'utilisateur n'est pas connecté, affiche un message d'encouragement à se connecter
                $_SESSION['user_connected'] = false; // Initialise la session en cas de première visite
                echo "<p class='text-warning'><strong>Connecte-toi pour commencer à utiliser TaskForce !</strong></p>";
            }
            ?>
        </div>

        <!-- Colonne de droite : Image d'illustration -->
        <div class="col-md-6 text-center">
            <img src="style/img/illustration_index.jpg" alt="Illustration de TaskForce" class="img-fluid rounded">
        </div>
    </div>
</main>

<?php include('includes/footer.php'); ?>
