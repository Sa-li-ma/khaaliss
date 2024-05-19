<?php
require_once 'user.php';

class Admin extends User {

    // Méthode pour activer un client
    public function activerClient($emailClient) {
        $statut = "actif";
        // Modifier dans bd
        $rqt = $this->connect->prepare("UPDATE addclient SET statut = :statut WHERE email = :email");
        $rqt->bindParam(':statut', $statut);
        $rqt->bindParam(':email', $emailClient);
        $rqt->execute();
    }

    // Méthode pour désactiver un client
    public function desactiverClient($emailClient) {
        $statut = "inactif";
        // Modifier dans bd
        $rqt = $this->connect->prepare("UPDATE addclient SET statut = :statut WHERE email = :email");
        $rqt->bindParam(':statut', $statut);
        $rqt->bindParam(':email', $emailClient);
        $rqt->execute();
    }

    // Méthode pour supprimer un client
    public function supprimerClient($emailClient) {
        // Supprimer dans la base de l'admin
        $rqt = $this->connect->prepare("DELETE FROM addclient WHERE email = :email");
        $rqt->bindParam(':email', $emailClient);
        $rqt->execute();
        //supprimer de la table client
        $rqt = $this->connect->prepare("DELETE FROM client WHERE email = :email");
        $rqt->bindParam(':email', $emailClient);
        $rqt->execute();

    }

    //SETTERS PARAMETRE DE ADMIN
    public function setNom($nom){
        $this->nom = $nom;
        //Modifier dans bd
        $rqt = $this->connect->prepare("UPDATE administrateur SET nom = :nom WHERE id = :id");
        $rqt->bindValue(':nom', $this->nom);
        $rqt->bindValue(':id', $this->id);
        $rqt->execute();
    }
    
    public function setPrenom($prenom){
        $this->prenom = $prenom;
        //Modifier dans bd
        $rqt = $this->connect->prepare("UPDATE administrateur SET prenom = :prenom WHERE id = :id");
        $rqt->bindValue(':prenom', $this->prenom);
        $rqt->bindValue(':id', $this->id);
        $rqt->execute();
    }
    
    public function setEmail($email){
        $this->email = $email;
        //Modifier dans bd
        $rqt = $this->connect->prepare("UPDATE administrateur SET email = :email WHERE id = :id");
        $rqt->bindValue(':email', $this->email);
        $rqt->bindValue(':id', $this->id);
        $rqt->execute();
    }
    
    public function setNumero($numero){
        $this->numero = $numero;
        //Modifier dans bd
        $rqt = $this->connect->prepare("UPDATE administrateur SET numero = :numero WHERE id = :id");
        $rqt->bindValue(':numero', $this->numero);
        $rqt->bindValue(':id', $this->id);
        $rqt->execute();
    }
    
    public function setPwd($pwd){
        $this->pwd = $pwd;
        //Modifier dans bd
        $rqt = $this->connect->prepare("UPDATE administrateur SET pwd = :pwd WHERE id = :id");
        $rqt->bindValue(':pwd', $this->nom);
        $rqt->bindValue(':id', $this->id);
        $rqt->execute();
    }
    


    //GETTERS

public function getNom(){
    $req = "SELECT nom FROM administrateur WHERE id = :id";
        $rqt = $this->connect->prepare($req);
        $rqt->bindValue(':id', $this->id);
        $rqt->execute();
        $resultat = $rqt->fetch(PDO::FETCH_ASSOC);
        if ($resultat) {
            return  $resultat['nom'];
        } else {
            return 0; 
        }
    
}

public function getPrenom(){
    $req = "SELECT prenom FROM administrateur WHERE id = :id";
        $rqt = $this->connect->prepare($req);
        $rqt->bindValue(':id', $this->id);
        $rqt->execute();
        $resultat = $rqt->fetch(PDO::FETCH_ASSOC);
        if ($resultat) {
            return  $resultat['prenom'];
        } else {
            return 0; 
        }
    
}

public function getEmail(){
    $req = "SELECT email FROM administrateur WHERE id = :id";
        $rqt = $this->connect->prepare($req);
        $rqt->bindValue(':id', $this->id);
        $rqt->execute();
        $resultat = $rqt->fetch(PDO::FETCH_ASSOC);
        if ($resultat) {
            return  $resultat['email'];
        } else {
            return 0; 
        }
    
}

public function getNumero(){
    $req = "SELECT numero FROM administrateur WHERE id = :id";
        $rqt = $this->connect->prepare($req);
        $rqt->bindValue(':id', $this->id);
        $rqt->execute();
        $resultat = $rqt->fetch(PDO::FETCH_ASSOC);
        if ($resultat) {
            return  $resultat['numero'];
        } else {
            return 0; 
        }
    
}

public function getPwd(){
    $req = "SELECT pwd FROM administrateur WHERE id = :id";
    $rqt = $this->connect->prepare($req);
    $rqt->bindValue(':id', $this->id);
    $rqt->execute();
    $resultat = $rqt->fetch(PDO::FETCH_ASSOC);
    if ($resultat) {
        return $resultat['pwd'];
    } else {
        return 0; 
    }

}



//Methode pour voir les transactions duclient
public function voirTransactionsClient($idClient){
    
    $req = $this->connect->prepare(" SELECT * FROM operation WHERE idClient = :idClient");
    $req->bindParam("idClient", $idClient);
    $req->execute();
    $operations = $req->fetch(PDO::FETCH_ASSOC);

    echo "<table border='1' class='tableau'>";
        // En-tête du tableau
        echo "<tr>";
        echo "<th>N°</th>";
        echo "<th>Solde</th>";
        echo "<th>Nom de l'opération</th>";
        echo "<th>Montant de l'opération</th>";
        echo "<th>Date de l'opération</th>";
        echo "</tr>";

        // Boucle pour parcourir toutes les opérations récupérées
        while ($operation = $req->fetch(PDO::FETCH_ASSOC)) {
            // Début d'une ligne du tableau
            echo "<tr>";
            // Affichage des détails de chaque opération dans des cellules de tableau
            echo "<td>" . $operation['idOperation'] . "</td>";
            echo "<td>" . $operation['solde'] . "</td>";
            echo "<td>" . $operation['nomOperation'] . "</td>";
            echo "<td>" . $operation['montantOperation'] . "</td>";
            echo "<td>" . $operation['dateOperation'] . "</td>";
            // Fin de la ligne du tableau
            echo "</tr>";
        }

        // Fin du tableau
        echo "</table>";


}
}
?>
