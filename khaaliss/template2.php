<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Khaaliss</title>
</head>
<body>
    <header>      <!--Cette balise contient les informations de l'en-tête de toutes les pages-->
        <nav class="menu">
            <ul>
                <li id="logo" class='logo'>Khaaliss</li>
                <li> <a href="index.php">ACCUEIL</a></li>
                <li><a href="services.php">Nos services</a></li>
                <li><a href="aPropos.php">A propos</a></li>
                <li><a href="contacts.php">Contacts</a></li>
                <li><a href="./partieClient/inscription.php">inscription</a></li>
                <li><a href="./partieClient/connectClient.php">Connexion</a></li>
                

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