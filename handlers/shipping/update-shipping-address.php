<?php
session_start();
require_once '../../connection/connection.php';
require_once '../../dev_class/register/customer_registration_class.php';
require_once '../../dev/general/all_purpose_class.php';
$all_purpose = new all_purpose($db);
$register = new newCustomerRegistration($db);
$return = $_SERVER['HTTP_REFERER'];
try{
	if(isset($_POST['update-address'])){
		$customer_id = $_POST['customer_id'];
		$email = $_SESSION['user_name'];
		//$customer_id = $_SESSION['reg_number'];
		$phone =  $all_purpose->sanitizeInput($_POST['phone']);
		$address =  $all_purpose->sanitizeInput($_POST['address']);
		$landmark =  $all_purpose->sanitizeInput($_POST['landmark']);
		$state =  $all_purpose->sanitizeInput($_POST['state']);
		$city = $state;
	
		if(!empty($register->updateTheShippingAddress($customer_id, $phone, $address, $landmark, $state, $city))){
			$action= "$user_name Changed His Shipping Address on the website";
			$his= $all_purpose->operationHistory($action, $email);
			$_SESSION['success'] = "Shipping Address Updated Successfully";
			$all_purpose->redirect($return);
		}else{
			$_SESSION['success'] = "Shipping Address Updated Successfully";
			//$all_purpose->redirect("../../cart.php");
			$all_purpose->redirect($return);
		}
	
	}else{
		$_SESSION['error'] = "Please Update Your Shipping Address Below";
		$all_purpose->redirect($return);
	}
} catch (PDOException $e) {
	echo $e->getMessage();
	$all_purpose->redirect($return);
}
?>
