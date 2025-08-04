<nav class="nav-links">
    <a href="index.php"><i class="fas fa-home"></i> Accueil</a>
    <a href="#"><i class="fas fa-user-friends"></i> Communauté</a>
    <a href="#"><i class="fas fa-bell"></i> Notifications</a>
    <a href="#"><i class="fas fa-newspaper"></i> Actualités</a>
    <a href="#"><i class="fas fa-calendar-alt"></i> Événements</a>
</nav>
<div class="user-actions">
    <?php if (isset($_SESSION['id'])): ?>
        <?php
        $username = $_SESSION['prenom'] . ' ' . $_SESSION['nom'];
        $profile_pic = $_SESSION['profile_pic'] ?? 'default.jpg';
        ?>
        <img src="uploads/<?= $profile_pic ?>" alt="Profile" class="profile-pic">
        <span><?= $username ?></span>
       <!-- <a href="logout.php" class="btn btn-outline"><i class="fas fa-sign-out-alt"></i> Déconnexion</a> -->
    <?php else: ?>
        <a href="connexion.php" class="btn btn-outline"><i class="fas fa-sign-in-alt"></i> Connexion</a>
       <!-- <a href="inscription.php" class="btn btn-primary"><i class="fas fa-user-plus"></i> Inscription</a> -->
    <?php endif; ?>
</div>