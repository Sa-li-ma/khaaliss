<?php ob_start(); ?> <!--Pour lancer l'enregitrement du contenu de cette page-->
<?php
session_start();


require_once "../classes/compte.php";
require_once "../classes/user.php";
require_once "../classes/Admin.php";
require_once "../classes/client.php";
require_once "../Functions.php";
require_once "../connexion.php";
global $connect;


if(isset($_POST["envoyer"])){ //INSCRIPTION
    if(isset($_POST["name"])&& isset($_POST["prenom"]) && isset($_POST["email"]) && isset($_POST["numero"])&& isset($_POST["pwd"])){
        $prenom = correctValue($_POST["prenom"]);
        $nom = correctValue($_POST["name"]);
        $email = correctValue($_POST["email"]);
        $numero = correctValue($_POST["numero"]);
        $pwd = correctValue($_POST["pwd"]);

        
        
        //REQUETE D'INSCRIPTION
        //preparation
        $maRequete = $connect->prepare("INSERT INTO administrateur (prenom,nom,email,numero,pwd) VALUES (:prenom,:nom,:email,:numero,:pwd)");

        //Liaison des paramètres
        $maRequete->bindParam(":prenom", $prenom);
        $maRequete->bindParam(":nom", $nom);
        $maRequete->bindParam(":email", $email);
        $maRequete->bindParam(":numero", $numero);
        $maRequete->bindParam(":pwd", $pwd);

        //Verification si l'email a deja été utilisé
        $verification = $connect->prepare("SELECT COUNT(*) AS count FROM administrateur WHERE email = :email");
        $verification->bindParam(":email",$email);
        $verification->execute();
        $resultat = $verification->fetch(PDO::FETCH_ASSOC);
        if($resultat["count"] == 0){
             //execution
        

            if($maRequete->execute()){
                echo "Administrateur inséré avec succès";

            $_SESSION["idAdmin"] = $connect->lastInsertId(); // pour récupérer l'ID inséré
            //JE stocke tout dans une session ***************************************
            $id = $_SESSION['idAdmin']; //on sauvegarde l'id
            header('Location: gestion.php'); //redirection
                exit;
                   
            } else {
                echo "Erreur lors de l'ajout de l'admin";
            }
            
        }else echo "Cet email a déjà un compte";

       
    }else echo "Veuillez remplir tous les champs";
} //INSCRIPTION FIN




?>







<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template.php";
 ?>
