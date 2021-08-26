<?php
$error = null;
if(isset($_GET['error'])){
  $error = $_GET['error'];
  
}
require '../elements/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
    <div class="container">
      <br>
   <h3> Nouveau mot de pass:</h3> 
<br>
<form action="../scripts/newPw_script.php" method="POST">
<div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Votre email">
    <?php if($error !== null && $error === "email") :?> 
            <small  class="text-danger">Adresse email doit être en bon format!</small >
      <?php endif; ?>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1"> Nouveau mot de pass:</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Nouveau mot de pass (minimum 8 caractères)">
    <?php if($error !== null && $error === "password") :?> 
      <small  class="text-danger"> Mot de pass Confirmation !</small >
      <?php endif; ?>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">  Confirmation (mot de pass):</label>
    <input type="password" name="password-confirm" class="form-control" id="exampleInputPassword1" >
    <?php if($error !== null && $error === "password-conformation") :?> 
      <small  class="text-danger"> Mot de pass Confirmation !</small >
      <?php endif; ?>
  </div>
  <br>
  <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>

</form>
<br>
</div>
</body>
</html>

<?php
require '../elements/footer.php';
?>

