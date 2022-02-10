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
    if(isset($_GET[toTag($genere["nome"])])){
        array_push($generi, $genere["idGenere"]);
    }
}

$colore = 2;
if(isset($_GET["colore"])){
    $colore = $_GET["colore"];
}
if($colore > count($templateParams["colori"])) {

}

$templateParams["maglieFiltrate"] = $dbh->getFilteredShirts($generi, $colore);

require 'template/base.php';
?>