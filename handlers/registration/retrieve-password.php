<?php
	session_start();
	require_once '../../connection/connection.php';
	require_once '../../dev_class/register/customer_registration_class.php';
	require_once '../../dev/general/all_purpose_class.php';
	$all_purpose = new all_purpose($db);
	$register = new newCustomerRegistration($db);
	try {
		
		if(isset($_POST['retrieve-password'])){
			$user_name = $all_purpose->sanitizeInput($_POST['user_name']);
			$reg_number = $all_purpose->sanitizeInput($_POST['user_name']);
			if($register->forgotPassword($user_name)){
				$_SESSION['error'] = "Ooops! $user_name Does Not Exist";
				$all_purpose->redirect("../../forgot-password.php");
			}else{
				$myDetails = $register->gettingUserCredential($user_name);
				$full_name = $myDetails['full_name'];
				$number = $myDetails['reg_number'];
				$user = $myDetails['user_name'];
				$_SESSION['success'] = "$full_name Please Kindly Update Your Details Below";
				$all_purpose->redirect("../../update-password.php?user_name=$user&&reg_number=$number");
			}
		}else{
			$_SESSION['error'] = "Please Fill The Below Form To Retrieve Your Account";
			$all_purpose->redirect("../../forgot-password.php");
		}
	} catch (PDOException $e) {
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect("../../forgot-password.php");
	}

?>