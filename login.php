
<?php
require_once 'db.php';
require_once 'header.php';
require_once 'functions.php';

// Fetch data for the page
$news = get_news($conn);
$posts = get_posts($conn);
$users = get_users($conn);

// Get user info from session
$user_id = $_SESSION['id'] ?? null;
$username = ($_SESSION['prenom'] ?? '') . ' ' . ($_SESSION['nom'] ?? '');
$profile_pic = $_SESSION['profile_pic'] ?? 'default.jpg';
$level = $_SESSION['filiere'] ?? 'Étudiant';
?>

<?php if (isset($_SESSION['id'])): ?>
    <!-- Main Content for Logged-in Users -->
    <div class="main-content">
        <!-- Left Sidebar -->
        <div class="sidebar">
            <h3 class="sidebar-title">Mon Profil</h3>
            <div class="user-card">
                <img src="uploads/<?= $profile_pic ?>" alt="Profile">
                <div class="user-info">
                    <div class="username"><?= $username ?></div>
                    <div class="level"><?= $level ?></div>
                </div>
            </div>
            
            <h3 class="sidebar-title">Navigation</h3>
            <div class="menu">
                <a href="profile.php" class="menu-item"><i class="fas fa-user"></i> Mon Profil</a>
                <a href="#" class="menu-item"><i class="fas fa-cog"></i> Paramètres</a>
                <a href="#" class="menu-item"><i class="fas fa-bookmark"></i> Favoris</a>
                <a href="#" class="menu-item"><i class="fas fa-users"></i> Groupes</a>
                <a href="#" class="menu-item"><i class="fas fa-calendar-check"></i> Événements</a>
                <a href="#" class="menu-item"><i class="fas fa-question-circle"></i> Aide</a>
            </div>
        </div>
        
           <h2>Connexion</h2>
    <form action="login_trait.php" method="post">
        Adresse email : <input type="email" name="email" required><br>
        Mot de passe : <input type="password" name="mot_de_passe" required><br><br>
        <input type="submit" value="Se connecter">
    </form>

<?php endif; ?>

<?php require_once 'footer.php'; ?>
