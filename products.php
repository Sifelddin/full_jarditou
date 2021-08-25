<?php
require "./elements/conect_BDD.php";
require "./elements/header.php";
$page = $_GET['page'] ?? 1;

if(!filter_var($page,FILTER_VALIDATE_INT)){
  throw new Exception("Numéro de la page invalide ! ");
}

if($page === '1'){
  header("Location:$self_path");
  exit;
}

$current_page = (int)$page;
if ($current_page <= 0) {
  throw new Exception("Numéro de la page invalide ! ");
}

$count = $db->prepare("SELECT count(pro_id) from produits");
$count->execute();
$count_products = (int)$count->fetch(PDO::FETCH_NUM)[0];

$in_page = 4;

$pages = ceil($count_products / $in_page);
if ($current_page > $pages) {
  throw new Exception("cette page n\'éxiste pas ! ");
}
$offset = $in_page * ($current_page - 1);

try {
  
  if (isset($_POST['recherche'])) {
    $reherche = $_POST['recherche'];
    $req = $db->prepare("SELECT * FROM produits WHERE pro_libelle LIKE '$reherche%' limit $in_page OFFSET $offset");
    $req->execute();
  } else {
    $req = $db->prepare("SELECT * FROM produits limit $in_page OFFSET $offset");
    $req->execute();
  }
  $objs_dai = $req->fetchAll();
} catch (PDOException $e) {
  $error = $e->getMessage();
}
if ($error) {
  echo $error;
  die;
}
?>

<div class="container ">
  <div class="d-flex justify-content-between py-5 ">
    <h4>tous les produits</h4>
    <form action="" method="POST" class="form-inline mt-2 mt-md-0">
      <input class="form-control mr-sm-2" type="text" name="recherche" placeholder="nom du produit (libellé)" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
    </form>
  </div>


  <div class="container-fluid d-flex ">
    <div class="container-fluid col-9 d-flex justify-content-start  flex-wrap ">
      <?php if (count($objs_dai) === 0) : ?>

        <div class="p-5 alert alert-danger text-center">
          <h2>le produit que vous avez recherché n'existe pas dans la liste </h2>
          <a href="products.php"><input class="fs-3 m-5 px-4 mx-5 btn btn-secondary" name="routeur" value="routeur"></a>
        </div>

      <?php else : ?>
        <?php foreach ($objs_dai as $val) : ?>


          <div class="col-sm-5 border border-info my-2 mx-3 ">
            <div class=" d-flex justify-content-between align-items-center my-1 ">
              <img id="p_img" style="max-width: 150px;" class="img-responsive img-fluid" src="./jarditou_photos/<?= $val->pro_id ?>.<?= $val->pro_photo ?>" alt="<?= $val->pro_id ?>.<?= $val->pro_photo ?>">
              <div>
                <h5 id="libelle" class="text-centre"><?= $val->pro_libelle ?></h5>
                <br>
                <p id="prix" class="text-centre"><?= $val->pro_prix . " €" ?></p>
                <?php  if (verify()):
                ?>
                <button id="btn" class="btn btn-outline-success" value="<?= $val->pro_id ?>">Ajouter</button>
                <?php  endif; 
                ?>
              </div>
            </div>
            <p>discription:<br><small><?= $val->pro_description ?></small></p>
          </div>
        <?php endforeach; ?>


      <?php endif ?>

    </div>
    <?php if (verify()):
    ?>
    <div id="panier" class="container col-3 border border-info">
      <h5>votre panier:</h5>
      <table class="table table-bordered table-sm">

        <tbody id="tbody" class="table">
        </tbody>

      </table>
    
      <button id="delete" class="btn btn-outline-danger" value="<?= $val->pro_id ?>">supprimer</button>

    </div>
    <?php endif; 
    ?>
  </div>
  <div class="d-flex justify-content-between my-3 ">
    <?php if ($current_page > 1) : ?>
      <?php
      $link = $self_path;
        if($current_page > 2) $link .= '?page=' . ($current_page - 1); 
        ?>
      <a class="btn btn-primary" href="<?=$link?>">< page précédente</a>
    <?php endif; ?>
    <?php if ($current_page < $pages) : ?>
      <a class="btn btn-primary ml-auto" href="<?=$self_path?>?page=<?= ($current_page + 1)?>"> page suivante ></a>
    <?php endif; ?>
  </div>

</div>




<?php
require "./elements/footer.php";

?>