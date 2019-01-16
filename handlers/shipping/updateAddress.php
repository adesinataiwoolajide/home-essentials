<?php
session_start();
require_once("../../dev/autoload.php");
require_once("../account/authenticate.php");
if($_POST){
	$shipping = new Shipping;
	$shipping->getState(General::sanitiseInput($_POST['state']));
	$shipping->getCountry(General::sanitiseInput($_POST['country']));
	$shipping->getAddress(General::sanitiseInput($_POST['address']));
	$shipping->getPhone(General::sanitiseInput($_POST['phone']));
	$shipping->getLandmark(General::sanitiseInput($_POST['landmark']));
	$shipping->getCity(General::sanitiseInput($_POST['city']));



	
	$shipping->getCustomerId($_SESSION['customerid']);

	if($shipping->updateShippingAddress()){
		$_SESSION['success'] = "Shipping Address Updated";
		General::redirectTo("../../shipping-address.php");
	}else{
		$_SESSION['error'] = "Unable to update shipping address";
		General::redirectTo("../../shipping-address.php");
	}
}
?>
