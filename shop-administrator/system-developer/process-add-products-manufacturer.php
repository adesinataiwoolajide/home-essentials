<?php 
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require '../../libs_dev/products/products_class.php';
	try{
		$all_purpose = new all_purpose($db);
		$productsCate = new ragzNationProductsCategory($db);
    	$dir = "../../manufacturer-logo//";
	   	
	    $file_name = $_FILES['image']['name'];
	    $file_size =$_FILES['image']['size'];
	    $file_tmp =$_FILES['image']['tmp_name'];
	    $file_type=$_FILES['image']['type'];
	    $file_ext = pathinfo($file_name);
	    $ext = $file_ext['extension'];
	    $extensions= array("jpeg","jpg","png", "JPEG", "JPG", "PNG");
	    
	    if(!(in_array($ext,$extensions))){
	    	$_SESSION['error']="Image Extension not allowed, Please choose a JPEG or PNG file.";
	        $all_purpose->redirect("add-products-manufacturer.php");	
     	}
		if($file_size > 2097152){
          	$_SESSION['error'] = 'File size must be not greater than 2 MB';
          	$all_purpose->redirect("add-products-manufacturer.php");	
    	}else{
        
	        
	    	if(isset($_POST['adding_manufacturer'])){
	    		$email = $_SESSION['user_name'];
	    		$manufacturer_name = $all_purpose->sanitizeInput($_POST['manufacturer_name']);
	    		//$manufacturer_name = strtoupper($manufacturername);
				$manufacturer_logo = $file_name;

	    		if($productsCate->checkDuplicateProductsManu($manufacturer_name)){
	    			$_SESSION['error']="You Have Added $manufacturer_name To The Manufacturer List Before";
	    			$all_purpose->redirect("add-products-manufacturer.php");
	    		}elseif($productsCate->checkDuplicateProductsManuLogo($manufacturer_logo)){
	    			$_SESSION['error']="This Logo is in Use By Another Manufacturer, Please Kindly use another Image or Rename This One And Try Again";
	    			$all_purpose->redirect("add-products-manufacturer.php");	
	    		}else{
	    			
		    		if(!empty($productsCate->addingNewProductsManufacturer($manufacturer_name, $manufacturer_logo))){
		    			$move= move_uploaded_file($file_tmp, $dir.$file_name);
		    			$action =strtoupper("Added $manufacturer_name To The Manufacturer List");
						$his = $all_purpose->getUserDetailsandAddActivity($email, $action);
						$_SESSION['success'] = strtoupper("Added $manufacturer_name To The Manufacturer List Successfully");
						$all_purpose->redirect("view-all-products-manufacturers.php");

		    		}else{
		    			$_SESSION['error'] = strtoupper("Unable to Add $manufacturer_name To The Manufacturer List at the Moment, Please try again later");
						$all_purpose->redirect("add-products-manufacturer.php");
		    		}
		    	}
	    	}else{
	    		$_SESSION['error'] = strtoupper("Please Fill The Below Form To Add Manufacturer Details");
	    		$all_purpose->redirect("add-products-manufacturer.php");
	    	}

	    }

    }catch(PDOException $e){
    	$_SESSION['error'] = $e->getMessage();
    	$all_purpose->redirect("add-products-manufacturer.php");
    }
?>