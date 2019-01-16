<?php
session_start();
require_once("../../dev/autoload.php");
require_once("../account/authenticate.php");
$return = $_SERVER['HTTP_REFERER'];
if($_POST){
	$shipping = new Shipping;
	$shipping->getState(General::sanitiseInput($_POST['state']));
	$shipping->getCity(General::sanitiseInput($_POST['city']));
	$shipping->getCountry(General::sanitiseInput($_POST['country']));
	$shipping->getAddress(General::sanitiseInput($_POST['address']));
	$shipping->getPhone(General::sanitiseInput($_POST['phone']));
	$shipping->getLandmark(General::sanitiseInput($_POST['landmark']));
	$shipping->getCustomerId($_SESSION['customerid']);

	if($shipping->saveShippingAddress()){
		$_SESSION['success'] = "Shipping Address Saved";
		General::redirectTo("../../cart.php");
	}else{
		$_SESSION['error'] = "Unable to save shipping address";
		General::redirectTo($return);
	}
}
?>
