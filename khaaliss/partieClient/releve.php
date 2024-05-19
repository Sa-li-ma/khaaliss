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

    //AFFIGAGE DU RELEVE DU CLIENT

    $req = $connect->prepare(" SELECT * FROM operation WHERE idClient = :idClient");
    $req->bindParam("idClient", $_SESSION["idClient"]);
    $req->execute();
    $operations = $req->fetch(PDO::FETCH_ASSOC);

    echo "<table border='1' class='tableau'>";
// En-tête du tableau
echo "<tr>";
echo "<th>N°</th>";
echo "<th>Solde</th>";
echo "<th>Nom de l'opération</th>";
echo "<th>Montant de l'opération</th>";
echo "<th>Date de l'opération</th>";
echo "</tr>";

// Boucle pour parcourir toutes les opérations récupérées
while ($operation = $req->fetch(PDO::FETCH_ASSOC)) {
    // Début d'une ligne du tableau
    echo "<tr>";
    // Affichage des détails de chaque opération dans des cellules de tableau
    echo "<td>" . $operation['idOperation'] . "</td>";
    echo "<td>" . $operation['solde'] . "</td>";
    echo "<td>" . $operation['nomOperation'] . "</td>";
    echo "<td>" . $operation['montantOperation'] . "</td>";
    echo "<td>" . $operation['dateOperation'] . "</td>";
    // Fin de la ligne du tableau
    echo "</tr>";
}

// Fin du tableau
echo "</table>";


}
    

   ?>
<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template.php";
 ?>