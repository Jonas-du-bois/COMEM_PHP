<?php include('includes/header.php'); ?>

<main class="container mt-5">
    <div class="row">
        <!-- Colonne de gauche : Description -->
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
            // Affichage du message de connexion
            if (isset($_SESSION['user_connected']) && $_SESSION['user_connected']) {
                echo "<p class='text-success'><strong>Bravo, tu es connecté. Prêt à organiser tes tâches ?</strong></p>";
            } else {
                $_SESSION['user_connected'] = false;
                echo "<p class='text-warning'><strong>Connecte-toi pour commencer à utiliser TaskForce !</strong></p>";
            }
            ?>
        </div>

        <!-- Colonne de droite : Image -->
        <div class="col-md-6 text-center">
            <img src="style/img/illustration_index.jpg" alt="Illustration de TaskForce" class="img-fluid rounded">
        </div>
    </div>
</main>

<?php include('includes/footer.php'); ?>

