<?php
session_start();
require_once("../../dev/autoload.php");
$product = new Products();
$sku = $_GET['sku'];
$quantity = $_GET['quantity'];

foreach($_SESSION['cart'] as $k => $v){
	if($k == $sku){
		$_SESSION['cart'][$k]['quantity'] = $quantity;
	}
}
$_SESSION['success'] = "Product quantity updated successfully";
echo "true";
?>