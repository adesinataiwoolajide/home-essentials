<?php
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require("../../dev/registration/class_registration.php");
	require '../../libs_dev/products/products_class.php';
	require '../../libs_dev/merchant/merchant_class.php';
	try{
		$all_purpose = new all_purpose($db);
		$merchantDetails = new productMerchant($db);
		$productDetails = new ragzNationProducts($db);
		$adminDetails = new staffRegistration($db);
		if(isset($_GET['merchant_number'])){
			$email = $_SESSION['user_name'];
			$merchant_number = $_GET['merchant_number'];
			$details = $merchantDetails->gettingMerchantDelatils($merchant_number);
			$merchant_name = $details['merchant_name'];
			$merchant_email = $details['merchant_email'];
			$users = $merchant_email;
			$admin = $adminDetails->gettingUserDetails($users);
			$staff_email = $admin['user_name'];
			if(($adminDetails->deleteAdminDetails($staff_email)) AND ($merchantDetails->deleteMarchantDetails($merchant_number))){
				$action= "Deleted $merchant_name with the Merchant number $merchant_number From The Merchant List";
				$his= $all_purpose->operationHistory($action, $email);
				$_SESSION['success'] = "You Have Deleted $merchant_name From The Merchant List Successfully";
				$all_purpose->redirect("add-merchant.php");
			}else{
				$_SESSION['error'] = "Unable To Delete $merchant_name From the Merchant List AL the moment, Please Try Again Later";
				$all_purpose->redirect("add-merchant.php");
			}

		}else{
			$_SESSION['error'] = "Please Click On The Red Trash ICON To Delete The Merchant Details";
			$all_purpose->redirect("add-merchant.php");
		}
	}catch(PDOException $e){
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect("add-merchant.php");
	}