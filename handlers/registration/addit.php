<?php

	session_start();
	include_once("../../connection/connection.php");
	require '../../libs_dev/products/products_class.php';
	require_once '../../dev/general/all_purpose_class.php';
	$returnUrl = $_SERVER['HTTP_REFERER'];
	$all_purpose = new all_purpose($db);
	$productDetails = new ragzNationProducts($db);
	if(!isset($_SESSION['id'])){
		$_SESSION['error'] = "Please Login To Add/Register Your Wishlist/Compare";
		$all_purpose->redirect($returnUrl);
	}else{
		if(isset($_GET['product_number']) AND ($_GET['action'])){
			$product_number = $_GET['product_number'];
			$customer_id = $_SESSION['reg_number'];
			$action = $_GET['action'];

			$ragzProduct = $productDetails->getProductsDet($product_number);
			$product_name = $ragzProduct['product_name'];

			if(($action == "Delete Wishlist") OR($action == "Delete Compare")){
				$list_id = $_GET['list_id'];
				$del = $db->prepare("DELETE FROM wishlist WHERE product_number=:product_number AND list_id=:list_id");
				$arr = array(':product_number'=>$product_number, ':list_id'=>$list_id);
				if(!empty($del->execute($arr))){
					$_SESSION['success'] = strtoupper("You Have Deleted $product_name From Your List Successfully");
					$all_purpose->redirect($returnUrl);
				}else{
					$_SESSION['error'] = strtoupper("Network Failure, Please Try Again Later");
					$all_purpose->redirect($returnUrl);
				}
			}

			$check = $db->prepare("SELECT * FROM wishlist WHERE product_number=:product_number AND customer_id=:customer_id AND action=:action");
			$arrCheck = array(':product_number'=>$product_number, ':customer_id'=>$customer_id, ':action'=>$action);
			$check->execute($arrCheck);
			if($check->rowCount()>0){
				$_SESSION['error'] = strtoupper("You Have Added $product_name to Your $action List Before");
				$all_purpose->redirect($returnUrl);
			}else{

				$insert= $db->prepare("INSERT INTO wishlist(customer_id, product_number, action)VALUES(:customer_id, :product_number, :action)");
				$arrInsert = array(':customer_id'=>$customer_id, ':product_number'=>$product_number, ':action'=>$action);
				if(!empty($insert->execute($arrInsert))){
					$_SESSION['success'] = strtoupper("You Have Added $product_name to Your $action List");
					$all_purpose->redirect($returnUrl);
				}else{
					$_SESSION['error'] = strtoupper("Error in Adding $product_name to $action List at the moment, Please Try Again Later");
					$all_purpose->redirect($returnUrl);
				}
			}
		}else{
			$_SESSION['error'] = strtoupper("Network Failure, Please Try Again Later");
			$all_purpose->redirect($returnUrl);
		}
	}
?>