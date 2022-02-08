<?php
require_once 'bootstrap.php';

//registrazione
if(isset($_POST["nomeRegistrazione"])){
    if(isset($_POST["cognomeRegistrazione"])){
        if(isset($_POST["emailRegistrazione"]) && count($dbh->alreadyRegistered($_POST["emailRegistrazione"])) == 0){
            if(isset($_POST["passwordRegistrazione"])){
                if(isset($_POST["confermaPassword"]) && $_POST["confermaPassword"] == $_POST["passwordRegistrazione"]){
                    if(isset($_POST["telefonoRegistrazione"]) && strlen($_POST["telefonoRegistrazione"]) == 10){
                        $result = $dbh->register($_POST["emailRegistrazione"], 
                            $_POST["nomeRegistrazione"], 
                            $_POST["cognomeRegistrazione"], 
                            $_POST["passwordRegistrazione"],
                            $_POST["telefonoRegistrazione"]);
                        if($result){
                            //registrazione avvenuta con successo
                        }
                        else{
                            //registrato con successo
                            //login automatico
                            $_SESSION["email"] = $_POST["emailRegistrazione"];
                            $_SESSION["password"] = $_POST["passwordRegistrazione"];
                            $_SESSION["admin"] = 0;
                        }
                    } else {
                        $templateParams["errore"] = "numero di telefono non valido!";
                    }
                } else {
                    $templateParams["errore"] = "le due password non corrispondono!";
                }
            } else {
                $templateParams["errore"] = "password non inserita!";
            }
        } else {
            $templateParams["errore"] = "email non valida!";
        }
    } else {
        $templateParams["errore"] = "cognome non inserito!";
    }
} else {
    $templateParams["errore"] = "nome non inserito!";
}

//se già loggato
if(!empty($_SESSION["email"])){
    if($_SESSION["admin"]){
        //pagina Admin
        $templateParams["titolo"] = "Kits - Gestione";
        $templateParams["nome"] = "amministratore.php";
    } else {
        //pagina utente
        $templateParams["titolo"] = "Kits - Utente";
        $templateParams["nome"] = "utente.php";
    }
} else {
    $templateParams["titolo"] = "Blog TW - Registrazione";
    $templateParams["nome"] = "registrazione.php";
}

require 'template/base.php';
?>