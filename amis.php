<?php
session_start();
ob_start();
require_once 'db.php';
require_once 'header.php';
require_once 'functions.php';

if (!isset($_SESSION['id'])) {
    $_SESSION['error'] = "Connectez-vous pour accéder à cette page.";
    header("Location: login.php");
    exit();
    ob_end_flush();
}

$user_id = $_SESSION['id'];
echo "<p>ID utilisateur connecté : $user_id</p>";

// ===================================================
// ÉTAPE 1 : CRÉER UN AMI DE TEST SI NÉCESSAIRE (CORRIGÉ)
// ===================================================

// Vérifier si l'utilisateur a déjà des amis
$hasFriends = $conn->query("SELECT COUNT(*) as total FROM amis 
                          WHERE (user_id = $user_id OR ami_id = $user_id) 
                          AND statut = 'accepte'")->fetch_assoc()['total'] > 0;

if (!$hasFriends) {
    // Créer un nouvel étudiant pour servir d'ami
    $test_matricule = 'TEST' . rand(1000, 9999);
    $test_email = "ami_test_".time()."@example.com";
    $password = password_hash('password', PASSWORD_DEFAULT); // Hacher le mot de passe
    
    // Utiliser une requête préparée pour l'insertion
    $stmt = $conn->prepare("INSERT INTO etudiants 
        (nom, prenom, matricule, numero, filiere, email, mot_de_passe, photo_profil) 
        VALUES 
        ('Doe', 'John', ?, '123456789', 'IRS', ?, ?, 'default.jpg')");
    
    $stmt->bind_param("sss", $test_matricule, $test_email, $password);
    $stmt->execute();
    
    // Récupérer l'ID du nouvel ami
    $test_ami_id = $stmt->insert_id;

    if ($test_ami_id > 0) {
        // Créer la relation d'amitié bidirectionnelle
        $conn->query("INSERT IGNORE INTO amis (user_id, ami_id, statut) VALUES ($user_id, $test_ami_id, 'accepte')");
        $conn->query("INSERT IGNORE INTO amis (user_id, ami_id, statut) VALUES ($test_ami_id, $user_id, 'accepte')");
        echo "<div class='alert alert-success'>Ami test ajouté (ID: $test_ami_id)</div>";
    } else {
        echo "<div class='alert alert-warning'>Impossible de créer un ami test</div>";
    }
}

// ===================================================
// ÉTAPE 2 : AFFICHER LES AMIS (CORRIGÉ)
// ===================================================

// Requête optimisée pour récupérer les amis
$sql = "
    SELECT e.id, e.nom, e.prenom, e.photo_profil, e.matricule
    FROM amis a
    JOIN etudiants e ON 
        (a.ami_id = e.id AND a.user_id = ? AND a.statut = 'accepte')
        OR 
        (a.user_id = e.id AND a.ami_id = ? AND a.statut = 'accepte')
    GROUP BY e.id
";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erreur préparation requête : " . $conn->error);
}

$stmt->bind_param("ii", $user_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

echo "<h3>Mes amis</h3>";

if ($result->num_rows == 0) {
    echo "<div class='alert alert-info'>Aucun ami trouvé. Ajoutez des amis ci-dessous.</div>";
} else {
    echo "<div class='friends-list'>";
    while ($row = $result->fetch_assoc()) {
        $photo = !empty($row['photo_profil']) ? $row['photo_profil'] : 'default.jpg';
        echo "
        <div class='friend-card'>
            <img src='$profile_pic' alt='Photo profil' class='friend-photo'>
            <div class='friend-info'>
                <h5>{$row['prenom']} {$row['nom']}</h5>
                <p class='text-muted'>Matricule: {$row['matricule']}</p>
            </div>
            <div class='friend-actions'>
                <form method='POST' style='display:inline'>
                    <input type='hidden' name='friend_id' value='{$row['id']}'>
                    <button type='submit' name='remove_friend' class='btn btn-sm btn-outline-danger'>Supprimer</button>
                </form>
            </div>
        </div>";
    }
    echo "</div>";
}

// Gestion de la suppression d'ami
if (isset($_POST['remove_friend'])) {
    $friend_id = $_POST['friend_id'];
    
    // Supprimer les relations dans les deux sens
    $conn->query("DELETE FROM amis WHERE 
                (user_id = $user_id AND ami_id = $friend_id) 
                OR 
                (user_id = $friend_id AND ami_id = $user_id)");
    
    echo "<div class='alert alert-success'>Ami supprimé avec succès</div>";
    // Rafraîchir la page
    echo "<script>setTimeout(() => window.location.reload(), 1500)</script>";
}

// ===================================================
// ÉTAPE 3 : FORMULAIRE POUR AJOUTER DES AMIS (CORRIGÉ)
// ===================================================

echo "<h3 class='mt-4'>Ajouter des amis</h3>";
echo "<form method='POST' class='add-friend-form'>
    <div class='input-group mb-3'>
        <input type='text' class='form-control' placeholder='Entrez un matricule' name='matricule' required>
        <button class='btn btn-primary' type='submit' name='add_friend'>Envoyer la demande</button>
    </div>
</form>";

// Gestion de l'ajout d'ami
if (isset($_POST['add_friend'])) {
    $matricule = $_POST['matricule'] ?? '';
    
    if (!empty($matricule)) {
        // Trouver l'étudiant par matricule
        $stmt = $conn->prepare("SELECT id FROM etudiants WHERE matricule = ?");
        $stmt->bind_param("s", $matricule);
        $stmt->execute();
        $result = $stmt->get_result();
        $target = $result->fetch_assoc();
        
        if ($target) {
            $target_id = $target['id'];
            
            // Vérifier si la demande existe déjà
            $check = $conn->prepare("SELECT id FROM amis 
                                    WHERE (user_id = ? AND ami_id = ?)
                                    OR (user_id = ? AND ami_id = ?)");
            $check->bind_param("iiii", $user_id, $target_id, $target_id, $user_id);
            $check->execute();
            $check_result = $check->get_result();
            
            if ($check_result->num_rows == 0) {
                // Créer la demande d'amitié
                $insert = $conn->prepare("INSERT INTO amis (user_id, ami_id, statut) 
                                        VALUES (?, ?, 'en_attente')");
                $insert->bind_param("ii", $user_id, $target_id);
                $insert->execute();
                
                echo "<div class='alert alert-success'>Demande envoyée à $matricule</div>";
            } else {
                echo "<div class='alert alert-warning'>Relation déjà existante</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Aucun étudiant trouvé avec ce matricule</div>";
        }
    }
}

// ===================================================
// ÉTAPE 4 : AFFICHER LES DEMANDES EN ATTENTE (CORRIGÉ)
// ===================================================

$pending = $conn->query("
    SELECT e.id, e.nom, e.prenom, e.matricule, a.id as request_id 
    FROM amis a 
    JOIN etudiants e ON a.user_id = e.id 
    WHERE a.ami_id = $user_id AND a.statut = 'en_attente'
");

if ($pending && $pending->num_rows > 0) {
    echo "<h3 class='mt-4'>Demandes en attente</h3>";
    echo "<div class='pending-requests'>";
    
    while ($req = $pending->fetch_assoc()) {
        echo "
        <div class='request-card'>
            <div class='request-info'>
                <strong>{$req['prenom']} {$req['nom']}</strong> ({$req['matricule']})
            </div>
            <div class='request-actions'>
                <a href='handle_friend.php?action=accept&id={$req['request_id']}' class='btn btn-sm btn-success'>Accepter</a>
                <a href='handle_friend.php?action=reject&id={$req['request_id']}' class='btn btn-sm btn-danger'>Refuser</a>
            </div>
        </div>";
    }
    
    echo "</div>";
} else {
    echo "<p class='mt-4'>Aucune demande d'ami en attente</p>";
}

// Ajout du CSS pour une meilleure présentation
echo "
<style>
    .friends-list, .pending-requests {
        display: flex;
        flex-direction: column;
        gap: 15px;
        margin-bottom: 30px;
    }
    
    .friend-card, .request-card {
        display: flex;
        align-items: center;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background: white;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        transition: transform 0.2s;
    }
    
    .friend-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    .friend-photo {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
        border: 2px solid #eee;
    }
    
    .friend-info {
        flex: 1;
    }
    
    .friend-actions, .request-actions {
        margin-left: auto;
        display: flex;
        gap: 10px;
    }
    
    .add-friend-form {
        max-width: 600px;
        margin-bottom: 30px;
    }
    
    .alert {
        margin: 15px 0;
        padding: 10px 15px;
        border-radius: 5px;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
        border-color: #c3e6cb;
    }
    
    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border-color: #f5c6cb;
    }
    
    .alert-warning {
        background: #fff3cd;
        color: #856404;
        border-color: #ffeeba;
    }
    
    .alert-info {
        background: #d1ecf1;
        color: #0c5460;
        border-color: #bee5eb;
    }
</style>
";
?>