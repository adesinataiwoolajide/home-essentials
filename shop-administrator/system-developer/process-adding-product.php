<?php
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require '../../libs_dev/products/products_class.php';
	try{
		$all_purpose = new all_purpose($db);
		$productsCate = new ragzNationProductsCategory($db);
		$productDetails = new ragzNationProducts($db);
		$dir = "../../images/product/small-image/";
	   	
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
				$product_number = $_POST['product_number'];
				
				$product_size = $all_purpose->sanitizeInput($_POST['product_size']);
				$product_price = $all_purpose->sanitizeInput($_POST['product_price']);
				$quantity = $all_purpose->sanitizeInput($_POST['quantity']);
				$product_description = $all_purpose->sanitizeInput($_POST['product_description']);
				$type_id = $_POST['type_id'];
				$category_id = $_POST['category_id'];
				$publish =0;

				if($quantity == " "){
					$quantity = 1;
				} if($product_size == ""){
					$product_size = "Null";
				}

				$ragzProduct = $productDetails->getProductsDet($product_number);
			    $product_name = $ragzProduct['product_name'];
			    $manufacturer_id = $ragzProduct['manufacturer_id'];
			    $merchant_number = 001;

				$move= move_uploaded_file($file_tmp, $dir.$file_name);
				$product_thumbnail = $file_name;
				if(!empty($productDetails->addNewProduct($product_thumbnail, $product_number, $product_description, $product_price, $publish, $type_id, $quantity, $product_size, $category_id, $merchant_number))){

					if($productDetails->checkDeuplicateProductStock($product_name, $category_id, $type_id, $manufacturer_id)){
						$come = $productDetails->getProductStock($product_name, $category_id, $type_id, $manufacturer_id);
						$before = $come['quantity'];
						$new = $quantity;
						$total = $before+$new;
						$update = $productDetails->updateProductStock($product_name, $total, $category_id, $type_id, $manufacturer_id);
						$action = "Updated $product_name Stock With $quantity Quantity";
						$his = $all_purpose->getUserDetailsandAddActivity($email, $action);
						$_SESSION['success'] = strtoupper("You Have Added $product_name with the Product Number $product_number To The Products List Successfully and the Product Stock is Updated Successfully");
						$all_purpose->redirect("view-all-products.php");
					}else{
						if(!empty($productDetails->addProductStock($product_name, $category_id, $type_id, $quantity, $manufacturer_id))){
							$action = "Added $product_name with Product Number $product_number to the stock list";
							$his = $all_purpose->getUserDetailsandAddActivity($email, $action);
							$_SESSION['success'] = "$product_name with the Product number $product_number has been Added to the Product Stock successfully";
							$all_purpose->redirect("view-all-products.php");
						}else{
							$_SESSION['error'] = "Error in adding the Product $product_name to the Product Stock";
							$all_purpose->redirect("add-products.php");
						}
					}
					
					
				}else{
					$return = $_POST['return'];
					$_SESSION['error'] = strtoupper("Unable To Add $product_name to The products List at The Moment, Please Try Again Later");
					$all_purpose->redirect("$return");
				}
			}else{
				$return = $_POST['return'];
				$_SESSION['error'] = strtoupper("Please Fill The Below Form To Add The Products Details");
				$all_purpose->redirect("$return");
			}
		}

	}catch(PDOException $e){
		$return = $_POST['return'];
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect("$return");
	}