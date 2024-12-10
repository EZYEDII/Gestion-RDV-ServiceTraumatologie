<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $telephone = $_POST['telephone'];

    $stmt = $pdo->prepare("INSERT INTO patients (nom, prenom, date_naissance, telephone) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $prenom, $date_naissance, $telephone]);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Patient</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" required><br><br>
        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" required><br><br>
        <label for="date_naissance">Date de Naissance:</label>
        <input type="date" name="date_naissance" required><br><br>
        <label for="telephone">Téléphone:</label>
        <input type="text" name="telephone" required><br><br>
        <button type="submit">Ajouter Patient</button>
    </form>
</body>
</html>
