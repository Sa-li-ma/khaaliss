<?php
require_once "user.php";
require_once "../connexion.php";

class Client extends User {
    public function setNom($nom){
        $this->nom = $nom;
        //Modifier dans bd
        $rqt = $this->connect->prepare("UPDATE client SET nom = :nom WHERE id = :id");
        $rqt->bindValue(':nom', $this->nom);
        $rqt->bindValue(':id', $this->id);
        $rqt->execute();

          //Modifier dans bd
          $rqt = $this->connect->prepare("UPDATE addclient SET nom = :nom WHERE email = :email");
          $rqt->bindValue(':nom', $this->nom);
          $rqt->bindValue(':email', $this->email);
          $rqt->execute();
    }
    
    public function setPrenom($prenom){
        $this->prenom = $prenom;
        //Modifier dans bd
        $rqt = $this->connect->prepare("UPDATE client SET prenom = :prenom WHERE id = :id");
        $rqt->bindValue(':prenom', $this->prenom);
        $rqt->bindValue(':id', $this->id);
        $rqt->execute();

        //Modifier cher admin
        $rqt = $this->connect->prepare("UPDATE addclient SET prenom = :prenom WHERE email = :email");
        $rqt->bindValue(':prenom', $this->prenom);
        $rqt->bindValue(':email', $this->email);
        $rqt->execute();
    }
    
    public function setEmail($email){
        $this->email = $email;
        //Modifier dans bd
        $rqt = $this->connect->prepare("UPDATE client SET email = :email WHERE id = :id");
        $rqt->bindValue(':email', $this->email);
        $rqt->bindValue(':id', $this->id);
        $rqt->execute();
        //Modifier cher admin
        $rqt = $this->connect->prepare("UPDATE addclient SET email = :email WHERE numero = :numero");
        $rqt->bindValue(':email', $this->email);
        $rqt->bindValue(':numero', $this->numero);
        $rqt->execute();
    }
    
    public function setNumero($numero){
        $this->numero = $numero;
        //Modifier dans bd
        $rqt = $this->connect->prepare("UPDATE client SET numero = :numero WHERE id = :id");
        $rqt->bindValue(':numero', $this->nom);
        $rqt->bindValue(':id', $this->id);
        $rqt->execute();

    }
    
    public function setPwd($pwd){
        $this->pwd = $pwd;
        //Modifier dans bd
        $rqt = $this->connect->prepare("UPDATE client SET pwd = :pwd WHERE id = :id");
        $rqt->bindValue(':pwd', $this->nom);
        $rqt->bindValue(':id', $this->id);
        $rqt->execute();

        //Modifier dans la base de l'admin
        $rqt = $this->connect->prepare("UPDATE addclient SET pwd = :pwd WHERE email = :email");
        $rqt->bindValue(':pwd', $this->nom);
        $rqt->bindValue(':email', $this->email);
        $rqt->execute();
    }
    


    //GETTERS

public function getNom(){
    $req = "SELECT nom FROM client WHERE id = :id";
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
    $req = "SELECT prenom FROM client WHERE id = :id";
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
    $req = "SELECT email FROM client WHERE id = :id";
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
    $req = "SELECT numero FROM client WHERE id = :id";
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
    $req = "SELECT pwd FROM client WHERE id = :id";
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


public function getSolde(){
    $req = $this->connect->prepare("SELECT solde FROM compte WHERE idClient = :idClient");
    $req->bindParam(":idClient", $_SESSION['idClient']);
    $req->execute();
    $solde = $req->fetch(PDO::FETCH_ASSOC);
    if($solde){
        return $solde["solde"];
    } else {
        return 0;
    }
}

}

