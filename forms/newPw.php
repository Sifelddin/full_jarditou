<?php
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
   <h3>créer un nouveau mot de pass</h3> 
<br>
<form action="../scripts/newPw_script.php" method="POST">
<div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1"> nouveau mot de pass:</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">  confirmation mot de pass:</label>
    <input type="password" name="password-confirm" class="form-control" id="exampleInputPassword1" placeholder="Password-confirm">
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

