
<?php
session_start();
require_once 'db.php';
require_once 'header.php';
require_once 'functions.php';
$news = get_news($conn);

?>
 <center>
 <div class="sidebar">
    <h6><a href="login_admin.php" class="btn btn-primary">Nouvelle Annonce</a> </br></br></h6>
    <div id="resultats">
            <h3 class="section-title">Actualités </h3>  
            <?php foreach ($news as $item): ?>
                <div class="news-card">
                    <div class="news-title"><?= $item['title'] ?></div>
                    <div class="news-date">Publié le <?= date('d/m/Y H:i', strtotime($item['created_at'])) ?></div>
                    <div class="news-content"><?= $item['content'] ?></div>
                </div>
            <?php endforeach; ?>
        </div>
            </div>
                <?php require_once 'footer.php'; ?>

