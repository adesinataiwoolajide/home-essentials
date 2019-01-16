<?php
	session_start();
	require_once '../../connection/connection.php';
	require_once '../../dev_class/register/customer_registration_class.php';
	require_once '../../dev/general/all_purpose_class.php';
	$all_purpose = new all_purpose($db);
	$register = new newCustomerRegistration($db);
	try {
		if(isset($_GET['registration_number'])){
			$reg_number = $all_purpose->sanitizeInput($_GET['registration_number']);
			$status = 1;
			$activate = $register->activateTheUser($reg_number, $status);
			if($activate){
				$_SESSION['success'] = "Account has been activated. Please Login with Your Details";
				redirectTo("../../login.php");
			}else{
				$_SESSION['error'] = "Invalid activation code. Please try again";
				redirectTo("../../login.php");
			}
		}else{
			$_SESSION['error'] = "Please Click On The Link in Your Mail To Activate Your Account";
			$all_purpose->redirect("../../login.php");
		}
	} catch (PDOException $e) {
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect("../../login.php");
	}

?>