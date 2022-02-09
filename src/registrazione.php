<?php
require_once 'bootstrap.php';

//registrazione
if(isset($_POST["invioRegistrazione"])){
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
                            if($result == 1){
                                //registrato con successo
                                //login automatico
                                $_SESSION["email"] = $_POST["emailRegistrazione"];
                                $_SESSION["password"] = $_POST["passwordRegistrazione"];
                                $_SESSION["admin"] = 0;
                            }
                            else{
                                //errore nell'inserimento nel db
                                $templateParams["messaggio"] = "si è verificato un errore nell'inserimento nel database";
                            }
                        } else {
                            $templateParams["messaggio"] = "numero di telefono non valido!";
                        }
                    } else {
                        $templateParams["messaggio"] = "le due password non corrispondono!";
                    }
                } else {
                    $templateParams["messaggio"] = "password non inserita!";
                }
            } else {
                $templateParams["messaggio"] = "email non valida!";
            }
        } else {
            $templateParams["messaggio"] = "cognome non inserito!";
        }
    } else {
        $templateParams["messaggio"] = "nome non inserito!";
    }
}

//se già loggato
if(!empty($_SESSION["email"])){
    header("location: index.php");
} else {
    $templateParams["titolo"] = "Blog TW - Registrazione";
    $templateParams["nome"] = "registrazione.php";
}

require 'template/base.php';
?>