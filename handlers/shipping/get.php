<?php
session_start();
require_once("../../dev/autoload.php");
$shipping = new Shipping;
$shipping->locationId = $_GET['state'];
echo $shipping->getCustomerShippingLocationCharge2();
?>