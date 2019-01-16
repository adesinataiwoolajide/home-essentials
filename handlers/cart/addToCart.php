<?php
session_start();
include_once("../../connection/connection.php");
require '../../libs_dev/products/products_class.php';
require_once '../../dev/general/all_purpose_class.php';
$returnUrl = $_SERVER['HTTP_REFERER'];
$all_purpose = new all_purpose($db);
$product = new ragzNationProducts($db);

	if(isset($_GET['product_number'])){
		$product_number = $_GET['product_number'];
		$_SESSION['product_number']  = $product_number;
		echo $_SESSION['price'] = $_GET['product_price'];
		$productDetails = $product->getProductsDetails($product_number);
		$ragzProduct = $product->getProductsDet($product_number);
		$_SESSION['quantity'] = $_GET['quantity'];

		$itemArray = array(
		$productDetails["product_number"] => array(
			'product_number' => $_SESSION['product_number'],
			'name'=> $ragzProduct["product_name"], 
			'price'=> $_SESSION['price'],
			'quantity' => 1,
			)
		);

		if(!empty($_SESSION['cart'])){
			
			if(in_array($product_number, array_keys($_SESSION['cart']))){		
				foreach(($_SESSION['cart']) as $k => $v){
					
					if($_SESSION['cart'][$k]['product_number'] == $productDetails['product_number']){
						if($_SESSION['cart'][$k]['quantity'] == $_SESSION['quantity']){
							$_SESSION['cart'][$k]['quantity'] += 1 ;
						}else{
							$_SESSION['cart'][$k]['quantity'] += 0;
						}
					}
				}
			}else{
				$_SESSION["cart"] += $itemArray;	
			}
		}else{
			$_SESSION["cart"] = $itemArray;
		}
		$_SESSION['success'] = strtoupper(ucwords($ragzProduct["product_name"])." added to your shopping bag");
		$all_purpose->redirect($returnUrl);
	}else{
		$_SESSION['error'] = "Please Click On Your Preferred Product";
		$all_purpose->redirect($returnUrl);
	}


?>