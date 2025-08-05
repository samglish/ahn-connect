<?php
session_start();

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

// Gestion de la photo de profil
$photo_profil = 'default.jpg'; // Par défaut

if (isset($_FILES['photo_profil']) && $_FILES['photo_profil']['error'] == 0) {
    $dossier_upload = 'uploads/';
    $fichier_tmp = $_FILES['photo_profil']['tmp_name'];
    $fichier_nom = time() . '_' . basename($_FILES['photo_profil']['name']);
    $chemin_complet = $dossier_upload . $fichier_nom;

    // Vérifier si c'est bien une image
    $type_mime = mime_content_type($fichier_tmp);
    if (strpos($type_mime, 'image') !== false) {
        if (move_uploaded_file($fichier_tmp, $chemin_complet)) {
            $photo_profil = $fichier_nom;
        }
    }
}

// Requête d'insertion avec requête préparée
$sql = "INSERT INTO etudiants (nom, prenom, matricule, numero, filiere, email, mot_de_passe, photo_profil)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $nom, $prenom, $matricule, $numero, $filiere, $email, $mot_de_passe, $photo_profil);

if ($stmt->execute()) {
    echo "<script>alert('Inscription réussie !'); window.location.href='login.php';</script>";
} else {
    echo "Erreur : " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
