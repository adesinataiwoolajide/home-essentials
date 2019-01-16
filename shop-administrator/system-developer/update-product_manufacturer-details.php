<?php 
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require '../../libs_dev/products/products_class.php';
	try{
		$all_purpose = new all_purpose($db);
		$productsCate = new ragzNationProductsCategory($db);
    	$dir = "../../manufacturer-logo/";
	   	
	    $file_name = $_FILES['image']['name'];
	    $file_size =$_FILES['image']['size'];
	    $file_tmp =$_FILES['image']['tmp_name'];
	    $file_type=$_FILES['image']['type'];
	    $file_ext = pathinfo($file_name);
	    
        
	        
    	if(isset($_POST['adding_manufacturer'])){
    		$email = $_SESSION['user_name'];
    		$manufacturer_name = $all_purpose->sanitizeInput($_POST['manufacturer_name']);
    		//$manufacturer_name = strtoupper($manufacturername);
    		$manufacturer_id = $_POST['manufacturer_id'];
    		$prev_name = $_POST['prev_manufacturer_name'];
			
			if(empty($file_name)){
				if(!empty($productsCate->updateManuWithoutLogo($manufacturer_name, $manufacturer_id))){
					$action= "Changed The Product Manufacturer Name From $prev_name to $manufacturer_name";
					$his= $all_purpose->operationHistory($action, $email);
					$_SESSION['success']= strtoupper("You Have Changed The Product Manufacturer Name From $prev_name to $manufacturer_name Successfully");
					$all_purpose->redirect("view-all-products-manufacturers.php");
				}else{
					$return = $_POST['return'];
	    			$_SESSION['error'] = strtoupper("Unable to Update The Manufacturer Details at the monent, please try again later");
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
		    		$manufacturer_logo = $file_name;
		    		if(!empty($productsCate->updateManuWithLogo($manufacturer_name, $manufacturer_id, $manufacturer_logo))){
		    			$move= move_uploaded_file($file_tmp, $dir.$file_name);
		    			$action= "Changed The Product Manufacturer Name From $prev_name to $manufacturer_name and Manufacturer Logo";
						$his= $all_purpose->operationHistory($action, $email);
						$_SESSION['success']= strtoupper("You Have Changed The Product Manufacturer Name From $prev_name to $manufacturer_name and Manufacturer Logo Successfully");
						$all_purpose->redirect("view-all-products-manufacturers.php");

		    		}else{
		    			$return = $_POST['return'];
		    			$_SESSION['error'] = strtoupper("Unable to Change The Manufacturer Logo and Name at the monent, please try again later");
		    			$all_purpose->redirect("$return");
		    		}
		    	}
			}
    		
    	}else{
    		$return = $_POST['return'];
    		$_SESSION['error'] = strtoupper("Please Fill The Below Form To Update The Manufacturer Details");
    		$all_purpose->redirect("$return");
    	}


    }catch(PDOException $e){
    	$return = $_POST['return'];
    	$_SESSION['error'] = $e->getMessage();
    	$all_purpose->redirect("$return");
    }
?>