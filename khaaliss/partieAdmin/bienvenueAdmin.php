<?php ob_start(); ?> <!--Pour lancer l'enregitrement du contenu de cette page-->


<div class="bienvenueAdmin">
    <h1>Bienvenue sur le Tableau de Bord Administrateur de KHAALISS</h1>
    <p>
        Bonjour, <strong><?php session_start(); 
        require_once "../connexion.php";
        global $connect;
        require_once "../classes/user.php";
        require_once "../classes/Admin.php";
        require_once "../Functions.php";
        
        if(isset($_SESSION["idAdmin"])){
        $admin = new Admin($_SESSION["idAdmin"],$_SESSION['nom'],$_SESSION['prenom'],$_SESSION['email'],$_SESSION['numero'],$_SESSION['pwd'],"");
        echo htmlspecialchars($admin->getPrenom(). ' ' .$admin->getNom());} ?></strong> !
    </p>
    <p>
        Vous avez accédé à l'interface d'administration de KHAALISS, votre application de gestion bancaire sécurisée et intuitive. En tant qu'administrateur, vous avez la possibilité de gérer les comptes utilisateurs, surveiller les transactions, et assurer la sécurité de notre plateforme.
    </p>
    <p>
        Voici quelques-unes des actions que vous pouvez effectuer :
    </p>
    <ul>
        <li>Activer ou désactiver les comptes des clients</li>
        <li>Supprimer les comptes des clients</li>
        <li>Voir les détails des transactions des utilisateurs</li>
        <li>Gérer les paramètres de sécurité</li>
        <li>Cérer les paramètres de votre compte</li>
    </ul>
    <p>
        Nous vous remercions pour votre diligence et votre engagement à maintenir la qualité et la sécurité de notre service. Si vous avez besoin d'assistance ou rencontrez des problèmes, n'hésitez pas à contacter notre support technique.
    </p>
    <p>
        Bonne gestion !
    </p>
    <p>
        <em>L'équipe KHAALISS</em>
    </p>
</div>


<?php 
    $contenu=ob_get_clean(); //pour mettre le contenu dans la variables $contenu qui de trouve dans main
    require_once "template3.php";
 ?>
