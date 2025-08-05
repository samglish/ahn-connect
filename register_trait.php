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

// Gestion de la photo de profil
$photo_profil = 'default.jpg'; // Par défaut

if (isset($_FILES['photo_profil']) && $_FILES['photo_profil']['error'] === 0) {
    $dossier_upload = 'uploads/';
    $fichier_tmp = $_FILES['photo_profil']['tmp_name'];

    // Nettoyer le nom du fichier (éviter caractères bizarres)
    $nom_fichier_origine = basename($_FILES['photo_profil']['name']);
    $nom_fichier_origine = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $nom_fichier_origine);

    $fichier_nom = time() . '_' . $nom_fichier_origine;
    $chemin_complet = $dossier_upload . $fichier_nom;

    // Vérifier si c'est bien une image
    $type_mime = mime_content_type($fichier_tmp);
    if (strpos($type_mime, 'image') !== false) {
        if (move_uploaded_file($fichier_tmp, $chemin_complet)) {
            $photo_profil = $fichier_nom;
        } else {
            die("Erreur lors du déplacement du fichier uploadé.");
        }
    } else {
        die("Le fichier uploadé n’est pas une image valide.");
    }
}

// Requête d'insertion avec requête préparée
$sql = "INSERT INTO etudiants (nom, prenom, matricule, numero, filiere, email, mot_de_passe, photo_profil)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssss", $nom, $prenom, $matricule, $numero, $filiere, $email, $mot_de_passe, $photo_profil);

if ($stmt->execute()) {
    echo "Inscription réussie !";
    header('Location: login.php');
    exit();
} else {
    echo "Erreur : " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
