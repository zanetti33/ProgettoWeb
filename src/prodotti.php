<?php
require_once 'bootstrap.php';
require_once 'utils/functions.php';

//Base Template
$templateParams["titolo"] = "Kits";
$templateParams["nome"] = "lista-prodotti.php";
//Home Template

//DA MODIFICARE I PARAMETRI
$templateParams["maglieFiltrate"] = $dbh->getFilteredShirts(array(1, 2, 3), 5);

require 'template/base.php';
?>