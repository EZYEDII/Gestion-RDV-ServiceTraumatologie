CREATE DATABASE traumato_rdv;
USE traumato_rdv;

CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    date_naissance DATE,
    telephone VARCHAR(15)
);

CREATE TABLE medecins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    specialite VARCHAR(50)
);

CREATE TABLE rdv (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_patient INT,
    id_medecin INT,
    date_consultation DATETIME,
    FOREIGN KEY (id_patient) REFERENCES patients(id) ON DELETE CASCADE,
    FOREIGN KEY (id_medecin) REFERENCES medecins(id) ON DELETE CASCADE
);
