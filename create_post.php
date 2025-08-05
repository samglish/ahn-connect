<?php 
require_once 'db.php';
require_once 'functions.php';
session_start();

if (!isset($_SESSION['id'])) {
    $_SESSION['error'] = "Connectez-vous pour accéder à cette page.";
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_post'])) {
    $user_id = $_SESSION['id'];
    $content = sanitize_input($_POST['content']);

    // Validation du contenu
    if (empty($content)) {
        $_SESSION['error'] = "Le contenu du post ne peut pas être vide.";
        header("Location: index.php");
        exit();
    }

    // Gestion de l'upload
    $file_path = null;
    if (isset($_FILES['post_file']) && $_FILES['post_file']['error'] === 0) {
        $upload_result = upload_file($_FILES['post_file'], 'mixed');
        if ($upload_result['success']) {
            $file_path = $upload_result['file_name'];
        } else {
            $_SESSION['error'] = $upload_result['error'];
            header("Location: index.php");
            exit();
        }
    }

    // Insertion en base de données
    $sql = "INSERT INTO posts (user_id, content, file_path) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if (!$stmt) {
        $_SESSION['error'] = "Erreur de préparation SQL : " . mysqli_error($conn);
        header("Location: index.php");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iss", $user_id, $content, $file_path);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Post créé avec succès!";
    } else {
        $_SESSION['error'] = "Erreur lors de la création du post : " . mysqli_error($conn);
    }

    header("Location: index.php");
    exit();
} else {
    $_SESSION['error'] = "Requête invalide.";
    header("Location: index.php");
    exit();
}
?>
