<?php
// Connexion à la base de données
$conn = new mysqli("localhost", "root", "", "gestion_etudiants");

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

// Récupération des données du formulaire
$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

// Requête pour chercher l'utilisateur
$sql = "SELECT mot_de_passe FROM etudiants WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($mot_de_passe_hash);
    $stmt->fetch();

    // Vérification du mot de passe
       if (password_verify($mot_de_passe, $mot_de_passe_hash)) {
    // Récupérer les infos de l'utilisateur
    $sql = "SELECT id, prenom, nom, profile_pic, filiere FROM etudiants WHERE email = ?";
    $stmt_infos = $conn->prepare($sql);
    $stmt_infos->bind_param("s", $email);
    $stmt_infos->execute();
    $stmt_infos->bind_result($id, $prenom, $nom, $profile_pic, $filiere);
    $stmt_infos->fetch();

    session_start();
    $_SESSION['id'] = $id;

    $stmt_infos->close();
    header("location: index.php");
    exit();
}else {
        echo "Mot de passe incorrect.";
    }
} else {
    echo "Adresse email non reconnue.";
}

$stmt->close();
$conn->close();
?>

