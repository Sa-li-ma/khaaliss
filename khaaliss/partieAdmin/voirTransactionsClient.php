<?php ob_start(); ?> <!--Pour lancer l'enregitrement du contenu de cette page-->


<?php   
session_start();
require_once "../classes/user.php";
require_once "../classes/Admin.php";
require_once "../connexion.php"; 
global $connect;
if(isset($_SESSION['idAdmin'])){
    // Création de l'objet Admin
    $id = $_SESSION["idAdmin"];
    $nom = $_SESSION["nom"];
    $prenom = $_SESSION["prenom"];
    $email = $_SESSION["email"];
    $numero = $_SESSION["numero"];
    $pwd = $_SESSION["pwd"];
    $admin = new Admin($id, $nom, $prenom, $email, $numero, $pwd, "");
    // VOIR TRANSACTIONS
    $admin->voirTransactionsClient($_SESSION["idClient"]);
}

?>

<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template3.php";
 ?>
