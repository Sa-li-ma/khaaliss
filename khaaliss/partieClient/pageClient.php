<?php ob_start(); ?> <!--Pour lancer l'enregitrement du contenu de cette page-->
<?php
//Ici est géré l'intanciation des classe client et compte ainsi que les opérations client

session_start();

require_once "../classes/compte.php";
require_once "../classes/user.php";
require_once "../classes/client.php";
require_once "../Functions.php";
require_once "../connexion.php";
global $connect;

if($_SESSION["idClient"]){ //Si le client est connecté, il peut faire des actions
    //On recupère les données

    $idCompte = $_SESSION["idCompte"];
    $prenom = $_SESSION['prenom'] ;
    $nom = $_SESSION['nom'];
    $email = $_SESSION['email'] ;
    $numero = $_SESSION['numero'] ;
    $pwd = $_SESSION['pwd'] ;

    //CREATION DES OBJET CLIENT ET COMPTE
    $client = new Client($_SESSION["idClient"],$prenom,$nom,$email,$numero,$pwd,"");
    $solde = $client->getSolde();
    $compte = new Compte($idCompte,$_SESSION["idClient"], $solde, "");
    

   
    //DEPOT
    if(isset($_POST["validerDepot"]) && isset($_POST["montantDepot"]) && !empty($_POST["montantDepot"])){
        $montant = $_POST["montantDepot"];
        $compte->depot($montant);
    }

    //RETRAIT
    if(isset($_POST["validerRetrait"]) && isset($_POST["montantRetrait"]) && !empty($_POST["montantRetrait"])){
        $montant = $_POST["montantRetrait"];
        $compte->retrait($montant);
    }







}






?>
<div class="etat">
    
</div>
<form action="pageClient.php" method="POST">
    <fieldset>
        <legend>OPERATIONS</legend>
        <fieldset>
            <legend>DEPOT</legend>
            <input type="number" name="montantDepot" placeholder="Montant">
            <button name="validerDepot">Valider</button>

        </fieldset>

        <fieldset>
            <legend>RETRAIT</legend>
            <input type="number" name="montantRetrait" placeholder="Montant">
            <button name="validerRetrait">Valider</button>

        </fieldset>

    </fieldset>
    


</form>


<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template.php";
 ?>