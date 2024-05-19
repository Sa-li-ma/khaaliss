<?php ob_start(); ?> <!--Pour lancer l'enregitrement du contenu de cette page-->


<div class="inscription"> 
        <fieldset>
            <legend>S'inscrire</legend>
            <form action="acClient.php" method="post" class="formulaire">
                <input type="text" name="prenom" placeholder="Prenom" required> <br>
                <input type="text" name="name" placeholder="Nom" required> <br>
                <input type="text" name="email" placeholder="E-mail" required> <br>
                <input type="text" name="numero" placeholder="Numéro" required> <br>
                <input type="password" name="pwd" placeholder="Mot de passe" required> <br>
                <button type ="submit" name="envoyer" class="bouton">Envoyer</button>
                <a href="connectClient.php">connexion</a> <br>
                <a href="../partieAdmin/connectAdmin.php">Je suis admin</a>
            </form>
        </fieldset>
        
    </div>


<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template2.php";
 ?>