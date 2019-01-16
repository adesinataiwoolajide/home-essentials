<?php
session_start();
require_once("../../dev/autoload.php");
$sku = $_GET['sku'];
unset($_SESSION['relaxway'][$sku]);
$_SESSION['success'] = "Product removed from your relaxway shopping bag";
General::redirectTo("../../relaxway.php");
?>