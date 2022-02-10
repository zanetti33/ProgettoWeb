<?php
require_once 'bootstrap.php';
require_once 'utils/functions.php';

//Base Template
$templateParams["titolo"] = "Kits";
$templateParams["nome"] = "lista-prodotti.php";
$templateParams["colori"] = $dbh->getColors();
$templateParams["generi"] = $dbh->getGenders();
//Home Template

$generi = array();
foreach ($templateParams["generi"] as $genere) {
    if(isset($_GET[$genere["nome"]])){
        array_push($generi, $genere["idGenere"]);
    }
}

$colore = 0;
if(isset($_GET["colore"])){
    $colore = $_GET["colore"];
}

$templateParams["maglieFiltrate"] = $dbh->getFilteredShirts($generi, $colore);

require 'template/base.php';
?>