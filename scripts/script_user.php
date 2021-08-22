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

    if( preg_match($nameRegx, $nom) === 0){
    header('Location:../Contact.php?error=nom');
    exit;
    }
    if( preg_match($nameRegx, $prenom) === 0){
    header('Location:../Contact.php?error=nom');
    exit;
    }


    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        header('Location:../Contact.php?error=email');
        exit;
    }

    if(strlen($password) < 8 ){
        header('Location:../Contact.php?error=password');
        exit;
    }
    if($password !== $password_conf){
        header('Location:../Contact.php?error=password-conformation');
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