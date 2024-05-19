<?php ob_start(); ?> <!-- Pour lancer l'enregistrement du contenu de cette page -->
<?php
// Ici est géré l'instantiation des classes Client et Compte ainsi que les opérations client

session_start();

require_once "../classes/user.php";
require_once "../classes/Admin.php";
require_once "../Functions.php";
require_once "../connexion.php";
global $connect;

if(isset($_SESSION["idAdmin"])) { // Si l'admin est connecté, il peut faire des actions
    // On récupère les données
    
    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];
    $email = $_SESSION['email'];
    $numero = $_SESSION['numero'];
    $pwd = $_SESSION['pwd'];

    // CREATION DE ADMIN
    $admin = new Admin($_SESSION["idAdmin"], $prenom, $nom, $email, $numero, $pwd, "");

    if(isset($_POST["modifier"])){
        //nom
        if(isset($_POST["nom"]) && !empty($_POST["nom"])){
            $admin->setNom($_POST["nom"]);

            echo "Votre nouveau nom est ".$admin->getNom()."<br>";
        }

        if(isset($_POST["prenom"]) && !empty($_POST["prenom"])){
            $admin->setPrenom($_POST["prenom"]);
            echo "Votre nouveau prenom est ".$admin->getPrenom()."<br>";
        }

        if(isset($_POST["email"]) && !empty($_POST["email"])){
            $admin->setEmail($_POST["email"]);
            echo "Votre nouvel email est ".$admin->getEmail()."<br>";
        }

        if(isset($_POST["numero"]) && !empty($_POST["numero"])){
            $admin->setNumero($_POST["numero"]);
            echo "Votre nouveau numéro est ".$admin->getNumero()."<br>";
        }

        if(isset($_POST["pwd"]) && !empty($_POST["pwd"])){
            $admin->setPwd($_POST["pwd"]);
        }
    }


}

?>

<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template3.php";
 ?>