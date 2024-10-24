<?php
// Mot de passe administrateur (à ne pas stocker en clair dans le code)
$adminPassword = 'MotDePasse'; // Remplacez par un mot de passe fort

if (isset($_POST['clear'])) {
    // Vérifie si le mot de passe a été soumis
    if (isset($_POST['adminPassword']) && $_POST['adminPassword'] === $adminPassword) {
        // Chemin vers le fichier de mots de passe
        $filePath = 'passwords.txt';

        // Ouvre le fichier en mode écriture pour le vider
        $file = fopen($filePath, 'w');
        fclose($file);

        // Message de confirmation
        echo "<script>alert('Le fichier de mots de passe a été vidé.');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        // Message d'erreur si le mot de passe est incorrect
        echo "<script>alert('Mot de passe incorrect. Action non autorisée.');</script>";
        echo "<script>window.location.href = 'index.php';</script>";
    }
}
?>
