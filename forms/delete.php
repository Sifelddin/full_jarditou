<?php
require "../elements/conect_BDD.php";
require "../elements/header.php";

if (isset($_GET["pro_id"])) {
    $id = $_GET["pro_id"];
    $request = $db->prepare("SELECT * FROM produits WHERE pro_id= :id");
    $request->execute([
        "id" => $id
    ]);
    $row = $request->fetch();
}
?>


<div class="d-flex flex-column align-items-center  container">
    <img style="width: 350px;" class="img-responsive img-fluid rounded mx-auto d-block" src="../jarditou_photos/<?=$row->pro_id?>.jpg" alt="">
    <div class="text-center">
        <h1><?= $row->pro_libelle ?></h1>
        <h2>êtes vous sûr de vouloir supprimer <br> "<?=htmlentities($row->pro_libelle) ?> " de la base de données ? </h2>
    </div>
    <br><br>
    <div>

        <a href="../scripts/script_delete.php?pro_id=<?= $row->pro_id ?>"><input class="px-3 mx-5 btn btn-danger" name="supprimer" value="Supprimer"></a>
        <a href="../forms/details.php?pro_id=<?= $row->pro_id ?>"><input class="px-3 mx-5 btn btn-success" name="supprimer" value="Anuller"></a>

    </div>
    <br><br>
</div>



<?php
require "../elements/footer.php";
?>