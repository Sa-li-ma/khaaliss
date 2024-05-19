<?php
    $dbhost = 'mysql-salimata00.alwaysdata.net';
    $dbname = 'salimata00_khaaliss';
    $dbuser = '341804_khaaliss';
    $dbpswd = 'khaalissBanque';
    try{
        $connect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname,$dbuser,$dbpswd,
        array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
            )
        );
    }catch (PDOException $e){
        die("Une erreur est survenue lors de la connexion à la Base de données !");
    }

    function getConnection(){ //POUR PERMETTRE DES OPERATIOON SUR LE SOLDE
        $dbhost = 'mysql-salimata00.alwaysdata.net';
    $dbname = 'salimata00_banque';
    $dbuser = '341804_banque';
    $dbpswd = ' banqueBanque';
        try{
            $connect = new PDO('mysql:host='.$dbhost.';dbname='.$dbname,$dbuser,$dbpswd,
            array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
                )
            );
            return $connect; // Ajout de cette ligne pour retourner la connexion PDO
        }catch (PDOException $e){
            die("Une erreur est survenue lors de la connexion à la Base de données !");
        }
    }
    