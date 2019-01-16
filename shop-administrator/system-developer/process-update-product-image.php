<?php
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require '../../libs_dev/products/products_class.php';
	try{
		$all_purpose = new all_purpose($db);
		$productsCate = new ragzNationProductsCategory($db);
		$productDetails = new ragzNationProducts($db);
		
	   	$dir1 = "../../images/product/small-image/";
	   	
	    $file_name = $_FILES['image']['name'];
	    $file_size =$_FILES['image']['size'];
	    $file_tmp =$_FILES['image']['tmp_name'];
	    $file_type=$_FILES['image']['type'];
	    $file_ext = pathinfo($file_name); 

		if(isset($_POST['update-product'])){
			$email = $_SESSION['user_name'];

			$product_number = $_POST['product_number'];
			$ragzProduct = $productDetails->getProductsDet($product_number);
			$product_name = $ragzProduct['product_name'];
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
				$move= move_uploaded_file($file_tmp, $dir1.$file_name);
				$product_thumbnail = $file_name;
				if(!empty($productDetails->updateNewProductThumbImage($product_number, $product_thumbnail))){
					$action = "Changed $product_name with Product Number $product_number Thumbnail Image";
					$his = $all_purpose->getUserDetailsandAddActivity($email, $action);
					$_SESSION['success'] = "You Have Changed $product_name with Product Number $product_number Thumbnail Image successfully";
					$all_purpose->redirect("product-details.php?product_number=$product_number");
					
				}else{
					$return = $_POST['return'];
					$_SESSION['error'] = strtoupper("Unable To Update The Product Image at The Moment, Please Try Again Later");
					$all_purpose->redirect("$return");
				}
			
			}
				
		}else{
			$return = $_POST['return'];
			$_SESSION['error'] = strtoupper("Please Fill The Below Form To Update The Product Iamge");
			$all_purpose->redirect("$return");
		}
	

	}catch(PDOException $e){
		$return = $_POST['return'];
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect("$return");
	}