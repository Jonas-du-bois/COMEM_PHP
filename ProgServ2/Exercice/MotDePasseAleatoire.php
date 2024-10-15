<?php

require_once 'PasswordCheck.php';

class MotDePasseAleatoire {

    // Génère des caractères spéciaux aléatoires
    public static function genererCarSpeciaux(int $nb) {
        return self::randomizer($nb, '!@#$%^&*()_+-=[]{}|;:,.<>?');
    }

    // Génère des chiffres aléatoires
    public static function genererChiffres(int $nb) {
        return self::randomizer($nb, '0123456789');
    }

    // Génère des lettres minuscules aléatoires
    public static function genererMinuscules(int $nb) {
        return self::randomizer($nb, 'abcdefghijklmnopqrstuvwxyz');
    }

    // Génère des lettres majuscules aléatoires
    public static function genererMajuscules(int $nb) {
        return self::randomizer($nb, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ');
    }

    // Fonction utilitaire pour générer une chaîne aléatoire à partir d'un ensemble de caractères
    public static function randomizer(int $nb, string $chaine) {
        return substr(str_shuffle(str_repeat($chaine, $nb)), 0, $nb);
    }

    // Génère un mot de passe aléatoire en combinant différents types de caractères
    public static function genereMotDePasse($nbCarSpeciaux, $nbChiffres, $nbMinuscules, $nbMajuscules) {
        $passwordCheck = new PasswordCheck(); // Instance de la classe PasswordCheck pour vérifier le mot de passe
        $i = 1; // Compteur de tentatives
        $motDePasseDone = false; // Indicateur de fin de génération

        do {
            // Génère le mot de passe en combinant les différents types de caractères
            $motDePasse = self::genererCarSpeciaux($nbCarSpeciaux) .
                    self::genererChiffres($nbChiffres) .
                    self::genererMinuscules($nbMinuscules) .
                    self::genererMajuscules($nbMajuscules);

            // Mélange les caractères du mot de passe
            $motDePasse = str_shuffle($motDePasse);
            // Affiche le nombre de mots de passe générés
            echo "<script>document.getElementById('passwordCount').innerText = 'Nombre de mots de passe générés : ' + $i;</script>";
            $i++;

            // Si le nombre de tentatives dépasse 30, arrêter la génération
            if ($i > 30) {
                $motDePasseDone = true;
            }
        } while (!$passwordCheck->checkEtEnregistreMotDePasse($motDePasse) && !$motDePasseDone);

        // Si la génération a échoué après 30 tentatives, afficher un message d'erreur
        if ($motDePasseDone) {
            echo "<script>alert('Le mot de passe ne peut pas être généré car il ne sera pas unique.');</script>";
            return null;
        }
        // Retourne le mot de passe généré
        return $motDePasse;
    }
}
