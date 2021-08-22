<?php
require_once 'elements/auth.php';
var_dump(is_connected());


if (is_connected() === false) {
  header('Location:sign_up.php');
  exit;
}
if ( $_SESSION['role'] !== 'admin') {
  header('Location:products.php');
  exit;
}

require "./elements/conect_BDD.php";
require "./elements/header.php";


try {
  if (isset($_POST['recherche'])) {
    $reherche = $_POST['recherche'];
    $req = $db->prepare("SELECT * FROM produits WHERE pro_libelle LIKE '$reherche%'  ");
    $req->execute();
  } else {
    $req = $db->prepare("SELECT * FROM produits");
    $req->execute();
  }
  $objs_dai = $req->fetchAll();
} catch (PDOException $e) {
  $error = $e->getMessage();
}

?>

<?php if ($error) : ?>
  <?= $error ?>
<?php else : ?>


  <div class="container">
    <div class = "d-flex justify-content-between py-5 ">


      <a href="./forms/form_ajout.php"><input class="mx-auto px-4 mx-5 btn btn-danger" name="ajouter" value="Ajouter un produit"></a>
     
      
      <h4>tous les produits</h4>
      <form action="" method="POST" class="form-inline mt-2 mt-md-0">
                <input class="form-control mr-sm-2" type="text" name="recherche" placeholder="nom du produit (libellé)" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
              </form>
    
     
    </div>

    
    <?php if (count($objs_dai) === 0) : ?>

      <div class="p-5 alert alert-danger text-center">
        <h2>le produit que vous avez recherché n'existe pas dans la liste </h2>
        <a href="tableau.php"><input class="fs-3 m-5 px-4 mx-5 btn btn-secondary" name="routeur" value="routeur"></a>
      </div>

    <?php else : ?>
      <div class="table-responsive-md">



        <table class="table table-bordered table-sm">
          <thead class="bg-light h5 display-5">
            <tr class="text-center">
              <th>photos</th>
              <th>ID</th>
              <th>référence</th>
              <th>Libellé</th>
              <th>Prix</th>
              <th>stock</th>
              <th>Couleur</th>
              <th>Ajout</th>
              <th>Modif</th>
              <th>Bloqué</th>
            </tr>
          </thead>
          <tbody class="table-hover">

            <?php foreach ($objs_dai as  $val) : ?>           
              <tr class="table-warning text-center ">
                <td class="align-middle"><img style="max-width: 140px;" class="img-responsive img-fluid" src="./jarditou_photos/<?=$val->pro_id?>.<?=$val->pro_photo ?>" alt="<?=$val->pro_id?>.<?=$val->pro_photo ?>"></td>
                <td class="align-middle"><?= $val->pro_id ?></td>
                <td class="align-middle"><?= $val->pro_ref ?></td>
                <td class="align-middle"><strong>
                 <a class="text-danger" href= "./forms/details.php?pro_id=<?= $val->pro_id ?>"><?= $val->pro_libelle ?></strong></a></td>
                <td class="align-middle"><?= $val->pro_prix . " €" ?></td>
                <td class="align-middle"><?= $val->pro_stock ?></td>
                <td class="align-middle"><?= $val->pro_couleur ?></td>
                <td class="align-middle"><?= $val->pro_d_ajout ?></td>
                <td class="align-middle"><?= $val->pro_d_modif ?></td>
                <td class="align-middle"><?php if($val->pro_bloque == 0 || $val->pro_bloque == NULL){echo "non";}else{echo "oui";}?></td>
              </tr>
            <?php endforeach ?>



          </tbody>
        </table>

      </div>
    <?php endif ?>

  </div>




<?php endif ?>
<?php
require "./elements/footer.php";

?>