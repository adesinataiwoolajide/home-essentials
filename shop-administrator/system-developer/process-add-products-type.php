<?php
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require '../../libs_dev/products/products_class.php';
	try{
		$all_purpose = new all_purpose($db);
		$productsCate = new ragzNationProductsCategory($db);
		if(isset($_POST['adding-type'])){
			$email = $_SESSION['user_name'];
			$type_name = $all_purpose->sanitizeInput($_POST['type_name']);
			$category_id = $all_purpose->sanitizeInput($_POST['category_id']);
			$deed = $productsCate->getCategoryDetailsId($category_id);
			$category_name = $deed['category_name'];
			//$type_name = strtoupper($type);
				
			if($productsCate->checkDuplicateProductsType($type_name, $category_id)){
				$_SESSION['error'] = strtoupper("You Have Added $type_name To This $category_name Before");
				$all_purpose->redirect("add-products-type.php");
			}else{
				if($productsCate->addingNewProductsType($type_name, $category_id)){
					$action= "Added $type_name To The $category_name";
					$his= $all_purpose->operationHistory($action, $email);
					$_SESSION['success']= strtoupper("You Have Added $type_name To This $category_name  Successfully");
					$all_purpose->redirect("view-all-products-types.php");
				}else{
					$_SESSION['error'] = strtoupper("Unable To Add $type_name to The products Type List at The Moment, Please Try Again Later");
					$all_purpose->redirect("add-products-type.php");
				}
			}
		}else{
			$_SESSION['error'] = strtoupper("Please Fill The Below Form To Add The products Type");
			$all_purpose->redirect("add-products-type.php");
		}
	}catch(PDOException $e){
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect("add-products-type.php");
	}