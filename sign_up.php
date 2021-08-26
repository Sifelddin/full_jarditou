
<?php

$error = null;
if(isset($_GET['error'])){
  $error = $_GET['error'];
}
 require "./elements/header.php";
?>


    <main class="container">
        <div class="my-3 d-flex">
        <p>Si vous avez inscrit avant :
        <a href="login.php">Sign in</a></p>
        </div>
        <h3>Sign up </h3>
        <form action="scripts/script_user.php" method="POST">

        <p>* Ces zones sont obligatoires</p>
        
       <legend class="h4 ">Vos coordonnées</legend>
       <div class="form-group">
    <label for="name">Votre nom* : </label>
        <input class="form-control" type="text" id="name" name="nom"  placeholder="Le nom (minimum 3 caractères)" required> 
        <?php if($error !== null && $error === "nom") :?> 
            <small  class="text-danger">Le nom doit contenir  que des lettres !</small >
      <?php endif; ?>
    </div>
   <div class="form-group">
    <label for="prénom">Votre prénom* :  </label>
    <input class="form-control" type="text" id="prénom" name="prenom" placeholder="Le prenom (minimum 3 caractères)" required>
    <?php if($error !== null && $error === "prenom") :?> 
            <small  class="text-danger">Le prenom doit contenir  que des lettres !</small >
      <?php endif; ?>
    </div>

   
    <div class="form-group">
        <label for="email" >Email* :</label>
        <input id="email" class="form-control" type="email" name="email" placeholder="dave.loper@afpa.fr" required>
        <?php if($error !== null && $error === "email") :?> 
            <small  class="text-danger">Adresse email doit être en bon format!</small >
      <?php endif; ?>
   </div>
 

     <div class="form-group">
         <label>Mot de pass : </label>
         <input class="form-control" type="password" name="password" placeholder="Mot de pass (minimum 8 caractères)" required>
         <?php if($error !== null && $error === "password") :?> 
      <small  class="text-danger"> Mot de pass minimum 8 caractères !</small >
      <?php endif; ?>
     </div>
   
     <div class="form-group">
         <label>Confirmation  (Mot de pass) : </label>
         <input class="form-control" type="password" name="password-confirm" required>
         <?php if($error !== null && $error === "password-conformation") :?> 
      <small  class="text-danger"> Mot de pass Confirmation !</small >
      <?php endif; ?>
     </div>
   
   <button class="btn btn-primary mb-4" type="submit" name="submit" value="submit">Signe up</button>
   
</form>


</main>


<?php

require "./elements/footer.php";
?>