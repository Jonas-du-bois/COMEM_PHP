<?php
if (isset($_POST['clear'])) {
    // Chemin vers le fichier de mots de passe
    $filePath = 'passwords.txt';

    // Ouvre le fichier en mode écriture pour le vider
    $file = fopen($filePath, 'w');
    fclose($file);

    // Message de confirmation
    echo "<script>alert('Le fichier de mots de passe a été vidé.');</script>";
    echo "<script>window.location.href = 'index.php';</script>";
}
?>
