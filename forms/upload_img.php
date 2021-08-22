<?php
require "../elements/conect_BDD.php";
require "../elements/header.php";


$id = $_GET["pro_id"];


$req = $db->prepare("UPDATE produits SET pro_photo = :photo WHERE pro_id = $id");

if (isset($_POST["submit"])) {
    $file = $_FILES["fichier"];

    $fileName = $_FILES["fichier"]["name"];
    $fileTmpName = $_FILES["fichier"]["tmp_name"];
    $fileSize = $_FILES["fichier"]["size"];
    $fileError = $_FILES["fichier"]["error"];
    $fileType = $_FILES["fichier"]["type"];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));


    $allowed = ['jpg', 'jpeg', 'png'];
    if (in_array($fileActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
               try{
                $req->execute([
                   ":photo" => $fileActualExt
                ]);
            }catch (PDOException $e) {
                $error = $e->getMessage();
            }
            if ($error) {
                echo $error;
            } else {
            
                $fileNameNew = $id . "." . $fileActualExt;
                $fileDestination = '../jarditou_photos/' . $fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                header("Location:../tableau.php?upload=success ");
            }
            } else {
                echo "your file is too big!";
            }
        } else {
            echo 'there xas an error uploading your file';
        }
    } else {
        echo 'you can not upload files on this type';
    }
}
?>
<div class="container">
 
    <br>
    
    <form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
    <fieldset>
    <legend>ajouter une photo pour le produit si elle n'éxiste pas :</legend>
    <br>
        <div>
        <input  type="file" name="fichier">
         <input class="btn btn-primary" type="submit" name="submit" value="Enregistrer">
        </div>
        <br>
    </fieldset>
          <br>
          <br>
          
       
        <a href="delete.php?pro_id=<?= htmlentities($id)?>"><input class="px-4 mx-5 btn btn-danger" name="supprimer" value="Suppression"></a>
        <a href="details.php?pro_id=<?= htmlentities($id)?>"><input class="px-4 mx-5 btn btn-warning" name="details" value="details"></a>
        <a href="../tableau.php"><input class="px-4 mx-5 btn btn-secondary" name="submit" value="Routeur"></a>
    </div>
    </form>
</div>
<?php

require "../elements/footer.php";


?>


