<?php 
require_once 'db.php';
require_once 'functions.php';

session_start();

if (!isset($_SESSION['user_id'])){

    $_SESSION['error']="Vous devez etre conecté pour créer un post";
    header("location: connexion.php");
    exit();
}
if($_SESSION['REQUEST_METHOD']==='POST' && isset($_POST['create_post'])){
    $user_id=$_SESSION['id'];
    $content= sanitize_input($_POST['content']);

// upload file handling
$file_path=null;
if(isset($_FILES['post_file']) && $_FILES['post_file']['error'] == 0){
    $upload_result = upload_file($_FILES['post_file'], 'mixed');
    if($upload_result['success']){
        $file_path = $upload_result['file_name'];
    } else{
        $_SESSION['error']=$upload_result['error'];
        header("Location: index.php");
        exit();
    }
}

// how to insert post in the data base
$sql = "INSERT INTO posts (user_id, content, file_path) VALUES (?, ?, ?)";
$stmt= mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "iss" , $user_id, $content, $file_path);

if(mysqli_stmt_execute($stmt)){
    $_SESSION['success'] = "Post créé avec succès! ( Weldone ) !";
} else{
    $_SESSION['error'] = "Erreur lors de la création du post : ( Please go and check back )" . mysqli_error($conn);

}
}
 header("Location: index.php");
 exit();
 ?>