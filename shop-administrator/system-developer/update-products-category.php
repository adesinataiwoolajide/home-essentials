<?php
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require '../../libs_dev/products/products_class.php';
	try{
		$all_purpose = new all_purpose($db);
		$productsCate = new ragzNationProductsCategory($db);
		if(isset($_POST['update-category'])){
			$email = $_SESSION['user_name'];
			$category_name = $all_purpose->sanitizeInput($_POST['category_name']);
			//$category_name = strtoupper($category);
			$prev_name = $_POST['prev_category_name'];
			$category_id=$_POST['category_id'];
			
			if($productsCate->updateCategory($category_name, $category_id)){
				$action= "Changed The Product Category Name From $prev_name to $category_name";
				$his= $all_purpose->operationHistory($action, $email);
				$_SESSION['success']= strtoupper("You Have Changed The Product Category Name From $prev_name to $category_name Successfully");
				$all_purpose->redirect("view-all-products-categories.php");
			}else{
				$return = $_POST['return'];
				$_SESSION['error'] = strtoupper("Unable To Update $category_name to The products Category List at The Moment, Please Try Again Later");
				$all_purpose->redirect($return);
			}
		}else{
			$return = $_POST['return'];
			$_SESSION['error'] = strtoupper("Please Fill The Below Form Update The products Category Details");
			$all_purpose->redirect($return);
		}
	}catch(PDOException $e){
		$return = $_POST['return'];
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect($return);
	}