<?php ob_start(); ?> <!--Pour lancer l'enregitrement du contenu de cette page-->



<h2>Formulaire de Contact</h2>

<form action="" method="POST" class="formulaire"> 
    
    <input type="text" id="nom" name="nom" placeholder="Nom" required>
    <input type="email" id="email" name="email" placeholder="Adresse Email" required>
    <textarea class="textareaa" id="message" name="message" placeholder="Message" required></textarea>
    <button type="submit">Envoyer</button>
</form>


<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template2.php";
 ?>