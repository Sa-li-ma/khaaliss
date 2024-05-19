<?php ob_start(); ?> <!-- Pour lancer l'enregistrement du contenu de cette page -->
<?php
// Ici est géré l'instantiation des classes Client et Compte ainsi que les opérations client

session_start();

require_once "../classes/compte.php";
require_once "../classes/user.php";
require_once "../classes/client.php";
require_once "../Functions.php";
require_once "../connexion.php";
global $connect;

if(isset($_SESSION["idClient"])) { // Si le client est connecté, il peut faire des actions
    // On récupère les données
    $idCompte = $_SESSION["idCompte"];
    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];
    $email = $_SESSION['email'];
    $numero = $_SESSION['numero'];
    $pwd = $_SESSION['pwd'];

    // CREATION DES OBJETS CLIENT ET COMPTE
    $client = new Client($_SESSION["idClient"], $prenom, $nom, $email, $numero, $pwd, "");
    $solde = $client->getSolde();
    $compte = new Compte($idCompte, $_SESSION["idClient"], $solde, "");

    if(isset($_POST["modifier"])){
        //nom
        if(isset($_POST["nom"]) && !empty($_POST["nom"])){
            $client->setNom($_POST["nom"]);

            echo "Votre nouveau nom est ".$client->getNom()."<br>";
        }

        if(isset($_POST["prenom"]) && !empty($_POST["prenom"])){
            $client->setPrenom($_POST["prenom"]);
            echo "Votre nouveau prenom est ".$client->getPrenom()."<br>";
        }

        if(isset($_POST["email"]) && !empty($_POST["email"])){
            $client->setEmail($_POST["email"]);
            echo "Votre nouvel email est ".$client->getEmail()."<br>";
        }

        if(isset($_POST["numero"]) && !empty($_POST["numero"])){
            $client->setNumero($_POST["numero"]);
            echo "Votre nouveau numéro est ".$client->getNumero()."<br>";
        }

        if(isset($_POST["pwd"]) && !empty($_POST["pwd"])){
            $client->setPwd($_POST["pwd"]);
        }
    }


}

?>

<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template.php";
 ?>