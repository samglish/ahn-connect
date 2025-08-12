<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

$conn = new mysqli("localhost", "root", "", "gestion_etudiants");
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erreur de préparation : " . $conn->error);
    }

    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header("Location: actu.php");
        exit();
    } else {
        echo "<script>alert('Nom d’utilisateur ou mot de passe incorrect.'); window.location.href='login_admin.php';</script>";
    }

    $stmt->close();
}
$conn->close();
?>

