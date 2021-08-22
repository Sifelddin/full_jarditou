
<?php

require "../elements/functions.php";
require "../elements/conect_BDD.php";


try {
    if (isset($_POST["submit"])) {

        check_error_ajout("ref");
        check_error_ajout("libelle");
        check_error_ajout("prix");
        check_error_ajout("stock");
      

        $categorie = $_POST["cat_id"];
        $ref = $_POST['ref'];
        $libelle = $_POST['libelle'];
        $description = $_POST['description'];
        $prix = $_POST['prix'];
        $stock = $_POST['stock'];
        $couleur = $_POST['couleur'];
        $date_ajout = $_POST['date-Ajout'];
        $date_modif = $_POST['date-modif'];
        $pro_bloque = $_POST['pro-bloque'];



        $request = $db->prepare('INSERT INTO produits (pro_cat_id,pro_ref,pro_libelle,pro_description,pro_prix,pro_stock,pro_couleur,pro_photo,pro_d_ajout,pro_d_modif,pro_bloque)
         VALUES (:pro_cat_id,:pro_ref,:pro_libelle,:pro_description,:pro_prix,:pro_stock,:pro_couleur,:pro_photo,:pro_d_ajout,:pro_d_modif,:pro_bloque)');
        $request->execute([
            'pro_cat_id' => $categorie,
            'pro_ref' => $ref,
            'pro_libelle' => $libelle,
            'pro_description' => $description,
            'pro_prix' => $prix,
            'pro_stock' => $stock,
            'pro_couleur' => $couleur,
            'pro_photo' => NULL,
            'pro_d_ajout' => date("Y-m-d H:i:s"),
            'pro_d_modif' => NULL,
            'pro_bloque' => $pro_bloque
        ]);

        $req_id = $db->prepare("SELECT pro_id from produits
         where  pro_cat_id = :categorie AND pro_ref = :ref AND pro_libelle = :libelle
          AND pro_description = :_description AND  pro_prix = :prix AND pro_stock = :stock AND pro_couleur = :couleur
          AND pro_bloque = :bloque");
        $req_id->execute([
            'categorie' => $categorie,
            'ref' => $ref,
            'libelle' => $libelle,
            '_description' => $description,
            'prix' => $prix,
            'stock' => $stock,
            'couleur' => $couleur,
            'bloque' => $pro_bloque
        ]);
        $row = $req_id->fetch(); 

    }
} catch (PDOException $e) {
    $error = $e->getMessage();
}
if ($error) {
    echo $error;
} else {
  header("Location:../forms/upload_img.php?pro_id=$row->pro_id");
}
