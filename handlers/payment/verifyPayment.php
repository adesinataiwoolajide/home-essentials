<?php
session_start();
require_once("../../dev/autoload.php");
require_once("../account/authenticate.php");
$payment = new Payment;
$notification = new Notifications;

$payment->tellerNumber = General::sanitiseInput($_POST['teller-number']);
$payment->tellerName = General::sanitiseInput($_POST['teller-name']);
$payment->orderId = General::sanitiseInput($_POST['order-id']);
$payment->getCustomerId(General::sanitiseInput($_SESSION['customerid']));
$payment->getAmount(General::sanitiseInput($_POST['amount']));
$payment->status = 0;
if($payment->saveBankPaymentDetails()){

	//notify admin
	$notification->notification = "Bank verification details uploaded for order #".$_POST['order-id'];
	$notification->receiver = "Admin";
	$notification->status = 0;
	$notification->addNotification();

	$_SESSION['success'] = "Payment details added and admin has been notified.";
	General::redirectTo("../../orders.php");
}else{
	$_SESSION['error'] = "Unable to verify payment. Please try again";
	General::redirectTo("../../orders.php");
}

?>