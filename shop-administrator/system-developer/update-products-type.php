<?php
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require '../../libs_dev/products/products_class.php';
	try{
		$all_purpose = new all_purpose($db);
		$productsCate = new ragzNationProductsCategory($db);
		if(isset($_POST['update-type'])){
			$email = $_SESSION['user_name'];
			$type_name = $all_purpose->sanitizeInput($_POST['type_name']);
			$category_id = $all_purpose->sanitizeInput($_POST['category_id']);
			$deed = $productsCate->getCategoryDetailsId($category_id);
			$category_name = $deed['category_name'];
			//$type_name = strtoupper($type);
			$prev_name = $_POST['prev_type_name'];
			$type_id=$_POST['type_id'];
			
			if($productsCate->updateType($type_name, $category_id, $type_id)){
				$action= "Changed The Product Type Name From $prev_name to $type_name";
				$his= $all_purpose->operationHistory($action, $email);
				$_SESSION['success']= strtoupper("You Have Changed The Product Type Name From $prev_name to $type_name Successfully");
				$all_purpose->redirect("view-all-products-types.php");
			}else{
				$return = $_POST['return'];
				$_SESSION['error'] = strtoupper("Unable To Update $type_name to The products Type List at The Moment, Please Try Again Later");
				$all_purpose->redirect($return);
			}
		}else{
			$return = $_POST['return'];
			$_SESSION['error'] = strtoupper("Please Fill The Below Form Update The pProducts Type Details");
			$all_purpose->redirect($return);
		}
	}catch(PDOException $e){
		$return = $_POST['return'];
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect($return);
	}