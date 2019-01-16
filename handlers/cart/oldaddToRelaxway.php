<?php
session_start();
$returnUrl = $_SERVER['HTTP_REFERER'];
require_once("../../dev/autoload.php");
$product = new Products();
$product->sku = $_GET['sku'];
if(isset($_GET['sizes'])){
	$sizes = $_GET['sizes'];
}else{
	$sizes = "";
}

//get product details from db
$productDetails = $product->getSingleProductWithSku();
//create array from product details
$itemArray = array(
	$productDetails["pcode"] => array(
		'name'=>$productDetails["pname"], 
		'code'=>$productDetails["pcode"], 
		'price'=>$productDetails["amount"],
		'quantity' => 1,
		'sizes' => array($sizes)
	)
);

// echo $productDetails['pcode'];
// echo "<pre>";
// print_r($_SESSION['relaxway']);
// echo "</pre>";
// die();
if(!empty($_SESSION['relaxway'])){
	if(in_array($productDetails["pcode"], array_keys($_SESSION['relaxway']))){	
	//echo 2;	
		foreach(($_SESSION['relaxway']) as $k => $v){
			
			if($_SESSION['relaxway'][$k]['code'] == $productDetails['pcode']){
				if($_SESSION['relaxway'][$k]['sizes'] == $sizes){
					//echo 3;
					$_SESSION['relaxway'][$k]['quantity'] += 1 ;
				}else{
					//echo 4;
					$_SESSION['relaxway'][$k]['quantity'] += 1 ;
					array_push($_SESSION['relaxway'][$k]['sizes'], $sizes);
				}
			}
		}
	}else{
		//echo 5;
		$_SESSION["relaxway"] = array_merge($_SESSION["relaxway"],$itemArray);
	}
}else{
	//echo 6;
	$_SESSION["relaxway"] = $itemArray;
}
//var_dump($_SESSION['relaxway']);
$_SESSION['success'] = ucwords($productDetails["pname"])." added to your relaxway shopping bag";
General::redirectTo($returnUrl);
?>