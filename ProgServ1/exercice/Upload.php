<?php
// Mot de passe pour la protection de l'upload
$password = "votre_mot_de_passe";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['password']) && $_POST['password'] === $password) {
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/uploads/';
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $uploadFile = $uploadDir . basename($_FILES['file']['name']);
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
                echo "Le fichier a été téléchargé avec succès.";
            } else {
                echo "Échec du téléchargement du fichier.";
            }
        } else {
            echo "Aucun fichier ou une erreur est survenue.";
        }
    } else {
        echo "Mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Classes</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>
        <br><br>
        <label for="file">Choisir un fichier :</label>
        <input type="file" name="file" id="file" required>
        <br><br>
        <input type="submit" value="Uploader">
    </form>
</body>
</html>

