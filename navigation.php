<nav class="nav-links">
    <a href="index.php"><i class="fas fa-home"></i> Accueil</a>
    <a href="#"><i class="fas fa-user-friends"></i> Actualités</a>
    <a href="#"><i class="fas fa-bell"></i> Résultats</a>
    <a href="#"><i class="fas fa-newspaper"></i>Discussions</a>
</nav>
<div class="user-actions">
    <?php if (isset($_SESSION['id'])): ?>
        <?php
        $username = $_SESSION['prenom'] . ' ' . $_SESSION['nom'];
        $profile_pic = $_SESSION['profile_pic'] ?? 'default.jpg';
        ?>
        <img src="uploads/<?= $profile_pic ?>" alt="Profile" class="profile-pic">
        <span><?= $username ?></span>
     <a href="logout.php" class="btn btn-outline"><i class="fas fa-sign-out-alt"></i>Logout⏻</a>
    <?php else: ?>
        <a href="login.php" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Login</a>
       <a href="register.php" class="btn btn-primary"><i class="fas fa-user-plus"></i> Register</a>
    <?php endif; ?>
</div>