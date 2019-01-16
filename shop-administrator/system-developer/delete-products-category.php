<?php
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require '../../libs_dev/products/products_class.php';
	try{
		$all_purpose = new all_purpose($db);
		$productsCate = new ragzNationProductsCategory($db);
		if(isset($_GET['category_name'])){
			$email = $_SESSION['user_name'];
			$category_name = $_GET['category_name'];
			$category_id=$_GET['category_id'];
			
			if($productsCate->deleteProductCategoryName($category_name, $category_id)){
				$action= "Deleted $category_name From The Products Category List";
				$his= $all_purpose->operationHistory($action, $email);
				$_SESSION['success']=strtoupper("You Have Deleted $category_name From The Products Category List Successfully");
				$all_purpose->redirect("view-all-products-categories.php");
			}else{
				$_SESSION['error'] = strtoupper("Unable To Deete $category_name to The Products Category From The at The Moment, Please Try Again Later");
				$all_purpose->redirect("view-all-products-categories.php");
			}
		}else{
			$_SESSION['error'] = strtoupper("Please Click on The Trash Icon To Delete The Products Category Details");
			$all_purpose->redirect("view-all-products-categories.php");
		}
	}catch(PDOException $e){
	
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect("view-all-products-categories.php");
	}