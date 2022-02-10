<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Kits - Home";
$templateParams["nome"] = "home.php";
//Home Template
$templateParams["consigliati"] = $dbh->mostSold();
$templateParams["js"] = array("js/jquery-1.11.3.min.js","js/consigliati.js");

require 'template/base.php';
?>