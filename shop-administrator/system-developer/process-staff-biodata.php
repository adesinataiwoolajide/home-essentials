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
	    $ext = $file_ext['extension'];
	    $extensions= array("jpeg","jpg","png", "JPEG", "JPG", "PNG");
	    
	    if(!(in_array($ext,$extensions))){
	    	$_SESSION['error']="Image Extension not allowed, Please choose a JPEG or PNG file.";
	        $all_purpose->redirect("add-staff-biodata.php");	
     	}
		if($file_size > 2097152){
          	$_SESSION['error'] = 'File size must be not greater than 2 MB';
          	$all_purpose->redirect("add-staff-biodata.php");	
    	}else{
        
	        
	    	if(isset($_POST['adding_details'])){
	    		$email = $_SESSION['user_name'];
	    		
	    		$staff_name = $all_purpose->sanitizeInput($_POST['name']);
	    		$date_birth = $all_purpose->sanitizeInput($_POST['birth']);
	    		$year_employ = $all_purpose->sanitizeInput($_POST['year_employ']);
	    		$staff_email = $all_purpose->sanitizeInput($_POST['staff_email']);
	    		$staff_sex = $all_purpose->sanitizeInput($_POST['sex']);
	    		$staff_phone = $all_purpose->sanitizeInput($_POST['phone']);
	    		$type_id = $all_purpose->sanitizeInput($_POST['type']);
	    		$address = $all_purpose->sanitizeInput($_POST['address']);
	    		$marital_status = $all_purpose->sanitizeInput($_POST['status']);
	    		$state_origin =$all_purpose->sanitizeInput($_POST['state_origin']);
	    		
	    		$qualification_id = implode(',', ($_POST['qualification']));
	    		$kin_details = $all_purpose->sanitizeInput($_POST['kin_details']);
	    		$religion = $all_purpose->sanitizeInput($_POST['religion']);
	    		$full_name = $staff_name;
	    		$eemail = $staff_email;
	    		$password = sha1($eemail);
	    		
	    		$access = $type_id;
	    		$number_type = "Staff";

	    		$getting = $db->prepare("SELECT * FROM generated_numbers WHERE year_number=:year_employ AND number_type=:number_type ORDER BY last_id DESC LIMIT 0,1");
				$arrget= array(':year_employ'=>$year_employ, ':number_type'=>$number_type);
				$getting->execute($arrget);
				if($getting->rowCount()==0){
					$new_number = 0;
					$adding = $new_number+1;
				}else{
					$see_last = $getting->fetch();
					$conf = $see_last['last_number'];
					$adding = $conf+1;
				}
				$code_name = $year_employ;
				if(strlen($adding)>2){
					$dot="";
				}else{
					$dot ="00";
				}
				$staff_number =$code_name.$dot.$adding;
				$last_number = $dot.$adding;
				$month = date('m');
				$year_number = $year_employ;
				$move= move_uploaded_file($file_tmp, $dir.$file_name);

	    		if($staff_details->checkStaffExistenceEmail($staff_email)){
	    			$_SESSION['error']="You Have Added A Staff With this Email $staff_email Before, Please Kindly use another E-Mail And Try Again";
	    			$all_purpose->redirect("add-staff-biodata.php");
	    		}elseif($staff_details->checkStaffExistencePhoneNumber($staff_phone)){
	    			$_SESSION['error']="You Have Added A Staff With this Phone Number $staff_phone Before, Please Kindly use another Phone Number And Try Again";
	    			$all_purpose->redirect("add-staff-biodata.php");	
	    		}else{
		    		if(($staff_details->addNewStaffDetails($file_name, $staff_number, $staff_name, $date_birth, $year_employ, $staff_email, $staff_sex, $staff_phone, $type_id, $address, $marital_status, $qualification_id, $kin_details, $religion, $state_origin)) AND ($registration->userRegistration($full_name, $eemail, $password, $access)) AND ($productDetails->insertingTheGenLastNumber($number_type, $year_number, $month, $last_number))){

		    			$action ="Added $staff_number Details to the Staff List";
						$his = $all_purpose->getUserDetailsandAddActivity($email, $action);
						$_SESSION['success'] = "You Have Added Staff $staff_name with the Staff Number $staff_number Details to the Staff List Successfully";
						$all_purpose->redirect("view-all-staff.php");

		    		}else{
		    			$_SESSION['error'] = "Unable to add Staff $staff_name Details to The Staff List at the Moment, Please try again later";
						$all_purpose->redirect("add-staff-biodata.php");
		    		}
		    	}
	    	}else{
	    		$_SESSION['error'] = "Error in Adding the Staff Passport";
	    		$all_purpose->redirect("add-staff-biodata.php");
	    	}

	    }

    }catch(PDOException $e){
    	$_SESSION['error'] = $e->getMessage();
    	$all_purpose->redirect("add-staff-biodata.php");
    }
?>