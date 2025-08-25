<?php
session_start();
require_once 'db.php'; // Corrigé : c'est db.php, pas db.sql
require_once 'header.php';
require_once 'functions.php';


// Vérification connexion
if (!isset($_SESSION['id'])) {
    $_SESSION['error'] = "Connectez-vous pour accéder à cette page.";
    header("Location: login.php");
    exit();
}

// Récupérer l'id de l'utilisateur à afficher (GET ou session)
$user_id = $_GET['id'] ?? $_SESSION['id'];

// Préparation et exécution requête pour récupérer les infos utilisateur
$sql = "SELECT * FROM etudiants WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "Utilisateur non trouvé.";
    exit();
}

// Récupérer les posts de l'utilisateur
$posts_sql = "SELECT * FROM posts WHERE user_id = ? ORDER BY created_at DESC";
$stmt = mysqli_prepare($conn, $posts_sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$posts_result = mysqli_stmt_get_result($stmt);

$posts = [];
while ($row = mysqli_fetch_assoc($posts_result)) {
    $posts[] = $row;
}

$full_name = htmlspecialchars($user['prenom'] . ' ' . $user['nom']);
?>

<div class="profile-container">
    <div class="profile-header">
        <div class="profile-avatar">
          <a href="uploads/<?= htmlspecialchars($user['photo_profil'] ?? 'default.jpg') ?>">  <img src="uploads/<?= htmlspecialchars($user['photo_profil'] ?? 'default.jpg') ?>" alt="Photo de profil"></a>
        </div>
        <div class="profile-info">
            <h1><?= $full_name ?></h1>
            <p class="profile-level"><?= htmlspecialchars($user['filiere'] ?? 'Étudiant') ?></p>
            <p class="profile-bio"><?= htmlspecialchars($user['bio'] ?? 'Pas de bio pour le moment.') ?></p>

            <?php if ($user_id == $_SESSION['id']): ?>
                <a href="edit_profile.php" class="btn btn-primary">Modifier le profil</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="profile-content">
        <h2>Publications</h2>

        <?php if (count($posts) > 0): ?>
            <?php foreach ($posts as $post): ?>
                <div class="profile-post">
                    <div class="post-date"><?= date('d/m/Y H:i', strtotime($post['created_at'])) ?></div>
                    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                    <?php if (!empty($post['file_path'])): ?>
                        <div class="post-file">
                            <?php
                                $ext = strtolower(pathinfo($post['file_path'], PATHINFO_EXTENSION));
                                $image_exts = ['jpg', 'jpeg', 'png', 'gif'];
                            ?>
                            <?php if (in_array($ext, $image_exts)): ?>
                               <a href="uploads/<?= htmlspecialchars($post['file_path']) ?>"> <img src="uploads/<?= htmlspecialchars($post['file_path']) ?>" alt="Image du post" class="file-download"></a>
                            <?php else: ?>
                                <a href="uploads/<?= htmlspecialchars($post['file_path']) ?>" class="file-download" download>
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
