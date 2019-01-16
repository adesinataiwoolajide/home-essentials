<?php
session_start();
require_once("../../dev/autoload.php");
require_once("../account/authenticate.php");
$notifications = new Notifications;
$order = new Order;
$order->getCustomerId($_SESSION['customerid']);
$order->getOrderId($_SESSION['transactionId']);
$order->getPaymentMode(0);
$order->getNumberOfGoods($_POST['goods']);
$order->getShippingCharges($_POST['shipping']);
$order->paidStatus(0);
$order->getOrderStatus(0);
if($order->saveOrder()){

	$cart = $_SESSION['cart'];
	foreach($cart as $key){
		$order->getProductId($key['code']);
		$order->getQuantity($key['quantity']);
		$order->getAmount($key['price']);

		if($key["sizes"][0] != ""){
			$order->sizes = serialize(($key['sizes']));	
		}else{
			$order->sizes = "";	
		}
		
		$order->saveOrderDetails();
	}

	$order->status = 0;
	$order->notifyUnpricedOrders();

	//send request notification to admin
	$notifications->receiver ="Admin";
	$notifications->notification = "New price request for order #".$_SESSION['transactionId'];
	$notifications->status = 0;
	$notifications->addNotification();

	unset($_SESSION['cart']);
	unset($_SESSION['transactionId']);
	echo "true";

}else{
	echo "false";
}
			
?>