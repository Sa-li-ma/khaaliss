<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">

    <title>Khaaliss</title>
</head>
<body>
    <header>      <!--Cette balise contient les informations de l'en-tête de toutes les pages-->
        <nav class="menu">
            <ul>
                <li id="logo" class='logo'>Khaaliss</li>
                <li> <a href="bienvenueAdmin.php">ACCUEIL</a></li>
                <li><a href="ajouterClient.php">Ajouter</a></li>
                <li><a href="gestionClient.php">Gestion de clients</a></li>
                <li><a href="profilAdmin.php">Profil</a></li>
                <li><a href="deconnectAdmin.php">Déconnexion</a></li>

            </ul>
        </nav>
    </header>
    <main class = "contenu">
        <?= $contenu; ?>
    </main>
 
    <footer class="pied_de_page">
   
    </footer>
   
    
</body>
</html>