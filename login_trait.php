<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$conn = new mysqli("localhost", "root", "", "gestion_etudiants");
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$email = $_POST['email'];
$mot_de_passe = $_POST['mot_de_passe'];

$sql = "SELECT id, prenom, nom, filiere, photo_profil, mot_de_passe FROM etudiants WHERE email = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erreur préparation requête: " . $conn->error);
}

$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();

    if (password_verify($mot_de_passe, $user['mot_de_passe'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['filiere'] = $user['filiere'];
        $_SESSION['profile_pic'] = $user['photo_profil'];

        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Mot de passe incorrect.'); window.location.href='login.php';</script>";
    }
} else {
    echo "<script>alert('Adresse email non reconnue.'); window.location.href='login.php';</script>";
}

$stmt->close();
$conn->close();
?>
