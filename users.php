<?php
require_once 'elements/auth.php';
var_dump(is_connected());


if (is_connected() === false) {
    header('Location:sign_up.php');
    exit;
}
if ($_SESSION['role'] !== 'admin') {
    header('Location:products.php');
    exit;
}

require "./elements/conect_BDD.php";
require "./elements/header.php";


try {
 
        $req = $db->prepare("SELECT * FROM users");
        $req->execute();
    
    $objs_dai = $req->fetchAll();
}catch (PDOException $e) {
    $error = $e->getMessage();
}

?>

<?php if ($error) : ?>
    <h1><?= $error ?></h1>
<?php endif; ?>


    <div class="container">

            <div class="table-responsive-md">



                <table class="table table-bordered table-sm">
                    <thead class="bg-light h5 display-5">
                        <tr class="text-center">
                            
                            <th>ID</th>
                            <th>nom</th>
                            <th>prenom</th>
                            <th>email</th>
                            <th>date d'inscription</th>
                            <th>dernière connection</th>
                            <th>role</th>         
                        </tr>
                    </thead>
                    <tbody class="table-hover">

                        <?php foreach ($objs_dai as  $val) : ?>
                            <tr class="table-warning text-center ">
                            
                                <td class="align-middle"><?= $val->user_id ?></td>
                                <td class="align-middle"><?= $val->nom ?></td>
                                <td class="align-middle"><?= $val->prenom ?></td>
                                <td class="align-middle"><?= $val->email ?></td>
                                <td class="align-middle"><?= $val->date_inscription ?></td>
                                <td class="align-middle"><?= $val->last_d_connect ?></td>
                                <td class="align-middle"><?= $val->role ?></td>
                            </tr>
                        <?php endforeach ?>



                    </tbody>
                </table>

            </div>
      

    </div>





<?php
require "./elements/footer.php";

?>