<?php ob_start(); ?> <!--Pour lancer l'enregitrement du contenu de cette page-->
<?php
session_start();


require_once "../classes/compte.php";
require_once "../classes/user.php";
require_once "../classes/client.php";
require_once "../Functions.php";
require_once "../connexion.php";
global $connect;


if(isset($_POST["envoyer"])){ //INSCRIPTION
    if(isset($_POST["name"])&& !empty($_POST["name"]) && isset($_POST["prenom"]) && !empty($_POST["prenom"]) && isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["numero"])&& !empty($_POST["pwd"]) && isset($_POST["pwd"])){
        $prenom = correctValue($_POST["prenom"]);
        $nom = correctValue($_POST["name"]);
        $email = correctValue($_POST["email"]);
        $numero = correctValue($_POST["numero"]);
        $pwdd = correctValue($_POST["pwd"]);
        $pwd = password_hash($pwdd, PASSWORD_DEFAULT);
        //.......................................................................
        /*Pour vérifier si une première inscription du client a été faite par un employer de la banque s'il a déjà été inscrit, nom email doit se trouver dans la tables addClient.
        Sachant que la table addClient contient les clients de la banque qui ont élé inscrits par un admin. Cette table contient également leur etat (actif ou non) cela dépend de la gestion de l'admin */
        
        $rqt = $connect->prepare("SELECT * FROM addclient WHERE email = :email");
        $rqt->bindParam(":email",$email);
        $rqt->execute();
        $client = $rqt->fetch(PDO::FETCH_ASSOC);
        if($client){//Si le client est dans la base de l'admin , il peut  l'inscrire de son côté
        
            

            
                    //STCKOCAGE DANS SESSIONS
                $_SESSION['prenom'] = $prenom;
                $_SESSION['nom'] = $nom;
                $_SESSION['email'] = $email;
                $_SESSION['numero'] = $numero;
                $_SESSION['pwd'] = $pwd;

                
                
                //REQUETE D'INSCRIPTION
                //preparation
                $maRequete = $connect->prepare("INSERT INTO client (prenom,nom,email,numero,pwd) VALUES (:prenom,:nom,:email,:numero,:pwd)");

                //Liaison des paramètres
                $maRequete->bindParam(":prenom", $prenom);
                $maRequete->bindParam(":nom", $nom);
                $maRequete->bindParam(":email", $email);
                $maRequete->bindParam(":numero", $numero);
                $maRequete->bindParam(":pwd", $pwd);

                //Verification si l'email a deja été utilisé
                $verification = $connect->prepare("SELECT COUNT(*) AS count FROM client WHERE email = :email");
                $verification->bindParam(":email",$email);
                $verification->execute();
                $resultat = $verification->fetch(PDO::FETCH_ASSOC);
                if($resultat["count"] == 0){
                    //execution
                

                    if($maRequete->execute()){
                        echo "Client inséré avec succès";

                        $_SESSION["idClient"] = $connect->lastInsertId(); // pour récupérer l'ID inséré
                        //JE stocke tout dans une session ***************************************
                        $idClient = $_SESSION["idClient"];

                        //l'ajout d'un client engendre la création d'un compte
                        $solde = 0; //le solde initial est nul
                        //Une fois l'inscription faite, le compte est créé 
                        $rqt = $connect->prepare("INSERT INTO compte (idClient, solde) VALUES (:idClient,:solde)");
                        //Liaison
                        $rqt->bindParam(":idClient",$idClient);
                        $rqt->bindParam(":solde",$solde);
                        

                        if($rqt->execute()){
                            echo "Compte créé !";
                            
                            $_SESSION["idCompte"] = $connect->lastInsertId(); // pour récupérer l'ID inséré
                            $idCompte = $_SESSION["idCompte"];

                            header("Location: bienvenueClient.php"); // Rediriger l'utilisateur vers la page d'accueil après l' authentification 
                            exit;
                        
                    
                            
                        }else{
                            echo "Echec lors de la création du compte !";
                        } 
                    
                    }else {
                        echo "Erreur lors de l'ajout du client";
                    }
                }else {
                    
                    echo "Cet email a déjà un compte";
                    echo "<a href='../index.php'>Retourner à l'acceuil</a>";
                }
                   

            
            
        }else{
            echo "Vous n'êtes pas inscrit à la banque !<br>Veuillez vous y rendre pour le faire<br>";
            echo "<a href='../index.php'>Retourner à l'acceuil</a>";
        }

    }

}else echo "Veuillez remplir tous les champs";
    //.......................................................................

        
 

?>

<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template.php";
 ?>
