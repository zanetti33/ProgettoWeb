<?php
require_once 'bootstrap.php';

//Base Template
$templateParams["titolo"] = "Kits - Home";
$templateParams["nome"] = "home.php";
//Home Template
$templateParams["consigliati"] = true;

require 'template/base.php';
?>