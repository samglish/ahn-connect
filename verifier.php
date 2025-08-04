<?php
session_start();
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
$sql = "SELECT id, nom, prenom, mot_de_passe FROM etudiants WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($id, $nom, $prenom, $mot_de_passe_hash);
    $stmt->fetch();

    // Vérification du mot de passe
    if (password_verify($mot_de_passe, $mot_de_passe_hash)) {
//Set session variables
        $_SESSION['id'] = $id;
        $_SESSION['nom'] = $nom;
        $_SESSION['prenom'] = $prenom;
        $_SESSION['filiere'] = $filiere;
        $_SESSION['email'] = $email;
        $_SESSION['profile_pic'] = $profile_pic;

//Redirect to social network
        header("Location: index.php");
    exit();       
        //echo "Connexion réussie ! Bienvenue.";
    } else {
        echo "Mot de passe incorrect.";
    }
} else {
    echo "Adresse email non reconnue.";
}

$stmt->close();
$conn->close();
?>

