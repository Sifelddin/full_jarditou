<?php
require_once 'elements/auth.php';
require_once 'elements/conect_BDD.php';
date_default_timezone_set("Europe/Paris");
if(is_connected() === true){
    $login = $_SESSION['login'];
   
    $updateReq = $db->prepare("UPDATE users SET last_d_connect = :last_d_connect  WHERE email = '$login'");
    $updateReq->execute([
    'last_d_connect' => date("Y-m-d H:i:s")
]);

   unset($_SESSION['login']); 
   unset($_SESSION['role']); 
   header('Location:index.php');
}



