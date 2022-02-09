<?php
require_once 'bootstrap.php';

if(isset($_POST["logout"])){
    session_unset();
    session_destroy();
    session_start();
}

//login
if(isset($_POST["email"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"]);
    if(count($login_result)==0){
        //Login fallito
        $templateParams["messaggio"] = "Errore! Controllare email e password!";
    }
    else{
        //Login con successo
        $_SESSION["email"] = $login_result[0]["email"];
        $_SESSION["password"] = $login_result[0]["password"];
        $_SESSION["admin"] = $login_result[0]["admin"];
    }
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
        //utente template
        $templateParams["ordini"] = $dbh->getOrdersOfUser($_SESSION["email"]);
    }
}
else{
    $templateParams["titolo"] = "Blog TW - Login";
    $templateParams["nome"] = "login.php";
}

//eventuale cambio password
if(isset($_POST["nuovaPassword"]) && isset($_POST["vecchiaPassword"])){
    $pass_change_result = $dbh->changePassword($_SESSION["email"], 
        $_POST["vecchiaPassword"], 
        $_POST["nuovaPassword"]);
    if($pass_change_result==0){
        $templateParams["messaggio"] = "Errore! password non modificata!";
    } else {
        $templateParams["messaggio"] = "Password modificata con successo!";
    }
}

require 'template/base.php';
?>