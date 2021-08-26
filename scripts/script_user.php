<?php
require_once '../elements/auth.php';
is_connected();
require '../elements/conect_BDD.php';

$nameRegx = '/^[a-zA-Z]+$/';
if(isset($_POST['submit'])){
  $nom = $_POST["nom"];  
  $prenom = $_POST["prenom"];  
  $email = $_POST["email"]; 
  $password = $_POST["password"];
  $password_conf = $_POST["password-confirm"];

    if( preg_match($nameRegx, $nom) === 0 && strlen($nom) > 2 ){
    header('Location:../sign_up.php?error=nom');
    exit;
    }
    if( preg_match($nameRegx, $prenom) === 0 && strlen($prenom) > 2){
    header('Location:../sign_up.php?error=prenom');
    exit;
    }


    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        header('Location:../sign_up.php?error=email');
        exit;
    }

    if(strlen($password) < 8 ){
        header('Location:../sign_up.php?error=password');
        exit;
    }
    if($password !== $password_conf){
        header('Location:../sign_up.php?error=password-conformation');
        exit;
    }else{

        $password_hash = password_hash($password , PASSWORD_DEFAULT);
    }
    
    
    
    $req = $db->prepare('INSERT INTO users (nom , prenom, email, mot_de_pass) VALUES (:nom,:prenom,:email,:mot_de_pass)');
    $req->execute([
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'mot_de_pass' => $password_hash
    ]);
    
    $_SESSION['role'] = null;
    $_SESSION['login'] = $email;
     header('Location:../Tableau.php?success=signup');
}

?>