<?php

// La variable globale $_POST permet de récupérer les données d'un formulaire 
// envoyées à l'aide de la méthdoe POST. (Via un formulaire)
// Remarque : Votre environement de développement vous met un Warning pour vous 
//            mettre en garde que ce n'est pas la meilleure manière de procéder
//            Nous allons voir ça un peu plus loin ;-)

$varNomRecup = $_POST['nom'];
$varPrenomRecup =$_POST['prenom'];
echo 'Le serveur a bien reçu le nom : ', $varNomRecup, '<br>';
echo 'Le serveur a bien reçu le prénom : ', $varPrenomRecup, '<br>';
