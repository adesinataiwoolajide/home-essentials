<?php
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require '../../libs_dev/products/products_class.php';
	try{
		$all_purpose = new all_purpose($db);
		$productsCate = new ragzNationProductsCategory($db);
		if(isset($_GET['type_name'])){
			$email = $_SESSION['user_name'];
			$type_name = $_GET['type_name'];
			$type_id=$_GET['type_id'];
			
			if($productsCate->deleteProductTypeName($type_name, $type_id)){
				$action= "Deleted $type_name From The Products Type List";
				$his= $all_purpose->operationHistory($action, $email);
				$_SESSION['success']=strtoupper("You Have Deleted $type_name From The Products Type List Successfully");
				$all_purpose->redirect("view-all-products-types.php");
			}else{
				$_SESSION['error'] = strtoupper("Unable To Deete $type_name to The Products Type From The at The Moment, Please Try Again Later");
				$all_purpose->redirect("view-all-products-types.php");
			}
		}else{
			$_SESSION['error'] = strtoupper("Please Click on The Trash Icon To Delete The Products Type Details");
			$all_purpose->redirect("view-all-products-types.php");
		}
	}catch(PDOException $e){
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect("view-all-products-types.php");
	}