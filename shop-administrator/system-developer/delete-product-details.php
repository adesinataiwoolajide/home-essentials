<?php
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require '../../libs_dev/products/products_class.php';
	try{
		$all_purpose = new all_purpose($db);
		$productsCate = new ragzNationProductsCategory($db);
		$productDetails = new ragzNationProducts($db);
		if(isset($_GET['product_number'])){
			$email = $_SESSION['user_name'];
			$product_number = $_GET['product_number'];
			
			if($productDetails->deleteProductsDet($product_number) and ($productDetails->deleteProductsDetails($product_number)))
			{
				$action= "Deleted $product_number From The Products List";
				$his= $all_purpose->operationHistory($action, $email);
				$_SESSION['success']=strtoupper("You Have Deleted $product_number From The Products List Successfully");
				$all_purpose->redirect("view-all-products.php");
			}else{
				$_SESSION['error'] = strtoupper("Unable To Delete $product_number to The Products at The Moment, Please Try Again Later");
				$all_purpose->redirect("view-all-products.php");
			}
		}else{
			$_SESSION['error'] = strtoupper("Please Click on The Trash Icon To Delete The Products Details");
			$all_purpose->redirect("view-all-products.php");
		}
	}catch(PDOException $e){
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect("view-all-products.php");
	}