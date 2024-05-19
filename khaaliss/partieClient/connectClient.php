<?php ob_start(); ?> <!--Pour lancer l'enregitrement du contenu de cette page-->
<?php
session_start();
require_once "../classes/compte.php";
require_once "../classes/user.php";
require_once "../classes/client.php";
require_once "../Functions.php";
require_once "../connexion.php";
global $connect;

if(isset($_POST["envoyer"]) && isset($_POST["email"]) && isset($_POST["pwd"])){
    $email = correctValue($_POST["email"]);
    $pwd = correctValue($_POST["pwd"]);

    
    //on vérifie si l'utilisateur existe et s'il est actif dans la base de l'admin
    $rqt = $connect->prepare("SELECT * FROM addclient WHERE email = :email");
    $rqt->bindParam(":email",$email);
    $rqt->execute();
    $client = $rqt->fetch(PDO::FETCH_ASSOC);
    if($client){
        if($client["statut"] == "actif"){ //Si le client est actif , il peut se connecter
            echo " C'est bonnnnn";
             // Requête pour récupérer l'utilisateur en fonction de l'email
            $rqt = $connect->prepare("SELECT * FROM client WHERE email = :email");
            $rqt->bindParam(':email', $email);
            $rqt->execute();
            $user = $rqt->fetch(PDO::FETCH_ASSOC);

            if($user) {
                // Vérifier si le mot de passe soumis correspond au mot de passe stocké dans la base de données
                
                if(password_verify($pwd, $user['pwd'])) {
                    // Authentification réussie
                    $_SESSION['idClient'] = $user['id']; // Stocker l'ID de l'utilisateur dans la session
                    $nom = $user['nom'];
                    $prenom = $user['prenom'];
                    $email = $user['email'];
                    $numero = $user['numero'];
                    $pwd = $user['pwd'];
                    
                    
                    // Stocker les informations de l'utilisateur dans la session
                    $_SESSION['nom'] = $nom;
                    $_SESSION['prenom'] = $prenom;
                    $_SESSION['email'] = $email;
                    $_SESSION['numero'] = $numero;
                    $_SESSION['pwd'] = $pwd;

                    //recupérer idCompte
                    $rqt = $connect->prepare("SELECT id FROM compte WHERE idClient = :idClient");
                    $rqt->bindParam(':idClient', $_SESSION["idClient"]);
                    $rqt->execute();
                    $resultat = $rqt->fetch(PDO::FETCH_ASSOC);
                    if($resultat){
                        $_SESSION["idCompte"] = $resultat["id"];
                    } else {
                        echo "idCompte non trouvé";
                    }
                    
                    header("Location: bienvenueClient.php"); // Rediriger l'utilisateur vers la page d'accueil après l' authentification 
                    exit;
                }else {
                    // Mot de passe incorrect
                    echo "Mot de passe incorrect";
                }
            } else {
                // Utilisateur non trouvé avec cet email
                echo "Aucun utilisateur trouvé avec cet email";
                echo "<a href='inscription.php'>S'inscrire</a> <br>";
            } 

        }else{
            echo "Votre compte est inactif <br>";
            echo "Veuillez vous rendre à la banque pour l'activer";
        }

    }else{
        echo "Vous n'êtes pas inscrit à la banque<br>";
        echo "Veuillez vous rendre à la banque pour l'activer";
    }

   


}


?>

<div class="connexion"> 
        <fieldset>
            <legend>Se connecter</legend>
            <form action="connectClient.php" method="post" class="formulaire">
                <input type="text" name="email" placeholder="E-mail" required> <br>
                <input type="password" name="pwd" placeholder="Mot de passe" required> <br>
                <button type ="submit" name="envoyer" >Envoyer</button>
                <a href="inscription.php">S'inscrire</a> <br>
                <a href="../partieAdmin/connectAdmin.php">Je suis admin</a>
                
            </form>
        </fieldset>
        
    </div>

<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template2.php";
 ?>