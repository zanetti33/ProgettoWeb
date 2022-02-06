<?php
require_once 'bootstrap.php';

if(isset($_POST["email"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["email"], $_POST["password"]);
    if(count($login_result)==0){
        //Login fallito
        $templateParams["errore"] = "Errore! Controllare email e password!";
    }
    else{
        //Login con successo
        $_SESSION["email"] = $login_result[0]["email"];
        $_SESSION["password"] = $login_result[0]["password"];
        $_SESSION["admin"] = $login_result[0]["admin"];
    }
}

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
}
else{
    $templateParams["titolo"] = "Blog TW - Login";
    $templateParams["nome"] = "login.php";
}

require 'template/base.php';
?>