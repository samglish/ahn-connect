CREATE DATABASE gestion_etudiants;

USE gestion_etudiants;

CREATE TABLE etudiants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100),
    prenom VARCHAR(100),
    matricule VARCHAR(50) UNIQUE,
    numero VARCHAR(20),
    filiere VARCHAR(100),
    email VARCHAR(150) UNIQUE,
    mot_de_passe VARCHAR(255)
);

