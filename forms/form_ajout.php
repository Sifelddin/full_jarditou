<?php
require "../elements/functions.php";
require "../elements/conect_BDD.php";
require "../elements/header.php";

try {
    $req = $db->query("SELECT DISTINCT cat_nom ,cat_id  FROM produits JOIN categories ON cat_id = pro_cat_id");
    $all_rows = $req->fetchAll();
} catch (PDOException $e) {
    $error = $e->getMessage();
}
if ($error) {
    echo $error;
    exit();
}
?>



<div class="container">
<br><br>
    <h2>formulaire d'ajout d'un produit</h2>
    <br>
    <form action="../scripts/script_ajout.php" method="POST">
        <div class="form-group">

            <div>
                <label>Catégorie :</label><br>
                <select class="form-control" name="cat_id">
                    <?php foreach ($all_rows as $one_row) : ?>
                        <option value="<?= $one_row->cat_id ?>"><?= $one_row->cat_nom ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <br>
            <div>
                <label>"pro_ref" - Référence produit :</label><br>
                <input class="form-control" type="text" value="" name="ref">
                <small  class="text-danger"><?=$message_ref ?></small >
            </div>
            <br>


            <div>
                <label>"pro_libelle"- Nom du produit :</label><br>
                <input class="form-control" type="text" value="" name="libelle">
                <small  class="text-danger"><?=$message_libelle ?></small >
            </div>

            <br>
            <div>
                <label>"pro_description"- Description du produit :</label><br>
                <textarea class="form-control" name="description" id="" cols=ly></textarea>
            </div>

            <br>
            <div>
                <label>"pro_prix"- Prix :</label><br>
                <input class="form-control" type="text" value="" name="prix">
                <small  class="text-danger"><?=$message_prix ?></small >
            </div>

            <br>
            <div>
                <label>"pro_stock"- Nombre d'unités en Stock :</label><br>
                <input class="form-control" type="number" value="" name="stock">
                <small  class="text-danger"><?=$message_stock ?></small >
            </div>

            <br>
            <div>
                <label>"pro_couleur"- Couleur :</label><br>
                <input class="form-control" type="text" value="" name="couleur">
            </div>

            <br>
           

          
            <div>
                <label>"pro_d_ajout"- Date d'ajout :</label><br>
                <input class="form-control" type="date" value="" name="date-Ajout" readonly>
            </div>

            <br>
            <div>
                <label>"pro_d_modif"- Date de modification :</label><br>
                <input class="form-control" type="date" value="" name="date-modif" readonly>
            </div>

            <br>
            <div>
                <label>"pro_bloque" Bloquer le produit à la vente :</label><br>
                <input class="form-control" type="number" value="" name="pro-bloque">
            </div>
            <br>
            <input type="submit" class="btn btn-success" name="submit" value="Ajouter">
            <a href="../tableau.php"><input class="btn btn-secondary" name="routeur" value="Routeur"></a>
        </div>
    </form>
</div>







<?php

require "../elements/footer.php";
?>