<?php ob_start(); ?> <!--Pour lancer l'enregitrement du contenu de cette page-->


<?php
session_start();

require_once "../Functions.php";
require_once "../connexion.php";
global $connect;
if(isset($_SESSION["idAdmin"])){
if(isset($_POST["envoyer"]) && isset($_POST["email"]) && isset($_POST["pwd"])){
    $email = correctValue($_POST["email"]);
    $pwd = correctValue($_POST["pwd"]);

    
    //on vérifie si l'utilisateur existe

    // Requête pour récupérer l'utilisateur en fonction de l'email
    $rqt = $connect->prepare("SELECT * FROM administrateur WHERE email = :email");
    $rqt->bindParam(':email', $email);
    $rqt->execute();
    $user = $rqt->fetch(PDO::FETCH_ASSOC);

    if($user) {
        // Vérifier si le mot de passe soumis correspond au mot de passe stocké dans la base de données
        
        if($user['pwd'] == $pwd) {
            // Authentification réussie
            // Détruire toutes les variables de session
            $_SESSION = array();
            session_destroy();
            header("Location: ../index.php"); // Rediriger l'utilisateur vers la page d'accueil 
            exit;
        }else {
            // Mot de passe incorrect
            echo "Mot de passe incorrect";
        }
    } else {
        // Utilisateur non trouvé avec cet email
        echo "Aucun admin trouvé avec cet email";
        
    }


}
}

?>

<div class="connexion"> 
        <fieldset>
            <legend>Se déconnecter</legend>
            <form action="" method="post" class="formulaire">
                <input type="text" name="email" placeholder="E-mail" required> <br>
                <input type="password" name="pwd" placeholder="Mot de passe" required> <br>
                <button type ="submit" name="envoyer" >Envoyer</button>
                
            </form>
        </fieldset>
        
    </div>



<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template3.php";
 ?>
