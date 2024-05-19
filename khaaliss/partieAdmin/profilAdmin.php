<?php ob_start(); ?> <!-- Pour lancer l'enregistrement du contenu de cette page -->
<?php


session_start();


require_once "../classes/user.php";
require_once "../classes/Admin.php";
require_once "../Functions.php";
require_once "../connexion.php";
global $connect;

if(isset($_SESSION["idAdmin"])) { // Si l'admin' est connecté, il peut faire des actions
    // On récupère les données
    
    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];
    $email = $_SESSION['email'];
    $numero = $_SESSION['numero'];
    $pwd = $_SESSION['pwd'];

    // CREATION DE ADMIN
    $admin = new Admin($_SESSION["idAdmin"], $prenom, $nom, $email, $numero, $pwd, "");
    

    

    // Affichage des informations du client dans des balises <div>
    echo "<div class='profile-info'>";
    echo "<h1>Profil</h1>";
    echo "<div><strong>Prénom:</strong>". $admin->getPrenom()."</div>";
    echo "<div><strong>Nom:</strong>". $admin->getNom()."</div>";
    echo "<div><strong>Email:</strong>". $admin->getEmail()."</div>";
    echo "<div><strong>Numéro de téléphone:</strong> ".$admin->getNumero()."</div>";
    echo "</div>";

    // Formulaire pour modifier les informations de l'admin
    echo "<div class='profile-form'>";
    echo "<h4>Paramètres</h4>";
    echo "<h5>Modification</h5>";
    
    echo "<form action='modifierAdmin.php' method='post' class='formulaire'>";
    echo "<div><input type='text' id='prenom' name='prenom' placeholder ='Prenom'></div>";
    echo "<div><input type='text' id='nom' name='nom'  placeholder ='Nom'></div>";
    echo "<div><input type='email' id='email' name='email'placeholder ='Email'></div>";
    echo "<div><input type='text' id='numero' name='numero' placeholder ='Numéro'></div>";
    echo "<div><input type='password' id='pwd' name='pwd' placeholder ='Mot de passe'></div>";
    echo "<div><input type='submit' value='Enregistrer les modifications' name = 'modifier'></div>";
    echo "</form>";
    echo "</div>";
}
?>

<?php 
$contenu=ob_get_clean(); // Pour mettre le contenu dans la variable $contenu qui se trouve dans main
require_once "template3.php";
?>
