<?php
require_once '../connexion.php';
class Operation {
    protected $id;
    protected $idClient;
    protected $idCompte;
    protected $solde;

    //Constructeur
    public function __construct($id,$idClient,$idCompte,$solde){
        $this->id = $id;
        $this->idClient = $idClient;
        $this->idCompte = $idCompte;
        $this->solde = $solde;
        $this->connect = getConnection();

    }
}

?>