<?php
require "../elements/conect_BDD.php";

try {
    if (isset($_GET["pro_id"])) {
        $id = $_GET["pro_id"];
        $request = $db->prepare("DELETE  FROM produits WHERE pro_id=:pro_id");
        $request->execute([
            ":pro_id" => $id
        ]);
    }
} catch (PDOException $e) {
    $error = $e->getMessage();
}
if ($error) {
    echo $error;
} else {
    header("Location:../tableau.php");
}
