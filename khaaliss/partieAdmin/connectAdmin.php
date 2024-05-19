<?php ob_start(); ?> <!--Pour lancer l'enregistrement du contenu de cette page-->
<?php
session_start();


require_once "../Functions.php";
require_once "../connexion.php";
global $connect;

if(isset($_POST["envoyer"]) && isset($_POST["email"]) && isset($_POST["pwd"])){
    $email = correctValue($_POST["email"]);
    $pwd = correctValue($_POST["pwd"]);

   

    // Vérifiez si l'utilisateur existe
    $rqt = $connect->prepare("SELECT * FROM administrateur WHERE email = :email");
    $rqt->bindParam(':email', $email);
    $rqt->execute();
    $user = $rqt->fetch(PDO::FETCH_ASSOC);

    if($user) {
    

        // Vérifier si le mot de passe soumis correspond au mot de passe stocké dans la base de données
        if($user['pwd'] == $pwd) {
            // Authentification réussie
            $_SESSION['idAdmin'] = $user['id']; // Stocker l'ID de l'utilisateur dans la session
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

            header("Location: bienvenueAdmin.php"); // Rediriger l'utilisateur vers la page d'accueil après l'authentification 
            exit;
        } else {
            // Mot de passe incorrect
            echo "Mot de passe incorrect";
        }
    } else {
        // Utilisateur non trouvé avec cet email
        echo "Aucun utilisateur trouvé avec cet email";
    }
}
?>

<div class="connexion"> 
    <fieldset>
        <legend>Se connecter</legend>
        <form action="" method="post" class="formulaire">
            <input type="text" name="email" placeholder="E-mail" required> <br>
            <input type="password" name="pwd" placeholder="Mot de passe" required> <br>
            <button type ="submit" name="envoyer" >Envoyer</button>
        </form>
    </fieldset>
</div>

<?php 
    $contenu = ob_get_clean(); //pour mettre le contenu dans la variable $contenu qui se trouve dans main
    require_once "../partieClient/template2.php";
?>
