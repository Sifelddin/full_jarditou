<?php
session_start();

require '../elements/conect_BDD.php';

if(isset($_POST['submit'])){
   $password = $_POST['password'] ;
   $email = $_POST['email'];


   $req = $db->prepare("SELECT * FROM users where email = '$email' ");
   $req->execute();
   $user = $req->fetch();
if(!empty($user)){
        $id_user = $user->id;
        $mdp_user = $user->mot_de_pass;
    
   if( password_verify($password, $mdp_user) === true){
    $_SESSION['role'] = $user->role;
    $_SESSION['login'] = $email;
   
    header('Location:../products.php?login=success');
       
}else{
    
    header('Location:../forms/login.php?error=password');
    exit;
   }
   
}else{
    header('Location:../forms/login.php?error=email');
   exit;
}


}