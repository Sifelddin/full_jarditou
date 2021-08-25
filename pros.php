<?php 
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With, X-Auth-Token, Origin, Application");
require './elements/conect_BDD.php';

$req = $db->prepare("SELECT * FROM produits ");
$req->execute();
$rows = $req->fetchAll();


echo json_encode($rows);

