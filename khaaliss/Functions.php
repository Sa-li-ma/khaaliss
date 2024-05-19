<?php  

require_once "connexion.php";
global $connect;


//FONCTION PURIFICATION D'ENTEE avec les fonction trim() pour les " ", stripslashes() pour les \ et htmlspecialchars()

function correctValue($value){
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
}


//fonction pour vérifier si le client est inscrit par un admin et s'il est actif
function etatDuClient($emailClient){
    global $connect;
    $rqt = $connect->prepare("SELECT * FROM addClient WHERE email = :email");
    $rqt->bindParam(":email",$emailClient);
    $rqt->execute();
    $client = $rqt->fetch(PDO::FETCH_ASSOC);
    if($client){
        if($client["statut"] == "actif"){
            echo " C'est bonnnnn";
        }else{
            echo "Votre compte est inactif";
        }

    }else{
        echo "Vous n'êtes pas inscrit à la banque";
    }
}

?>


