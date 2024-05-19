<?php
require_once "../connexion.php";


class Compte {
    protected $id;
    protected $idClient;
    protected $solde;
    protected $connect;
    
    //Constructeur
    public function __construct($id,$idClient,$solde){
        $this->id = $id;
        $this->idClient = $idClient;
        $this->solde = $solde;
        $this->connect = getConnection();

    }

    //Getters

    public function getId(){
        return $this->id;
    }

    public function getIdClient(){
        return $this->idClient;
    }
    
   

    //Setters
    public function setId($id){
        $this->id = $id;
    }

    public function setIdClient($idClient){
        $this->idClient = $idClient;
    } 
    public function setSolde($solde){
        $this->solde = $solde;
    } 


    //Depot
    public function depot(float $somme){

        $sld = (float) $this->solde;
        $sld += $somme;
        $this->solde = $sld;
        $this->nouveauSolde($sld);
        
        $s = $this->getSolde();
         $nomOperation = "DEPOT";
        
        echo "Opération réussie ! Votre solde est actuellement de ". $this->getSolde();
        //Enregistrement de l'opération dans la bd , table operation
        $dateOperation = date("Y-m-d H:i:s"); // Obtient la date et l'heure actuelles 

        $req = $this->connect->prepare("INSERT INTO operation (idClient, idCompte, solde, nomOperation, montantOperation, dateOperation) VALUES (:idClient, :idCompte, :solde, :nomOperation, :montantOperation, :dateOperation)");

        $req->bindParam(":idClient", $_SESSION["idClient"]);
        $req->bindParam(":idCompte", $_SESSION["idCompte"]);
        $req->bindParam(":solde", $s);
        $req->bindParam(":nomOperation", $nomOperation);
        $req->bindParam(":montantOperation", $somme);
        $req->bindParam(":dateOperation", $dateOperation);

        $req->execute();
    }
    //retrait
    public function retrait(float $somme){
        $sld = (float) $this->solde;
        if($somme <=  $sld){
            
            $sld  -= $somme;
            $this->solde = $sld;
            $this->nouveauSolde($sld);
            
            $s = $this->getSolde();
            $nomOperation = "RETRAIT";
            
            echo "Opération réussie ! Votre solde est actuellement de ". $this->getSolde();
            //Enregistrement de l'opération dans la bd , table operation
            $dateOperation = date("Y-m-d H:i:s"); // Obtient la date et l'heure actuelles 

            $req = $this->connect->prepare("INSERT INTO operation (idClient, idCompte, solde, nomOperation, montantOperation, dateOperation) VALUES (:idClient, :idCompte, :solde, :nomOperation, :montantOperation, :dateOperation)");

            $req->bindParam(":idClient", $_SESSION["idClient"]);
            $req->bindParam(":idCompte", $_SESSION["idCompte"]);
            $req->bindParam(":solde", $s);
            $req->bindParam(":nomOperation", $nomOperation);
            $req->bindParam(":montantOperation", $somme);
            $req->bindParam(":dateOperation", $dateOperation);

            $req->execute();
        }else echo "Opération échouée ! Vous n'avez pas assez d'argent sur votre compte ";
    }
   

    //Pour changer le solde dans la bd
    protected function nouveauSolde($solde){
        $rqt = $this->connect->prepare("UPDATE compte SET solde = :solde WHERE idClient = :idClient");
        $rqt->bindValue(':solde', $solde);
        $rqt->bindValue(':idClient', $_SESSION['idClient']);
        $rqt->execute();
    }




    //pour avoir mon solde 
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

?>


