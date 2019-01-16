<?php
session_start();
$returnUrl = $_SERVER['HTTP_REFERER'];
require_once("../../dev/autoload.php");
$product = new Products();
$product->sku = $_GET['sku'];

//get product details from db
$productDetails = $product->getSingleProductWithSku();
$itemArray = array(
	$productDetails['pcode'] => array(
		'name' => $productDetails["pname"], 
		'productcode' => $productDetails["pcode"], 
		'product_price' => isset($productDetails['discounted_price']) ? $productDetails['discounted_price'] : $productDetails['amount'],
		'quantity' => 1
	)
);

	if(!empty($_SESSION["relaxway"])) {
		if(in_array($productDetails['pcode'],array_keys($_SESSION["relaxway"]))) {
			foreach(($_SESSION['relaxway']) as $k => $v){
				if($_SESSION['relaxway'][$k]['productcode'] == $productDetails['pcode']){
						$_SESSION['relaxway'][$k]['quantity'] += 1;
				}
			}
		} else {
			$_SESSION["relaxway"] += $itemArray;
		}
	} else {
		$_SESSION["relaxway"] = $itemArray;
	}

$_SESSION['success'] = ucwords($productDetails["pname"])." added to your relaxway shopping bag";
General::redirectTo($returnUrl);

// echo "<pre>";
// print_r($_SESSION["relaxway"]);
// echo "</pre>";


// //unset($_SESSION['relaxway']);
?>