<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Kits - Home";
$templateParams["nome"] = "home.php";
$templateParams["admin"] = $dbh->getAdmins();
//Home Template
$templateParams["consigliati"] = getSuggestedProducts();
$templateParams["js"] = array("js/jquery-1.11.3.min.js","js/consigliati.js");

require 'template/base.php';
?>