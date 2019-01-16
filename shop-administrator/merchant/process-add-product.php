<?php
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require '../../libs_dev/products/products_class.php';
	try{
		$all_purpose = new all_purpose($db);
		$productsCate = new ragzNationProductsCategory($db);
		$productDetails = new ragzNationProducts($db);
		$dir = "../../assets/images/products-images/large-image/";
	   	
	    $file_name = $_FILES['image']['name'];
	    $file_size =$_FILES['image']['size'];
	    $file_tmp =$_FILES['image']['tmp_name'];
	    $file_type=$_FILES['image']['type'];
	    $file_ext = pathinfo($file_name);
	    $ext = $file_ext['extension'];
	    $extensions= array("jpeg","jpg","png", "JPEG", "JPG", "PNG");
	    
	    if(!(in_array($ext,$extensions))){
	    	$_SESSION['error']="Image Extension not allowed, Please choose a JPEG or PNG file.";
	        $all_purpose->redirect("add-products.php");	
     	}
		if($file_size > 2097152){
          	$_SESSION['error'] = 'File size must be not greater than 2 MB';
          	$all_purpose->redirect("add-products.php");	
    	}else{
			if(isset($_POST['adding-product'])){
				$email = $_SESSION['user_name'];
				$productname = $all_purpose->sanitizeInput($_POST['product_name']);
				$manufacturer_id = $all_purpose->sanitizeInput($_POST['manufacturer_id']);
				$category_id = $all_purpose->sanitizeInput($_POST['category_id']);
				$product_name = strtoupper($productname);

				$number_type = "Products";
				$month = date("m");
				$number_year = date("Y");
				$year_number = $number_year;
				//$break = substr($number_year, 2,2);
				$category = $number_type;
				$day = date("d");

				$getting = $db->prepare("SELECT * FROM generated_numbers WHERE year_number=:number_year AND number_type=:number_type AND month=:month ORDER BY last_id DESC LIMIT 0,1");
				$arrget= array(':number_year'=>$number_year, ':number_type'=>$number_type, ':month'=>$month);
				$getting->execute($arrget);
				if($getting->rowCount()==0){
					$new_number = 0;
					$adding = $new_number+1;
				}else{
					$see_last = $getting->fetch();
					$conf = $see_last['last_number'];
					$adding = $conf+1;
				}
				$code_name = $number_year.$month.$day;
				if(strlen($adding)>2){
					$dot="";
				}else{
					$dot ="00";
				}
				$product_number =$code_name.$dot.$adding;
				$last_number = $dot.$adding;
				$move= move_uploaded_file($file_tmp, $dir.$file_name);
				$product_image = $file_name;
				if(!empty($productDetails->addNewProductDetails($product_name, $product_number, $product_image, $category_id, $manufacturer_id)) AND ($productDetails->insertingTheGenLastNumber($number_type, $year_number, $month, $last_number))){
					$action= "Added $product_name with the product number $product_number To The Products List";
					$his= $all_purpose->operationHistory($action, $email);
					$_SESSION['success']= strtoupper("You Have Added $product_name with the product number $product_number To The Products List Successfully");
					$all_purpose->redirect("adding-products-details.php?product_number=$product_number");
				}else{
					$_SESSION['error'] = strtoupper("Unable To Add $product_name to The products List at The Moment, Please Try Again Later");
					$all_purpose->redirect("add-products.php");
				}
			}else{
				$_SESSION['error'] = strtoupper("Please Fill The Below Form To Add The Products Details");
				$all_purpose->redirect("add-products.php");
			}
		}
	}catch(PDOException $e){
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect("add-products.php");
	}