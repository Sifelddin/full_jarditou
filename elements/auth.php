<?php
function is_connected (): bool{
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }    
      
       
return !empty($_SESSION['login']);
}

function verify(){
    if(is_connected() === true){
       return true; 
    }
    return false;
}



?>