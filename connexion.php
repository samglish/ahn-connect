<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Étudiant</title>
</head>
<body>
    <h2>Connexion</h2>
    <form action="verifier.php" method="post">
        Adresse email : <input type="email" name="email" required><br>
        Mot de passe : <input type="password" name="mot_de_passe" required><br><br>
        <input type="submit" value="Se connecter">
    </form>
    <div class="redirect">
        <p>don't have an account ? <a href="inscription.php">sign up</a></p>
</body>
</html>

