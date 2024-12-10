<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_patient = $_POST['id_patient'];
    $id_medecin = $_POST['id_medecin'];
    $date_consultation = $_POST['date_consultation'];

    $stmt = $pdo->prepare("INSERT INTO rdv (id_patient, id_medecin, date_consultation) VALUES (?, ?, ?)");
    $stmt->execute([$id_patient, $id_medecin, $date_consultation]);

    header('Location: index.php');
    exit();
}

$patients = $pdo->query("SELECT * FROM patients")->fetchAll();
$medecins = $pdo->query("SELECT * FROM medecins")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Rendez-vous</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST">
        <label>Patient :</label>
        <select name="id_patient" required>
            <option value="" disabled selected>Choisir un patient</option>
            <?php foreach ($patients as $patient): ?>
                <option value="<?= $patient['id'] ?>">
                    <?= htmlspecialchars($patient['nom'] . ' ' . $patient['prenom']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Médecin :</label>
        <select name="id_medecin" required>
            <option value="" disabled selected>Choisir un médecin</option>
            <?php foreach ($medecins as $medecin): ?>
                <option value="<?= $medecin['id'] ?>">
                    <?= htmlspecialchars($medecin['nom'] . ' (' . $medecin['specialite'] . ')') ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Date et Heure :</label>
        <input type="datetime-local" name="date_consultation" required>

        <button type="submit">Ajouter</button>
    </form>
    <a href="index.php" class="btn">Retour</a>
</body>
</html>
