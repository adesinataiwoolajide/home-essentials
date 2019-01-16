<?php 
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require '../../libs_dev/products/products_class.php';
	try{
		$all_purpose = new all_purpose($db);
		$productsCate = new ragzNationProductsCategory($db);
    	
    	if(isset($_GET['manufacturer_id'])){
    		$email = $_SESSION['user_name'];
    		$manufacturer_name = $_GET['manufacturer_name'];
    		$manufacturer_id = $_GET['manufacturer_id'];

			if(!empty($productsCate->deleteProductManuName($manufacturer_name, $manufacturer_id))){
				$action= "Deleted The Product Manufacturer Name $manufacturer_name";
				$his= $all_purpose->operationHistory($action, $email);
				$_SESSION['success']= strtoupper("You Have Deleted The Product Manufacturer $manufacturer_name Successfully");
				$all_purpose->redirect("view-all-products-manufacturers.php");
			}else{
    			$_SESSION['error'] = strtoupper("Unable to Delete The Manufacturer Details at the monent, please try again later");
    			$all_purpose->redirect("view-all-products-manufacturers.php");
			}
    	}else{
    		$_SESSION['error'] = strtoupper("Please Click On The Trash ICON To Delete The Manufacturer Details");
    		$all_purpose->redirect("view-all-products-manufacturers.php");
    	}
    }catch(PDOException $e){
    	
    	$_SESSION['error'] = $e->getMessage();
    	$all_purpose->redirect("view-all-products-manufacturers.php");
    }
?>