<?php ob_start(); ?> <!--Pour lancer l'enregitrement du contenu de cette page-->

<div class="bienvenueClient">
    <h1>Bienvenue chez KHAALISS</h1>
    <p>
        Bonjour, <strong><?php session_start(); 
        require_once "../classes/compte.php";
        require_once "../classes/user.php";
        require_once "../classes/client.php";
        require_once "../Functions.php";
        require_once "../connexion.php";
        global $connect;
        if(isset($_SESSION["idClient"])){
        $client = new Client($_SESSION["idClient"],$_SESSION['nom'],$_SESSION['prenom'],$_SESSION['email'],$_SESSION['numero'],$_SESSION['pwd'],"");
        echo htmlspecialchars($client->getPrenom(). ' ' .$client->getNom());} ?></strong> !
    </p>
    <p>
        Nous sommes ravis de vous accueillir sur KHAALISS, votre solution de gestion bancaire en ligne, intelligente et sécurisée. Grâce à notre application, vous pouvez gérer vos comptes bancaires en toute simplicité, où que vous soyez et à tout moment.
    </p>
    <p>
        Voici quelques-unes des fonctionnalités que vous pouvez explorer :
    </p>
    <ul>
        <li>Consulter le solde de vos comptes en temps réel</li>
        <li>Effectuer des dépôts, retraits et virements en toute sécurité</li>
        <li>Suivre vos transactions et historiques de compte</li>
        <li>Configurer profil</li>
        
    </ul>
    <p>
        Chez KHAALISS, la sécurité de vos données est notre priorité. Vos informations sont protégées par les dernières technologies de cryptage et de sécurité.
    </p>
    <p>
        Si vous avez des questions ou besoin d'assistance, notre équipe de support est à votre disposition pour vous aider.
    </p>
    <p>
        Merci de nous faire confiance et de choisir KHAALISS pour gérer vos finances.
    </p>
    <p>
        <em>L'équipe KHAALISS</em>
    </p>
</div>



<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template.php";
 ?>