<?php ob_start(); ?> <!--Pour lancer l'enregistrement du contenu de cette page-->
<?php
session_start();
require_once "../classes/user.php";
require_once "../classes/Admin.php";
require_once "../connexion.php"; 
global $connect;

if(isset($_SESSION["idAdmin"])){
    // Requête pour récupérer tous les clients
    $rqt = $connect->prepare("SELECT id, nom, prenom, email, numero FROM client");
    $rqt->execute();
    $clients = $rqt->fetchAll(PDO::FETCH_ASSOC);

    // Création de l'objet Admin
    $id = $_SESSION["idAdmin"];
    $nom = $_SESSION["nom"];
    $prenom = $_SESSION["prenom"];
    $email = $_SESSION["email"];
    $numero = $_SESSION["numero"];
    $pwd = $_SESSION["pwd"];
    $admin = new Admin($id, $nom, $prenom, $email, $numero, $pwd, "");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $emailClient = $_POST['emailClient'];

        if (isset($_POST["activer"])) {
            $admin->activerClient($emailClient);
            echo "Client activé avec succès";
        }
        if (isset($_POST["desactiver"])) {
            $admin->desactiverClient($emailClient);
            echo "Client désactivé avec succès";
        }
        if (isset($_POST["supprimer"])) {
            $admin->supprimerClient($emailClient);
            echo "Client supprimé avec succès";
        }
        if (isset($_POST["transactions"])) {
            $_SESSION["idClient"] = $_POST["idClient"];
            header("Location: voirTransactionsClient.php");
            exit;
        }
        // Rafraîchir la page pour refléter les changements
        /*header("Location: " . $_SERVER['PHP_SELF']);
        exit;*/
    }
}
?>
<h2>Liste des clients</h2>
<table border="1" class='tableau'>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Numéro</th>
            <th>Actions</th>
            <th>Transactions Client</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($clients as $client): ?>
        <tr>
            <td><?php echo htmlspecialchars($client['id']); ?></td>
            <td><?php echo htmlspecialchars($client['nom']); ?></td>
            <td><?php echo htmlspecialchars($client['prenom']); ?></td>
            <td><?php echo htmlspecialchars($client['email']); ?></td>
            <td><?php echo htmlspecialchars($client['numero']); ?></td>
            <td>
                <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="emailClient" value="<?php echo htmlspecialchars($client['email']); ?>">
                    <button type="submit" name="activer">Activer</button>
                </form>
                <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="emailClient" value="<?php echo htmlspecialchars($client['email']); ?>">
                    <button type="submit" name="desactiver">Désactiver</button>
                </form>
                <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="emailClient" value="<?php echo htmlspecialchars($client['email']); ?>">
                    <button type="submit" name="supprimer">Supprimer</button>
                </form>
            </td>
            <td>
                <form action="" method="post" style="display:inline;">
                    <input type="hidden" name="idClient" value="<?php echo htmlspecialchars($client['id']); ?>">
                    <button type="submit" name="transactions">Voir</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php 
$contenu = ob_get_clean(); // pour mettre le contenu dans la variable $contenu qui se trouve dans main
require_once "template3.php";
?>
