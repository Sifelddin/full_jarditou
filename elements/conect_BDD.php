<?php

$user = "root";
$motPass = "";
$error=NULL;
$db = new PDO('mysql:host=localhost;dbname=jarditou;charset=utf8',$user,$motPass,[
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);

?>