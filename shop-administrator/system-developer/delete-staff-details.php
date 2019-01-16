<?php 
	session_start();
	require("../../connection/connection.php");
    include("../../libs_dev/staffs/staff_class.php");
    include("../../dev/general/all_purpose_class.php");
    include("../../dev/registration/class_registration.php");
    require '../../libs_dev/products/products_class.php';
    
    try{
    	$staff_details = new ragzNationStaffDetails($db);
    	$all_purpose = new all_purpose($db);
    	$registration = new staffRegistration($db);
    	$productDetails = new ragzNationProducts($db);
    	
		if(isset($_GET['staff_email'])){
			$email = $_SESSION['user_name'];
			$staff_email = $_GET['staff_email'];
			$staff_number = $_GET['staff_number'];
			$staffDetails = $staff_details->gettingStafftEmail($staff_email);
			$staff_name = $staffDetails['staff_name'];

			if(!empty($staff_details->deleteStaffDetails($staff_number))AND($registration->deleteAdminDetails($staff_email))){
				$action ="Deleted $staff_number Details";
				$his = $all_purpose->getUserDetailsandAddActivity($email, $action);
				$_SESSION['success'] = "You Have Deleted Staff $staff_name with the Staff Number $staff_number Details From the Staff List Successfully";
				$all_purpose->redirect("view-all-staff.php");
    		}else{
    			$_SESSION['error'] = "Unable to Delete Staff $staff_name Details at the Moment, Please try again later";
				$all_purpose->redirect("view-all-staff.php");	
    		}
	
		}else{
			$_SESSION['error'] = "Error in Deleting The Staff Details";
			$all_purpose->redirect("view-all-staff.php");
		}


    }catch(PDOException $e){
    	$_SESSION['error'] = $e->getMessage();
    	$all_purpose->redirect("view-all-staff.php");
    }
?>