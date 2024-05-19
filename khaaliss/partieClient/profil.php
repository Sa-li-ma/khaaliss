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

    $prenom = $_SESSION['prenom'];
    $nom = $_SESSION['nom'];
    $email = $_SESSION['email'];
    $numero = $_SESSION['numero'];
    $pwd = $_SESSION['pwd'];

    // CREATION DES OBJETS CLIENT ET COMPTE
    $client = new Client($_SESSION["idClient"], $prenom, $nom, $email, $numero, $pwd, "");
    $solde = $client->getSolde();
    

    

    // Affichage des informations du client dans des balises <div>
    echo "<div class='profile-info'>";
    echo "<h1>Profil</h1>";
    echo "<div><strong>Prénom:</strong>". $client->getPrenom()."</div>";
    echo "<div><strong>Nom:</strong>". $client->getNom()."</div>";
    echo "<div><strong>Email:</strong>". $client->getEmail()."</div>";
    echo "<div><strong>Numéro de téléphone:</strong> ".$client->getNumero()."</div>";
    echo "</div>";

    // Formulaire pour modifier les informations du client
    echo "<div class='profile-form'>";
    echo "<h4>Paramètres</h4>";
    echo "<h5>Modification</h5>";
    
    echo "<form action='modifier.php' method='post' class='formulaire'>";
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
require_once "template.php";
?>
