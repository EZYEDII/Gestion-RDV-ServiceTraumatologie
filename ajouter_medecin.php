<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $specialite = $_POST['specialite'];
    
    $stmt = $pdo->prepare("INSERT INTO medecins (nom, specialite) VALUES (?, ?)");
    $stmt->execute([$nom, $specialite]);
    
    header('Location: index.php');
    exit;
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Médecin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" required><br><br>
        <label for="specialite">Spécialité:</label>
        <input type="text" name="specialite" required><br><br>
        <button type="submit">Ajouter Médecin</button>
    </form>
</body>
</html>
