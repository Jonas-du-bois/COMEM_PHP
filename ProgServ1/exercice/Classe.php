<?php
function getStudents($className, $filePath) {
    $students = [];
    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $foundClass = false;

    foreach ($lines as $line) {
        if (strpos($line, 'M51-') === 0) {
            if ($foundClass) break;
            $foundClass = ($line === $className);
        } elseif ($foundClass) {
            $students[] = $line;
        }
    }

    return $students;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Liste des élèves par classe</title>
</head>
<body>
    <form action="classe.php" method="post">
        <label for="class_name">Nom de la classe :</label>
        <input type="text" name="class_name" id="class_name" required>
        <br><br>
        <input type="submit" value="Afficher les élèves">
    </form>
<?php
$className = '';
$students = [];
$filePath = 'uploads/listDeClasse.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['class_name'])) {
    $className = $_POST['class_name'];
    $students = getStudents($className, $filePath);
}
?>

    <?php if (!empty($students)): ?>
        <h2>Liste des élèves de la classe <?php echo htmlspecialchars($className); ?> :</h2>
        <ul>
            <?php foreach ($students as $student): ?>
                <li><?php echo htmlspecialchars($student); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php elseif ($className): ?>
        <p>Aucune classe trouvée avec le nom "<?php echo htmlspecialchars($className); ?>"</p>
    <?php endif; ?>
</body>
</html>

