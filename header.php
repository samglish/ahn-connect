
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Réseau Social Edutiant - Département AHN</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
            <header>
                <div class="conatainer header-container">
                    <div class="logo">
                        <i class="fas fa-graduation-cap"></i>
                        <h1>Edutiants AHN</h1>
                    </div>
                    <?php include 'navigation.php'; ?>  
                </div> 
           </header>

           <div class="container">
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
                    </div>
                    <?php unset($_SESSION['error']); ?>
                <?php endif; ?>

                <?php if(isset($_SESSION['successs'])): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> <?= $_SESSION['seccess'] ?>
                    </div>
                    
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

