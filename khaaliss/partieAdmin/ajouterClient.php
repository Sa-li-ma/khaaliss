<?php ob_start(); ?> <!--Pour lancer l'enregitrement du contenu de cette page-->
<?php
session_start();



require_once "../classes/user.php";
require_once "../classes/client.php";
require_once "../Functions.php";
require_once "../connexion.php";
global $connect;

if(isset($_SESSION['idAdmin'])){
if(isset($_POST["envoyer"])){ //INSCRIPTION
    if(isset($_POST["name"])&& !empty($_POST["name"]) && isset($_POST["prenom"]) && !empty($_POST["prenom"]) && isset($_POST["email"]) && !empty($_POST["email"]) &&  !empty($_POST["statut"]) && isset($_POST["statut"])){
        $prenom = correctValue($_POST["prenom"]);
        $nom = correctValue($_POST["name"]);
        $email = correctValue($_POST["email"]);
        $statutt = correctValue($_POST["statut"]);
        $statut = strtolower($statutt);


        
        
        //REQUETE D'INSCRIPTION
        //preparation
        $maRequete = $connect->prepare("INSERT INTO addclient (prenom,nom,email,statut) VALUES (:prenom,:nom,:email,:statut)");

        //Liaison des paramètres
        $maRequete->bindParam(":prenom", $prenom);
        $maRequete->bindParam(":nom", $nom);
        $maRequete->bindParam(":email", $email);
        $maRequete->bindParam(":statut", $statut);

        //Verification si l'email a deja été utilisé
        $verification = $connect->prepare("SELECT COUNT(*) AS count FROM addclient WHERE email = :email");
        $verification->bindParam(":email",$email);
        $verification->execute();
        $resultat = $verification->fetch(PDO::FETCH_ASSOC);
        if($resultat["count"] == 0){
             //execution
        

            if($maRequete->execute()){
                echo "Client inséré avec succès";
               
                    
                
            
            }else {
                echo "Erreur lors de l'ajout du client";
            }
        }else {
            
            echo "Cet email a déjà un compte";

            
        
        }
            

       
    }else echo "Veuillez remplir tous les champs";
}
 //INSCRIPTION FIN


} 

?>
<div class="ajout"> 
        <fieldset>
            <legend>Ajouter un client</legend>
            <form action="" method="post" class="formulaire">
                <input type="text" name="prenom" placeholder="Prenom" required> <br>
                <input type="text" name="name" placeholder="Nom" required> <br>
                <input type="text" name="email" placeholder="E-mail" required> <br>
                <select name="statut" required>
                <option value="actif">Actif</option>
                <option value="inactif">Inactif</option>
                </select>
                <button type ="submit" name="envoyer" class="bouton">Envoyer</button>
                
            </form>
        </fieldset>
        
    </div>



<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template3.php";
 ?>
