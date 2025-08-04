<?php
require_once 'db.php';
require_once 'functions.php';

session_start();

if (!isset($_SESSION['id'])) {
    $_SESSION['error'] = "Vous devez être connecté pour commenter";
    header("Location: connexion.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_comment'])) {
    $user_id = $_SESSION['id'];
    $post_id = sanitize_input($_POST['post_id']);
    $content = sanitize_input($_POST['comment_content']);
    
    // Insert comment into database
    $sql = "INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iis", $post_id, $user_id, $content);
    
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Commentaire ajouté avec succès!";
    } else {
        $_SESSION['error'] = "Erreur lors de l'ajout du commentaire: " . mysqli_error($conn);
    }
}

header("Location: index.php");
exit();
?>