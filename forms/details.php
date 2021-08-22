<?php
require "../elements/conect_BDD.php";
require "../elements/header.php";


if (isset($_GET["pro_id"])) {
    $id = $_GET["pro_id"];
    try {
        $request = $db->prepare("SELECT * FROM produits JOIN categories ON cat_id = pro_cat_id WHERE pro_id = :id");
        $request->execute([
            "id" => $id
        ]);
        $row = $request->fetch();
        $request2 = $db->query("SELECT DISTINCT cat_nom FROM produits JOIN categories ON cat_id = pro_cat_id");
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
<br>
    <form action="modif_form.php" method="POST">
        <div class="form-group">
            <img style="width: 250px;" class="img-responsive img-fluid rounded mx-auto d-block" src="../jarditou_photos/<?=$row->pro_id?>.<?=$row->pro_photo?>" alt="">
            <div>
                <label>Référence :</label><br>
                <input class="form-control" type="text" value="<?= htmlentities($row->pro_ref) ?>" readonly name="ref">
            </div>
            <br>

            <div>
                <label>Catégorie :</label><br>
                <select class="form-control" name="categoris" readonly>
                    <option value="<?= htmlentities($row->cat_nom) ?>" readonly><?= htmlentities($row->cat_nom) ?></option>
                    <?php foreach ($all_rows as $one_row) : ?>
                        <option value="<?= htmlentities($one_row->cat_nom) ?>"><?= htmlentities($one_row->cat_nom) ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <br>

            <div>
                <label for="libellé_for_label">Libellé :</label><br>
                <input class="form-control" type="text" value="<?= htmlentities($row->pro_libelle) ?>" name="libelle" id="libellé_for_label" readonly>
            </div>

            <br>
            <div>
                <label>Description :</label><br>
                <textarea class="form-control" name="description" cols="10" rows="3" readonly><?= htmlentities($row->pro_description) ?></textarea>
            </div>

            <br>
            <div>
                <label for="prix_for_label">Prix :</label><br>
                <input class="form-control" type="text" value="<?= htmlentities($row->pro_prix) ?>" name="prix" id="prix_for_label" readonly>
            </div>

            <br>
            <div>
                <label for="stock_for_label">Stock :</label><br>
                <input class="form-control" type="text" value="<?= htmlentities($row->pro_stock) ?>" name="stock" id="stock_for_label" readonly>
            </div>

            <br>
            <div>
                <label for="couleur_for_label">Couleur :</label><br>
                <input class="form-control" type="text" value="<?= htmlentities($row->pro_couleur) ?>" name="couleur" id="couleur_for_label" readonly>
            </div>

            <br>


            <label for="">Produit Bloqué :</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="produitbloque" id="inlineRadio1" value="oui" readonly <?php if ($row->pro_bloque !== NULL || $row->pro_bloque != 0) {
                                                                                                                                    echo "checked";
                                                                                                                                }  ?>>
                    <label class="form-check-label" for="inlineRadio1">oui</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="produitbloque" id="inlineRadio2" value="non" readonly <?php if ($row->pro_bloque === NULL || $row->pro_bloque === 0) {
                                                                                                                                    echo "checked";
                                                                                                                                }  ?>>
                    <label class="form-check-label" for="inlineRadio2">non</label>
                </div>
            </div>

            <br>
            <div>
                <label for="ajout_for_label">Date d'ajout :</label><br>
                <input class="form-control" type="text" value="<?= htmlentities($row->pro_d_ajout) ?>" name="date_ajout" id="ajout_for_label" readonly>
            </div>
            <br>
            <div>
                <label for="modif_for_label">Date de modification :</label><br>
                <input class="form-control" type="text" value="<?= htmlentities($row->pro_d_modif) ?>" name="date_modif" id="modif_for_label" readonly>
            </div>
            <br>
        </div>

        <a href="../tableau.php"><input class="px-4 mx-2 btn btn-secondary" name="submit" value="Routeur"></a>
        <a href="delete.php?pro_id=<?= htmlentities($row->pro_id) ?>"><input class="px-4 mx-2 btn btn-danger" name="supprimer" value="Suppression"></a>
        <a href="modif_form.php?pro_id=<?= htmlentities($row->pro_id) ?>"><input class="px-4 mx-2 btn btn-warning" name="modifier" value="Modification"></a>
        <a href="upload_img.php?pro_id=<?= htmlentities($row->pro_id) ?>"><input class="px-4 mx-2 btn btn-primary" name="ajout_img" value="ajout_img"></a>

    </form>
    <br>
    <br>
</div>
<?php
require "../elements/footer.php";
?>