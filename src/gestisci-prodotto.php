<?php
require_once 'bootstrap.php';

if(!isUserLoggedIn() || 
    !isset($_GET["action"]) || 
    ($_GET["action"]!=1 && $_GET["action"]!=2 && $_GET["action"]!=3) || 
    ($_GET["action"]!=1 && !isset($_GET["idMaglia"]))){
    header("location: login.php");
}

if($_GET["action"]!=1){
    $risultato = $dbh->getProductById($_GET["idMaglia"]);
    if(count($risultato)==0){
        $templateParams["maglia"] = null;
    }
    else{
        $templateParams["maglia"] = $risultato[0];
        $templateParams["maglia"]["colori"] = explode(",", $templateParams["maglia"]["colori"]);
    }
}
else{
    $templateParams["maglia"] = getEmptyProduct();
}




$templateParams["titolo"] = "Kits - Gestisci prodotto";
$templateParams["nome"] = "gestione-maglia.php";
$templateParams["colori"] = $dbh->getColours();

$templateParams["azione"] = $_GET["action"];

require 'template/base.php';
?>