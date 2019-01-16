<?php
	session_start();
	require_once '../../connection/connection.php';
	require_once '../../dev_class/register/customer_registration_class.php';
	require_once '../../dev/general/all_purpose_class.php';
	$all_purpose = new all_purpose($db);
	$register = new newCustomerRegistration($db);
	try {
		
		if(isset($_POST['update-account'])){
			$user_name = $_POST['user_name'];
			$email = $user_name;
			$full_name = $all_purpose->sanitizeInput($_POST['full_name']);
			$password = $all_purpose->sanitizeInput(sha1($_POST['password']));
			$repeat = $all_purpose->sanitizeInput(sha1($_POST['repeat']));

			if($password != $repeat){
				$return = $_POST['return'];
				$_SESSION['error'] = "Ooops! Password Does Not Match";
				$all_purpose->redirect($return);
			}else{
				if($register->updateUserdetailsID($user_name, $full_name, $password)){
					$action= "$user_name Retrieved Account";
					$his= $all_purpose->operationHistory($action, $email);
					$_SESSION['success'] = "$full_name You Have Changed Your Password Successfully";
					$all_purpose->redirect("../../login.php");
				}else{
					$return = $_POST['return'];
					$_SESSION['error'] = "Network Failure Please Try Again Later";
					$all_purpose->redirect($return);
				}
			}
		}else{
			$return = $_POST['return'];
			$_SESSION['error'] = "Please Fill The Below Form To Update Your Account";
			$all_purpose->redirect($return);
		}
	} catch (PDOException $e) {
		$return = $_POST['return'];
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect($return);
	}

?>