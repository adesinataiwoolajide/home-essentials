<?php
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require '../../libs_dev/products/products_class.php';
	try{
		$all_purpose = new all_purpose($db);
		$productsCate = new ragzNationProductsCategory($db);
		if(isset($_POST['adding-category'])){
			$email = $_SESSION['user_name'];
			$category_name = $all_purpose->sanitizeInput($_POST['category_name']);
			//$category_name = strtoupper($category);
				
			if($productsCate->checkDuplicateProductsName($category_name)){
				$_SESSION['error'] = strtoupper("You Have Added $category_name To The products Category List Before");
				$all_purpose->redirect("add-products-category.php");
			}else{
				if($productsCate->addingNewProductsCategory($category_name)){
					$action= "Added $category_name To The Products Category List";
					$his= $all_purpose->operationHistory($action, $email);
					$_SESSION['success']= strtoupper("You Have Added $category_name To The products Category Successfully");
					$all_purpose->redirect("view-all-products-categories.php");
				}else{
					$_SESSION['error'] = strtoupper("Unable To Add $category_name to The products Category List at The Moment, Please Try Again Later");
					$all_purpose->redirect("add-products-category.php");
				}
			}
		}else{
			$_SESSION['error'] = strtoupper("Please Fill The Below Form To Add The products Category");
			$all_purpose->redirect("add-products-category.php");
		}
	}catch(PDOException $e){
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect("add-products-category.php");
	}