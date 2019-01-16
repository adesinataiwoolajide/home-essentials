<?php
session_start();
$returnUrl = $_SERVER['HTTP_REFERER'];
require_once("../../dev/autoload.php");
$product = new Products();
$product->sku = $_GET['sku'];

//get product details from db
$productDetails = $product->getSingleProductWithSku();

//create array from product details
$itemArray = array(
	$productDetails["pcode"] => array(
		'name'=>$productDetails["pname"], 
		'code'=>$productDetails["pcode"], 
		'price'=>$productDetails["amount"],
		'quantity' => 1
	)
);


if(!empty($_SESSION['cart'])){
	if(in_array($productDetails["pcode"], array_keys($_SESSION['cart']))){		
		foreach(($_SESSION['cart']) as $k => $v){
			if($_SESSION['cart'][$k]['code'] == $productDetails['pcode']){
				$_SESSION['cart'][$k]['quantity'] += 1 ;
			}
		}
	}else{
		$_SESSION["cart"] = array_merge($_SESSION["cart"],$itemArray);
	}
}else{
	$_SESSION["cart"] = $itemArray;
}
// echo "<pre>";
// print_r($_SESSION['cart']);
// echo "</pre>";
$_SESSION['success'] = $productDetails["pname"]." added to your shopping bag";
General::redirectTo($returnUrl);
?>