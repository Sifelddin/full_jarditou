<?php
$error = null;
if(isset($_GET['error'])){
  $error = $_GET['error'];
  
}

require 'elements/header.php';
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
   <h3>formulaire de connection</h3> 
<br>
<form action="scripts/login_script.php" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Email adresse</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Votre email ">
    <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre e-mail avec quelqu'un d'autre .</small>
    <?php if($error !== null && $error === "email") :?> 
      <small  class="text-danger">Adresse email doit être en bon format!</small >
      <?php endif; ?>
    <?php if($error !== null && $error === "emailval") :?> 
      <small  class="text-danger">Adresse email n'est pas valide!</small >
      <?php endif; ?>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de pass (minimum 8 caractères)">
    <?php if($error !== null && $error === "password") :?> 
      <small  class="text-danger">Mot de pass erroné !</small >
      <?php endif; ?>
  </div>
  <div class="my-3 d-flex">
        <p> vous avez oublier :
        <a href="forms/newPw.php">Mot de passe oublié</a></p>
        </div>
  <button type="submit" name="submit" class="btn btn-primary">Submit</button>

</form>
<br>
</div>
</body>
</html>

<?php
require 'elements/footer.php';
?>

