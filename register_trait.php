<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "gestion_etudiants");

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupération et sécurisation des données
$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlspecialchars($_POST['prenom']);
$matricule = htmlspecialchars($_POST['matricule']);
$numero = htmlspecialchars($_POST['numero']);
$filiere = htmlspecialchars($_POST['filiere']);
$email = htmlspecialchars($_POST['email']);
$mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);

// Requête d'insertion
$sql = "INSERT INTO etudiants (nom, prenom, matricule, numero, filiere, email, mot_de_passe)
        VALUES ('$nom', '$prenom', '$matricule', '$numero', '$filiere', '$email', '$mot_de_passe')";

if ($conn->query($sql) === TRUE) {
    echo "Inscription réussie !";
    header("location: login.php");
} else {
    echo "Erreur : " . $conn->error;
}

$conn->close();
?>

