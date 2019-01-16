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

		$dir = "../../assets/images/merchant/";	   	
	    $file_name = $_FILES['image']['name'];
	    $file_size =$_FILES['image']['size'];
	    $file_tmp =$_FILES['image']['tmp_name'];
	    $file_type=$_FILES['image']['type'];
	    $file_ext = pathinfo($file_name);

		if(isset($_POST['update_merchant'])){
			$email = $_SESSION['user_name'];
			$merchant_name = $all_purpose->sanitizeInput($_POST['merchant_name']);
			$merchant_email = $all_purpose->sanitizeInput($_POST['merchant_email']);
			$full_name = $all_purpose->sanitizeInput($_POST['full_name']);
			$merchant_number = $_POST['merchant_number'];
			$user_id = $_POST['user_id'];
			$prev_name = $_POST['prev_name'];

			if(empty($file_name)){
				if(!empty($adminDetails->updateUserThedetails($user_id, $full_name)) AND ($merchantDetails->updateMerchantWIthoutLogo($merchant_number, $merchant_name))){
					$action= "Updated The Merchant Name From $prev_name To $merchant_name with the Merchant number $merchant_number From The Merchant List";
					$his= $all_purpose->operationHistory($action, $email);
					$_SESSION['success'] = "Updated The Merchant Name From $prev_name To $merchant_name with the Merchant number $merchant_number From The Merchant List";
					$all_purpose->redirect("add-merchant.php");
				}else{
					$return = $_POST['return'];
					$_SESSION['error'] = "Unable To Delete $merchant_name From the Merchant List AL the moment, Please Try Again Later";
					//$all_purpose->redirect("$return");	
				}
			}else{
				$ext = $file_ext['extension'];
			    $extensions= array("jpeg","jpg","png", "JPEG", "JPG", "PNG");
			    
			    if(!(in_array($ext,$extensions))){
			    	$return = $_POST['return'];
			    	$_SESSION['error']="Image Extension not allowed, Please choose a JPEG or PNG file.";
			        $all_purpose->redirect("$return");	
		     	}
				if($file_size > 2097152){
					$return = $_POST['return'];
		          	$_SESSION['error'] = 'File size must be not greater than 2 MB';
		          	$all_purpose->redirect("$return");	
		    	}else{
		    		$move= move_uploaded_file($file_tmp, $dir.$file_name);
		    		$merchant_logo = $file_name;
					if(!empty($adminDetails->updateUserThedetails($user_id, $full_name)) AND ($merchantDetails->updateMerchantWIthLogo($merchant_number, $merchant_name, $merchant_logo))){
						$action= "Updated The Merchant Name From $prev_name To $merchant_name and Changed The Merchant Logo";
						$his= $all_purpose->operationHistory($action, $email);
						$_SESSION['success'] = "Ypu Have Updated The Merchant Name From $prev_name To $merchant_name and Changed The Merchant Logo Successfully";
						$all_purpose->redirect("add-merchant.php");
					}else{
						$return = $_POST['return'];
						$_SESSION['error'] ="Unable To Delete $merchant_name From the Merchant List AL the moment, Please Try Again Later";
						$all_purpose->redirect("$return");	
					}
				}
			}
		}else{
			$return = $_POST['return'];
			$_SESSION['error'] = "Please Click On The Red Trash ICON To Delete The Merchant Details";
			$all_purpose->redirect("add-merchant.php");
		}
	}catch(PDOException $e){
		$return = $_POST['return'];
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect("$return");	
	}