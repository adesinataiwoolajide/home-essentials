<?php 
session_start();
require_once("../../dev/autoload.php");

//store into customer order
$customerid = $_SESSION['customerid'];#
$orderid = $_SESSION['transactionId'];
$num = count($_SESSION['cart']);
$paid = 0;
$order = 0;
$shipping = $_GET['shipping'];




$insert = "INSERT INTO customer_order(customer_id, order_id, num_items, paid_status, order_status, shipping_charge) VALUES ('$customerid', '$orderid', '$num', '$paid', '$order', '$shipping')";
if($insert){
	foreach($_SESSION['cart'] as $items){
		$orderid = 44;
		$poduct = $items['pid'];

		//save
	}
}

echo "true"; 
?>