<?php
require_once 'db.php';
require_once 'header.php';
require_once 'functions.php';
session_start();
// Check if user is logged in 
    if(!isset($_SESSION['id'])) {

        $_SESSION['error'] = "Vous devez etre connecté pur accéder à cette page ";
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
    
        <div class="resultats-list" style="display: flex; flex-wrap: wrap; gap: 32px; justify-content: center;">
            <div class="resultat-block" style="min-width: 260px; background: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 8px #0001; padding: 24px; margin-bottom: 16px;">
                <h3 style="margin-top:0;">IAN</h3>
                <ul style="list-style: none; padding-left: 0;">
                    <li>
                        <strong>IC1</strong><br>
                        <a href="uploads/resultats_ihn_ic1.pdf" class="btn btn-primary" target="_blank">Session normale</a>
                        <a href="uploads/resultats_rattrapage.pdf" class="btn btn-primary" target="_blank">Session de rattrapage</a>
                    </li>
                    <li style="margin-top: 12px;">
                        <strong>IC2</strong><br>
                        <a href="uploads/resultats_ihn_ic1.pdf" class="btn btn-primary" target="_blank">Session normale</a>
                        <a href="uploads/resultats_rattrapage.pdf" class="btn btn-primary" target="_blank">Session de rattrapage</a>
                    </li>
                    <li style="margin-top: 12px;">
                        <strong>IC3</strong><br>
                        <a href="uploads/resultats_ihn_ic1.pdf" class="btn btn-primary" target="_blank">Session normale</a>
                        <a href="uploads/resultats_rattrapage.pdf" class="btn btn-primary" target="_blank">Session de rattrapage</a>
                    </li>
                    <li style="margin-top: 12px;">
                        <strong>IC4</strong><br>
                        <a href="uploads/resultats_ihn_ic1.pdf" class="btn btn-primary" target="_blank">Session normale</a>
                        <a href="uploads/resultats_rattrapage.pdf" class="btn btn-primary" target="_blank">Session de rattrapage</a>
                    </li>
                </ul>
            </div>
            <div class="resultat-block" style="min-width: 260px; background: #f8f9fa; border-radius: 8px; box-shadow: 0 2px 8px #0001; padding: 24px; margin-bottom: 16px;">
                <h3 style="margin-top:0;">IHN</h3>
                <ul style="list-style: none; padding-left: 0;">
                    <li>
                        <strong>IC1</strong><br>
                        <a href="uploads/resultats_ihn_ic1.pdf" class="btn btn-primary" target="_blank">Session normale</a>
                        <a href="uploads/resultats_rattrapage.pdf" class="btn btn-primary" target="_blank">Session de rattrapage</a>
                    </li>
                    <li style="margin-top: 12px;">
                        <strong>IC2</strong><br>
                        <a href="uploads/resultats_ihn_ic1.pdf" class="btn btn-primary" target="_blank">Session normale</a>
                        <a href="uploads/resultats_rattrapage.pdf" class="btn btn-primary" target="_blank">Session de rattrapage</a>
                    </li>
                    <li style="margin-top: 12px;">
                        <strong>IC3</strong><br>
                        <a href="uploads/resultats_ihn_ic1.pdf" class="btn btn-primary" target="_blank">Session normale</a>
                        <a href="uploads/resultats_rattrapage.pdf" class="btn btn-primary" target="_blank">Session de rattrapage</a>
                    </li>
                    <li style="margin-top: 12px;">
                        <strong>IC4</strong><br>
                        <a href="uploads/resultats_ihn_ic1.pdf" class="btn btn-primary" target="_blank">Session normale</a>
                        <a href="uploads/resultats_rattrapage.pdf" class="btn btn-primary" target="_blank">Session de rattrapage</a>
                    </li>
                </ul>
            </div>
        </div>
</div> 
<?php require_once 'footer.php'; ?>

