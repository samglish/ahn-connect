<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription Étudiant</title>
</head>-
<body>
<center>
    <h2>Formulaire d'inscription</h2>
    <form action="trait.php" method="post">
        <input type="text" name="nom" placeholder="Nom" required></br> </br>
        <input type="text" name="prenom" placeholder="Prénom" required></br></br>
        <input type="text" name="matricule" placeholder="Matricule" required></br></br>
        <input type="text" name="numero" placeholder="Numéro" required></br></br>
        <input type="text" name="filiere" placeholder="Filière" required></br></br>
        <input type="email" name="email" placeholder="Adresse email" required></br></br>
        <input type="password" name="mot_de_passe" placeholder="Mot de passe" required><br><br>
        <input type="submit" value="S'inscrire">
    </form>
<p>vous avez deja un compte  ? <a href="connexion.php">sign in</a></p>
</center>
 
</body>
</html>

