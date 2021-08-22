
<?php
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
        <input class="form-control" type="text" id="name" name="nom" required> 
    </div>
   <div class="form-group">
    <label for="prénom">Votre prénom* :  </label>
    <input class="form-control" type="text" id="prénom" name="prenom" required>
    </div>

   
    <div class="form-group">
        <label for="email" >Email* :</label>
        <input id="email" class="form-control" type="email" name="email" placeholder="dave.loper@afpa.fr" required>
   </div>
 

     <div class="form-group">
         <label>Mot de pass : </label>
         <input class="form-control" type="password" name="password" required>
     </div>
   
     <div class="form-group">
         <label>Confirmation de Mot de pass : </label>
         <input class="form-control" type="password" name="password-confirm" required>
     </div>
   
   <button class="btn btn-primary mb-4" type="submit" name="submit" value="submit">Signe up</button>
   
</form>


</main>


<?php

require "./elements/footer.php";
?>