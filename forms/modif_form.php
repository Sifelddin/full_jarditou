<?php






require "../elements/functions.php";
require "../elements/conect_BDD.php";
require "../elements/header.php";

if (isset($_GET["pro_id"])) {

    $id = $_GET["pro_id"];
    try {
        $req = $db->query("SELECT * FROM produits JOIN categories ON cat_id = pro_cat_id WHERE pro_id = $id");
        $row = $req->fetch();
        $request2 = $db->query("SELECT DISTINCT cat_nom ,cat_id  FROM produits JOIN categories ON cat_id = pro_cat_id");
        $all_rows = $request2->fetchAll();
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
    if ($error) {
        echo $error;
        exit();
    }
}

?>



<div class="container">

    <form action="../scripts/script_modif.php?pro_id=<?= htmlentities($row->pro_id) ?>" method="POST">
        <div class="form-group">
            <img style="width: 250px;" class="img-responsive img-fluid rounded mx-auto d-block" src="../jarditou_photos/<?= $row->pro_id ?>.jpg" alt="">
            <div>
                <label>ID :</label><br>
                <input class="form-control" type="text" value="<?= htmlentities($row->pro_id) ?>" name="ID" readonly>
            </div>
            <br>
            <div>
                <label>Référence :</label><br>
                <input class="form-control" type="text" value="<?= htmlentities($row->pro_ref) ?>" name="ref">
                <small  class="text-danger"><?=$message_ref ?></small >
            </div>
            <br>


            <div>
                <label>Catégorie :</label><br>
                <select class="form-control" name="cat_id">
                    <option value="<?= htmlentities($row->cat_id) ?>"><?= htmlentities($row->cat_nom) ?></option>
                    <?php foreach ($all_rows as $one_row) : ?>
                        <option value="<?= htmlentities($one_row->cat_id) ?>"><?= htmlentities($one_row->cat_nom) ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <br>

            <div>
                <label>Libellé :</label><br>
                <input class="form-control" type="text" value="<?= htmlentities($row->pro_libelle) ?>" name="libelle">
                <small  class="text-danger"><?=$message_libelle?></small >
            </div>

            <br>
            <div>
                <label>Description :</label><br>
                <textarea class="form-control" name="description" id="" cols="10" rows="3"><?= htmlentities($row->pro_description) ?></textarea>
            </div>

            <br>
            <div>
                <label>Prix :</label><br>
                <input class="form-control" type="text" value="<?= htmlentities($row->pro_prix) ?>" name="prix">
                <small  class="text-danger"><?=$message_prix?></small >
            </div>

            <br>
            <div>
                <label>Stock :</label><br>
                <input class="form-control" type="text" value="<?= htmlentities($row->pro_stock) ?>" name="stock">
                <small  class="text-danger"><?=$message_stock?></small >
            </div>

            <br>
            <div>
                <label>Couleur :</label><br>
                <input class="form-control" type="text" value="<?=htmlentities($row->pro_couleur)?>" name="couleur">
            </div>

            <br>
      
          


            <label for="">Produit Bloqué :</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="produitbloque" id="inlineRadio1" value="oui" <?php if ($row->pro_bloque !== NULL) {
                                                                                                                        echo "checked";
                                                                                                                    }  ?>>
                    <label class="form-check-label" for="inlineRadio1">oui</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="produitbloque" id="inlineRadio2" value="non" <?php if ($row->pro_bloque === NULL) {
                                                                                                                        echo "checked";
                                                                                                                    }  ?>>
                    <label class="form-check-label" for="inlineRadio2">non</label>
                </div>
            </div>

            <br>
            <div>
                <label>Date d'ajout :</label><br>
                <input class="form-control" type="text" value="<?= htmlentities($row->pro_d_ajout) ?>" name="date_ajout" readonly>
            </div>
            <br>
            <div>
                <label>Date de modification :</label><br>
                <input class="form-control" type="text" value="<?= htmlentities($row->pro_d_modif) ?>" name="date_modif" readonly>
            </div>
            <br>
        </div>

        <a href="../tableau.php"><input class="px-4 mx-5 btn btn-secondary" name="submit" value="Routeur"></a>
        <input class="px-4 mx-5 btn btn-danger" type="submit" name="Enregistrer" value="Enregistrer">

    </form>
    <br>
    <br>
</div>
<?php
require "../elements/footer.php";
?>