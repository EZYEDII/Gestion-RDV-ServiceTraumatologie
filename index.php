<?php
include 'config.php';

$queryMedecins = $pdo->query("SELECT * FROM medecins");
$medecins = $queryMedecins->fetchAll(PDO::FETCH_ASSOC);

$queryRdv = $pdo->query("SELECT rdv.id, patients.nom AS patient_nom, patients.prenom AS patient_prenom, medecins.nom AS medecin_nom, rdv.date_consultation
                         FROM rdv
                         JOIN patients ON rdv.id_patient = patients.id
                         JOIN medecins ON rdv.id_medecin = medecins.id");
$rdvs = $queryRdv->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des RDV - Service de Traumatologie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }
        .table {
            margin-top: 20px;
        }
        footer {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Traumatologie</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="ajouter_patient.php"><i class="bi bi-person-plus"></i> Ajouter Patient</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ajouter_medecin.php"><i class="bi bi-person-bounding-box"></i> Ajouter Médecin</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="ajouter_rdv.php"><i class="bi bi-calendar-plus"></i> Ajouter RDV</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="text-center mb-4">
        <h2>Gestion des RDV - Service de Traumatologie</h2>
        <p class="text-muted">Gérez vos patients, médecins, et rendez-vous avec simplicité.</p>
    </div>

    <div class="row">
        <div class="col-md-9">
            <p>
                Bienvenue sur notre système de gestion pour le <strong>Service de Traumatologie</strong>. 
                Cette application permettra de:
            </p>
            <ul>
                <li>Ajouter et gérer des patients.</li>
                <li>Enregistrer les médecins et leurs spécialités.</li>
                <li>Planifier, modifier, ou supprimer des rendez-vous.</li>
            </ul>
        </div>
        <div class="col-md-3 text-center">
            <img src="image.jpg" alt="Service de traumatologie" class="img-fluid rounded shadow" style="max-width: 80%;">
        </div>
    </div>

    <div class="mt-5">
        <h4>Liste des Médecins</h4>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Spécialité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($medecins as $medecin): ?>
                        <tr>
                            <td><?= $medecin['id'] ?></td>
                            <td><?= $medecin['nom'] ?></td>
                            <td><?= $medecin['specialite'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-5">
        <h4>Liste des Rendez-vous</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-success">
                    <tr>
                        <th>Patient</th>
                        <th>Médecin</th>
                        <th>Date & Heure</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rdvs as $rdv): ?>
                        <tr>
                            <td><?= $rdv['patient_nom'] ?> <?= $rdv['patient_prenom'] ?></td>
                            <td><?= $rdv['medecin_nom'] ?></td>
                            <td><?= date("d/m/Y H:i", strtotime($rdv['date_consultation'])) ?></td>
                            <td>
                                <a href="modifier_rdv.php?id=<?= $rdv['id'] ?>" class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil-square"></i> Modifier
                                </a>
                                <a href="supprimer_rdv.php?id=<?= $rdv['id'] ?>" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Supprimer
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer class="text-center py-3 mt-5">
    <p>&copy; 2024 Service de Traumatologie. Tous droits réservés.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
