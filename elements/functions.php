<?php

$message_ref = null;
$message_libelle = null;
$message_prix = null;
$message_stock = null;
$message_photo = null;

function check_error_modif($arg){
    $id = $_GET["pro_id"];
    if(empty($_POST["$arg"])){
        header("Location:../forms/modif_form.php?pro_id=$id&error=$arg");
        exit;
     }
     return;
}


function check_error_ajout($arg){
   
    if(empty($_POST["$arg"])){
        header("Location:../forms/form_ajout.php?error=$arg");
        exit;
     }
     return;
}


if(isset($_GET["error"])){
    
    $error = $_GET["error"];
    if($error == "ref"){
        $message_ref = "ref champ est obligatoire !";     
    } if($error == "libelle"){ 
        $message_libelle = "libelle champ est obligatoire  !";
    } if($error == "prix"){  
        $message_prix = "prix champ est obligatoire !";
    }
    if($error == "stock"){  
        $message_stock = "stock champ est obligatoire !";
    }
     if($error == "photo"){  
        $message_photo = "photo champ est obligatoire !";
    }
}



function check_url ($regExp,$url){
   if (preg_match($regExp, $url) === 1){
       return true;
   }else{
      return false;
   }
}
