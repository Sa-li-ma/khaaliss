<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../style.css">
    <title>Khaaliss</title>
</head>
<body>
    <header>      <!--Cette balise contient les informations de l'en-tête de toutes les pages-->
        <nav class="menu">
            <ul>
                <li id="logo" class='logo'>Khaaliss</li>
                <li> <a href="bienvenueClient.php">ACCUEIL</a></li>
                <li><a href="releve.php">Relevé</a></li>
                <li><a href="pageClient.php">Opérations</a></li>
                <li><a href="profil.php">Profil</a></li>
                <li><a href="deconnexion.php">Deconnexion</a></li>

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