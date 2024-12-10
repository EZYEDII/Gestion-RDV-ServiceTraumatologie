<?php
include 'config.php';

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}
$id_rdv = $_GET['id'];

$stmt = $pdo->prepare("
    SELECT * FROM rdv WHERE id = ?
");
$stmt->execute([$id_rdv]);
$rdv = $stmt->fetch();

if (!$rdv) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_patient = $_POST['id_patient'];
    $id_medecin = $_POST['id_medecin'];
    $date_consultation = $_POST['date_consultation'];

    $update_stmt = $pdo->prepare("
        UPDATE rdv 
        SET id_patient = ?, id_medecin = ?, date_consultation = ?
        WHERE id = ?
    ");
    $update_stmt->execute([$id_patient, $id_medecin, $date_consultation, $id_rdv]);

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
    <title>Modifier un Rendez-vous</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST">
        <label>Patient :</label>
        <select name="id_patient" required>
            <?php foreach ($patients as $patient): ?>
                <option value="<?= $patient['id'] ?>" <?= $rdv['id_patient'] == $patient['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($patient['nom'] . ' ' . $patient['prenom']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Médecin :</label>
        <select name="id_medecin" required>
            <?php foreach ($medecins as $medecin): ?>
                <option value="<?= $medecin['id'] ?>" <?= $rdv['id_medecin'] == $medecin['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($medecin['nom'] . ' (' . $medecin['specialite'] . ')') ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Date et Heure :</label>
        <input type="datetime-local" name="date_consultation" value="<?= date('Y-m-d\TH:i', strtotime($rdv['date_consultation'])) ?>" required>

        <button type="submit">Modifier</button>
    </form>
    <a href="index.php" class="btn">Retour</a>
</body>
</html>
