<?php

class PasswordCheck {

    private $filePath;

    // Constructeur pour initialiser le chemin du fichier où les mots de passe sont stockés
    public function __construct() {
        $this->filePath = ("passwords.txt");
    }

    // Hache le mot de passe en utilisant l'algorithme par défaut
    public function hashMotDePasse($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // Vérifie si le mot de passe en clair existe déjà dans le fichier
    public function checkMotDePasseDansFichier($motDePasseEnClair) {
        $estDansLefichier = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES); // Lit le fichier ligne par ligne
        foreach ($estDansLefichier as $ligneHash) {
            if (password_verify($motDePasseEnClair, $ligneHash)) { // Vérifie chaque ligne hachée avec le mot de passe en clair
                return true; // Retourne vrai si le mot de passe est trouvé
            }
        }
        return false; // Retourne faux si le mot de passe n'est pas trouvé
    }

    // Enregistre le mot de passe haché dans le fichier
    public function enregistrePassword($hashedPassword) {
        file_put_contents($this->filePath, $hashedPassword . PHP_EOL, FILE_APPEND); // Ajoute le mot de passe haché à la fin du fichier
    }

    // Vérifie si le mot de passe est unique et l'enregistre s'il l'est
    public function checkEtEnregistreMotDePasse($password) {
        $MotDePasseHashe = $this->hashMotDePasse($password); // Hache le mot de passe
        if ($this->checkMotDePasseDansFichier($password)) { // Vérifie si le mot de passe existe déjà
            return false; // Retourne faux si le mot de passe existe déjà
        } else {
            $this->enregistrePassword($MotDePasseHashe); // Enregistre le mot de passe s'il est unique
            return true; // Retourne vrai si le mot de passe a été enregistré
        }
    }
}
