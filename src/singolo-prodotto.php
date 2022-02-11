<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Kits";
$templateParams["nome"] = "prodotto.php";
//Home Template

$templateParams["taglie"] = $dbh->getSizes();

$id = 1;
if(isset($_GET["idMaglia"])){
    $id = $_GET["idMaglia"];
}
$templateParams["maglia"] = $dbh->getProductById($id)[0];

if(isset($_POST["cambioTaglia"])){

    $taglia = $_POST["taglia"];
    $maglia = $templateParams["maglia"];
    
    $idMaglia = $dbh->getProductBySize($maglia["idGenere"], $maglia["idColore"], $maglia["idModello"], $taglia)[0];
    $templateParams["maglia"] = $dbh->getProductById($idMaglia["idMaglia"])[0];
    $_GET["idMaglia"] = $idMaglia["idMaglia"];
}

require 'template/base.php';
?>