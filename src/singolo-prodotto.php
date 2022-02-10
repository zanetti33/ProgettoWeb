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

require 'template/base.php';
?>