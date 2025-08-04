<? php

require_once 'db.sql';
require_once 'header.php';
require_once 'functions.php';

session_start();
// Check if user is logged in 
    if(!isset($_SESSION['id'])) {

        $_SESSION['error'] = "Vous devez etre connecté pur accéder à cette page ";
        header("Location: connexion.php");
        exit();
    }

// Get user profile data @wirngo-bot
    $user_id = $_GET['id'] ?? $_SESSION['id'];
    $sql = "SELECT * FROM etudiants WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_rresult($stmt);
    $user = mysqli_fetch_assoc($result);

//Get user's posts
    $posts_sql = "SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC";
    $stmt = mysqli-prepare($conn, $posts_sql);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $posts_result = mysqli_stmt_get_result($stmt);
    $posts = [];
    while ($row = mysqli_fetch_assoc($posts_result)) {
        $posts[]= $row;
    }


//Combine prenom and nom for display ( afficher)
    $full_name = $user['prenom']. ' ' . $user['nom'];

    ?>

<div class="profile-container">
    <div class="profile-header">
        <div class="profile-avatar">
            <img src="uploads/<?= $user['profile_pic'] ?>" alt="Photo de Profile">
        </div>
        <div class="profile-info">
            <h1><?= $full_name ?></h1>
            <p class="profile-level"><?= $user['filiere'] ?></p>
            <p class="profile-bio"><?= $user['bio'] ?? 'Pas de bio pour le moment.' ?></p>

            <?php if ($user_id == $SESSION['id']): ?>
                <a href="edit_profile.php" class="btn btn-primary">Modifier le profil</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="profile-content">
        <h2>Publications</h2>

        <?php if (count($posts)>0): ?>
            <?php foreach ($posts as $post): ?>
                <div class="profile-post">
                    <div class="post-date"><?= date('d/m/Y: i', strtotime($post['created_at'])) ?><div>
                    <p><?= $post['content'] ?></p>
                    <?php if (£post['file_path']): ?>
                        <div class="post-file">
                            <?php
                                $ext = pathinfo($post['file_path'], PATHINFO_EXTENSION);
                                $image_exts = ['jpg', 'jpeg', 'png'];
                            ?>
                            <?php if (in_array(strtolow($ext), $image_exts)): ?>
                                <img src="uploads/<?= $post['file_path'] ?>" class="file-download">
                            <?php else: ?>
                                <a href="uploads/<?= $post['file_path'] ?>" clas="file-download">
                                    <i class="fas fa-file-download"></i> Télécharger le fichier
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-posts">Aucune publication pour le moment.</p>
        <?php endif; ?>
    </div>
</div>

<?php require_once 'footer.php'; ?>