<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Kits";
$templateParams["nome"] = "prodotto.php";
//Home Template
$templateParams["maglia"] = $dbh->getProductById($_GET["idMaglia"])[0];

require 'template/base.php';
?>