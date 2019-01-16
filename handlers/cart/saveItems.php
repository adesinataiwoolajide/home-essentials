<?php
session_start();
require_once("../../dev/autoload.php");
require_once("../account/authenticate.php");
$order = new Order;
$order->getCustomerId($_SESSION['customerid']);
$order->getOrderId($_SESSION['transactionId']);
$order->getPaymentMode(2);
$order->getNumberOfGoods($_POST['goods']);
$order->getShippingCharges($_POST['shipping']);
$order->paidStatus(0);
$order->getOrderStatus(0);
$count = count($order->getSingleOrder());
if($count == 0){
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
	}
}
echo "true";
?>