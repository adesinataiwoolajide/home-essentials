<?php
session_start();
include_once("../../connection/connection.php");
require '../../libs_dev/products/products_class.php';
require_once '../../dev/general/all_purpose_class.php';
$returnUrl = $_SERVER['HTTP_REFERER'];
$all_purpose = new all_purpose($db);
$product = new ragzNationProducts($db);
$product_number = $_GET['product_number'];
$ragzProduct = $product->getProductsDet($product_number);
foreach($_SESSION['cart'] as $k => $v){
	if($k == $product_number){
		unset($_SESSION['cart'][$k]);
	}
}
$product_name = $ragzProduct['product_name'];

// if(count($_SESSION['count']) == 0){
// 	unset($_SESSION['cart']);
// }
$_SESSION['success'] = strtoupper("You Have Removed $product_name from your shopping bag successfully");
$all_purpose->redirect($returnUrl);
?>