
<?php
require_once 'db.php';
require_once 'header.php';
require_once 'functions.php';
?>
 <center>
    <br>
<h2 >Resultats </h2>
session normale et rattrapage</br>
<div id="formulaire">
    <form action="resultats.php" method="post">
        <input type="text" name="matricule" placeholder="Matricule" required></br>
        <input type="submit" value="Rechercher" class="btn btn-primary">
        <p>Problème technique? <a href="mailto:beidisamuel11@gmail.com">contactez nous</a></p>
    </form>
</div>
</center>
<div id="resultats">
    2025
   <a href="Session_normale_IHN1.pdf" class="btn btn-primary" target="_blank">Session normale IHN 1</a> |
   <a href="Rattrapage_IHN1.pdf" target="_blank" class="btn btn-primary">Rattrapage IHN 1</a> | <a href="Session_normale_IHN2.pdf" class="btn btn-primary" target="_blank">Session normale IHN 2</a> |
   <a href="Rattrapage_IHN2.pdf" target="_blank" class="btn btn-primary">Rattrapage IHN 2</a>
<a href="Session_normale_IHN3.pdf" class="btn btn-primary" target="_blank">Session normale IHN 3</a> |
   <a href="Rattrapage_IHN3.pdf" target="_blank" class="btn btn-primary">Rattrapage IHN 3</a> | <a href="Session_normale_IHN4.pdf" class="btn btn-primary" target="_blank">Session normale IHN 4</a> |
   <a href="Rattrapage_IHN4.pdf" target="_blank" class="btn btn-primary">Rattrapage IHN 4</a>
</div> 
<?php require_once 'footer.php'; ?>

