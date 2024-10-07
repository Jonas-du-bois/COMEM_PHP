<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Protection d'accès avec mot de passe</title>
    </head>
    <body>
        <?php
        // Le mot de passe peut contenir 0-9 a-z A-Z et les caractères ] [ ? / < ~ #  ! @ $ % ^ & * ( ) + = } | : " ; ' , > { ` et l'espace
        $motDePasse = filter_input(INPUT_POST, 'motDePasse', FILTER_VALIDATE_REGEXP, ["options" => ["regexp" => "/^[a-zA-Z0-9_\]\[?\/<~#`!@$%^&*()+=}|:\";\',>{ -]{4,20}$/"]]);
                                                                                                    //le regexp - expression régulière permet de tester les infos que l'ont que le mdp accepte 
        if ($motDePasse) {
            // pour récupérer le mot de passe encodé ('$2y$10$4XXNzX...') on utilise : echo password_hash('Vive le PHP', PASSWORD_DEFAULT); 
            if (password_verify($motDePasse, '$2y$10$4XXNzXWQkfKNOQ5T9XMC/ee1e4SelEG3ZZA4hoZpOyUhhLoyykwDy')) {
                ?>
                Bravo, tu as saisi correctement le mot de passe :-) <BR>
                <?php
            } else {
                echo '<p>Mot de passe incorrect</p>';
            }
        }
        ?>
    </body>
</html>