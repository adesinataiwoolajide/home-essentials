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
    	$dir = "staff-passport/";
	   	
	    $file_name = $_FILES['image']['name'];
	    $file_size =$_FILES['image']['size'];
	    $file_tmp =$_FILES['image']['tmp_name'];
	    $file_type=$_FILES['image']['type'];
	    $file_ext = pathinfo($file_name);
   
		if(isset($_POST['adding_details'])){
			$email = $_SESSION['user_name'];
			
			$staff_name = $all_purpose->sanitizeInput($_POST['name']);
			$date_birth = $all_purpose->sanitizeInput($_POST['birth']);
			$year_employ = $all_purpose->sanitizeInput($_POST['year_employ']);
			$staff_email = $_POST['staff_email'];
			$staff_sex = $all_purpose->sanitizeInput($_POST['sex']);
			$staff_phone = $all_purpose->sanitizeInput($_POST['phone']);
			$type_id = $all_purpose->sanitizeInput($_POST['type']);
			$address = $all_purpose->sanitizeInput($_POST['address']);
			$marital_status = $all_purpose->sanitizeInput($_POST['status']);
			$state_origin =$all_purpose->sanitizeInput($_POST['state_origin']);
			
			$qualification_id = implode(',', ($_POST['qualification_id']));
			$kin_details = $all_purpose->sanitizeInput($_POST['kin_details']);
			$religion = $all_purpose->sanitizeInput($_POST['religion']);
			$full_name = $staff_name;
			$eemail = $staff_email;
			$password = sha1($eemail);
			
			$access = $type_id;
			$user_id = $_POST['user_id'];
			$staff_number = $_POST['staff_number'];

			if(empty($file_name)){
				if(!empty($staff_details->updateStaffDetailsWithOutPass($staff_number, $staff_name, $date_birth, $year_employ, $staff_email, $staff_sex, $staff_phone, $type_id, $address, $marital_status, $qualification_id, $kin_details, $religion, $state_origin)) AND ($registration->updateUserdetailsWithoutPic($user_id, $full_name, $eemail, $password, $access))){
					$action ="Updated $staff_number Details";
					$his = $all_purpose->getUserDetailsandAddActivity($email, $action);
					$_SESSION['success'] = "You Have Added Staff $staff_name with the Staff Number $staff_number Details to the Staff List Successfully";
					$all_purpose->redirect("staff_details.php?staff_number=$staff_number&&staff_email=$staff_email");
	    		}else{
	    			$return = $_POST['return'];
	    			$_SESSION['error'] = "Unable to Update Staff $staff_name Details at the Moment, Please try again later";
					$all_purpose->redirect("$return");	
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
		    		if(!empty($staff_details->updateStaffDetailsWithImage($file_name, $staff_number, $staff_name, $date_birth, $year_employ, $staff_email, $staff_sex, $staff_phone, $type_id, $address, $marital_status, $qualification_id, $kin_details, $religion, $state_origin)) AND 
		    			($registration->updateUserdetailsWithoutPic($user_id, $full_name, $eemail, $password, $access))){
		    			$action ="Updated $staff_number Details and Changed The Staff Passport";
						$his = $all_purpose->getUserDetailsandAddActivity($email, $action);
						$_SESSION['success'] = "You Have Added Staff $staff_name with the Staff Number $staff_number Details and Change Staff Passport Successfully";
						$all_purpose->redirect("staff_details.php?staff_number=$staff_number&&staff_email=$staff_email");

		    		}else{
		    			$return = $_POST['return'];
		    			$_SESSION['error'] = "Unable to Update Staff $staff_name Details and Change Staff Passport at the Moment, Please try again later";
						$all_purpose->redirect("$return");	
		    		}

		    	}
			}
			
		}else{
			$return = $_POST['return'];
			$_SESSION['error'] = "Error in Updating The Staff Details";
			$all_purpose->redirect("$return");
		}


    }catch(PDOException $e){
    	$return = $_POST['return'];
    	$_SESSION['error'] = $e->getMessage();
    	$all_purpose->redirect("$return");
    }
?>