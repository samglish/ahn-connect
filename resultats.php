<?php
require_once 'db.php';
require_once 'header.php';
require_once 'functions.php';
session_start();
// Check if user is logged in 
    if(!isset($_SESSION['id'])) {

        $_SESSION['error'] = "Connectez-vous pour accéder à cette page. ";
        header("Location: login.php");
        exit();
    }

?>  

<br>
    <div id="resultats">
<span>
   <h2>Résultats des examens 2024-2025</h2>
    <p>Consultez les résultats des examens pour l'année académique 2024-2025.</p>
</span>
<hr>
</br>
        <div class="resultat-item">
            
            <h3> <li>IAN IC1</li></h3>
            <a href="results/SN IAN1.pdf" class="btn btn-primary" target="_blank">Session normale</a>
            <a href="results/SR IAN1.pdf" class="btn btn-primary" target="_blank">Session de rattrapage</a>
            <h3> <li>IAN IC2</li></h3>
            <a href="results/SN IAN2.pdf" class="btn btn-primary" target="_blank">Session normale</a>
            <a href="results/SR IAN2.pdf" class="btn btn-primary" target="_blank">Session de rattrapage</a>
            <h3> <li>IAN IC3</li></h3>
            <a href="results/SN IAN3.pdf" class="btn btn-primary" target="_blank">Session normale</a>
            <a href="results/SR IAN3.pdf" class="btn btn-primary" target="_blank">Session de rattrapage</a>
</br></br>
            <hr></br>

            <h3> <li>IHN IC1</li></h3
            <a></a>
            <a href="results/SN IHN1.pdf" class="btn btn-primary" target="_blank">Session normale</a>
            <a href="results/SR IHN1.pdf" class="btn btn-primary" target="_blank">Session de rattrapage</a>
            <h3> <li>IHN IC2</li></h3>
             <a href="results/SN IHN2.pdf" class="btn btn-primary" target="_blank">Session normale</a>
            <a href="results/SR IHN2.pdf" class="btn btn-primary" target="_blank">Session de rattrapage</a>
            <h3> <li>IHN IC3</li></h3>
             <a href="results/SN IHN3.pdf" class="btn btn-primary" target="_blank">Session normale</a>
            <a href="results/SR IHN3.pdf" class="btn btn-primary" target="_blank">Session de rattrapage</a>
        
            <hr></br>
        </div>
</div> 





    
<?php require_once 'footer.php'; ?>

