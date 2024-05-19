<?php ob_start(); ?> <!--Pour lancer l'enregitrement du contenu de cette page-->
<?php
session_start();
//CETTE PAGE NE SERA PAS ACCESSIBLE AUX CLIENTS


require_once "Functions.php";
require_once "connexion.php";
global $connect;


if(isset($_POST["envoyer"])){ //INSCRIPTION
    if(isset($_POST["name"])&& !empty($_POST["name"]) && isset($_POST["prenom"]) && !empty($_POST["prenom"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["numero"])&& !empty($_POST["pwd"]) && isset($_POST["pwd"])){
        $prenom = correctValue($_POST["prenom"]);
        $nom = correctValue($_POST["name"]);
        $email = correctValue($_POST["email"]);
        $numero = correctValue($_POST["numero"]);
        $pwd = correctValue($_POST["pwd"]);
        
        //STCKOCAGE DANS SESSIONS
        $_SESSION['prenom'] = $prenom;
        $_SESSION['nom'] = $nom;
        $_SESSION['email'] = $email;
        $_SESSION['numero'] = $numero;
        $_SESSION['pwd'] = $pwd;

        
        
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
                echo "Admin inséré avec succès";

                
            }else {
                echo "Erreur lors de l'ajout de l'admin";
            }
        }else {
            
            echo "Cet email a déjà un compte";
            
        
            
        }
            

       
    }else echo "Veuillez remplir tous les champs";
}
 //INSCRIPTION FIN


 

?>

 <div class="inscription"> 
        <fieldset>
            <legend>S'inscrire</legend>
            <form action="" method="post" class="formulaire">
                <input type="text" name="prenom" placeholder="Prenom" required> <br>
                <input type="text" name="name" placeholder="Nom" required> <br>
                <input type="text" name="email" placeholder="E-mail" required> <br>
                <input type="text" name="numero" placeholder="Numéro" required> <br>
                <input type="password" name="pwd" placeholder="Mot de passe" required> <br>
                <button type ="submit" name="envoyer" class="bouton">Envoyer</button>
                
            </form>
        </fieldset>
        
    </div>


<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template2.php";
 ?>