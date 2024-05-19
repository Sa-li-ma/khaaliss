<?php
require_once "../connexion.php";
class User {
protected $id;
protected $nom;
protected $prenom;
protected $email;
protected $numero;
protected $pwd;
protected $connect;

//CONSTRUCTEUR

public function __construct($id,$nom,$prenom,$email,$numero, $pwd){
    $this->id = $id;
    $this->nom = $nom;
    $this->prenom = $prenom;
    $this->email = $email;
    $this->numero = $numero;
    $this->pwd = $pwd;
    $this->connect = getConnection();
}



}



?>