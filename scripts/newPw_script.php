<?php
require_once '../elements/auth.php';
is_connected();
require '../elements/conect_BDD.php';


if(isset($_POST['submit'])){

    $email = $_POST['email'];
    $password = $_POST["password"];
    $password_conf = $_POST["password-confirm"];

    $req = $db->prepare("SELECT * from users where email ='$email'");
    $req->execute();
    $user = $req->fetch();

    if($user->email !== $email){
        header('Location:../forms/newPw.php?error=email');
        exit;
    }

    if(strlen($password) < 8 ){
        header('Location:../forms/newPw.php?error=password');
        exit;
    }
    if($password !== $password_conf){
        header('Location:../forms/newPw.php?error=password-conf');
        exit;
    }else{

        $password_hash = password_hash($password , PASSWORD_DEFAULT);
    }
   

    $updateReq = $db->prepare("UPDATE users SET mot_de_pass = :mot_de_pass WHERE email = '$email'");
    $updateReq->execute([
        'mot_de_pass' => $password_hash
    ]);

    $_SESSION['login'] = $email;
    header('Location:../tableau.php?success=mdpchange');

    
}



