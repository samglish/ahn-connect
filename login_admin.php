
<?php
session_start();
require_once 'db.php';
require_once 'header1.php';
require_once 'functions.php';

if ($_SESSION['admin']) {
    header("Location: actu.php");
    exit();
}
?>
 <center>
    <br>
<h2 >Administrateur</h2>
 <div id="formulaire">

  <!-- login_admin.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
</head>
<body>
    <h2>Connexion Admin</h2>
    <form method="POST" action="login_admin_trait.php">
        <label>Nom d'utilisateur :</label>
        <input type="text" name="username" required><br><br>

        <label>Mot de passe :</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>

  
<?php require_once 'footer.php'; ?>

