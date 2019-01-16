<?php
session_start();
require_once("../../dev/autoload.php");
require_once("../account/authenticate.php");
$orders = new Order;

$orders->getOrderId(General::sanitiseInput($_POST['order']));
$newOrderId = General::generateRandomHash(16);
$orders->newOrderId = $newOrderId;
$orders->updateCustomerOrderId();
$orders->updateCustomerOrderDetailsId();
$orders->getPaymentMode(2);

//update customer order and details with new order id because gtb wont allow a formerly failed transaction to go again
if($orders->updatePaymentMode()){
	echo $newOrderId;
}else{
	echo "false";
}
?>