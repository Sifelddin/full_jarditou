<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Accept, Authorization, X-Requested-With, X-Auth-Token, Origin, Application");
require './elements/conect_BDD.php';

$reqCat = $db->prepare("SELECT DISTINCT cat_nom,cat_id  FROM categories join produits on cat_id = pro_cat_id");
$reqCat->execute();
$cat_list = $reqCat->fetchAll();

echo json_encode($cat_list);