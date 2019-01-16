<?php
session_start();
require_once("../../dev/autoload.php");
$relaxway = new Relaxway;
$mail = new Email;

$name = General::sanitiseInput($_POST['name']);
$email = General::sanitiseInput($_POST['email']);
$phone = General::sanitiseInput($_POST['phone']);
$address = General::sanitiseInput($_POST['address']);
$workplace = General::sanitiseInput($_POST['workplace']);
$product_id = General::sanitiseInput($_POST['pcode']);
$details = General::sanitiseInput($_POST['pname']);
$date_added = General::sanitiseInput($_POST['date']);
$price = General::sanitiseInput($_POST['pprice']);
$run = $relaxway->saveRelaxwayDetails($name, $email, $phone, $address, $workplace, $product_id, $details, $price, $date_added);
if($run){
	$_SESSION['success'] = "Order saved successfully";

	$mail->addRecipient(General::sanitiseInput($_POST['email']));
	$mail->getSubject("Relaxway Details");
	$mail->sendRelaxWayData($name, $email, $phone, $address, $workplace, $product_id, $details, $price, $date_added);
	unset($_SESSION['relaxway']);
	General::redirectTo("../../relaxway.php");
}else{
	$_SESSION['error'] = "Unable to save order";
	General::redirectTo("../../relaxway.php");
}

?>