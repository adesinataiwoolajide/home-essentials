<?php
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require '../../libs_dev/products/products_class.php';
	try{
		$all_purpose = new all_purpose($db);
		$productsCate = new ragzNationProductsCategory($db);
		$productDetails = new ragzNationProducts($db);
		
	   	$dir1 = "../../assets/images/products-images/large-image/";
	   	
	    $file_name = $_FILES['image']['name'];
	    $file_size =$_FILES['image']['size'];
	    $file_tmp =$_FILES['image']['tmp_name'];
	    $file_type=$_FILES['image']['type'];
	    $file_ext = pathinfo($file_name); 

		if(isset($_POST['update-product'])){
			$email = $_SESSION['user_name'];

			$product_number = $_POST['product_number'];
			$productname = $all_purpose->sanitizeInput($_POST['product_name']);
			$product_name = strtoupper($productname);
			$manufacturer_id = $all_purpose->sanitizeInput($_POST['manufacturer_id']);
			$category_id = $all_purpose->sanitizeInput($_POST['category_id']);
			$product_size = $all_purpose->sanitizeInput($_POST['product_size']);
			$product_price = $all_purpose->sanitizeInput($_POST['product_price']);
			$quantity = $all_purpose->sanitizeInput($_POST['quantity']);
			$product_description = $all_purpose->sanitizeInput($_POST['product_description']);
			$type_id = $all_purpose->sanitizeInput($_POST['type_id']);
			$qty = $_POST['qty'];
			
			$ragzProduct = $productDetails->getProductsDet($product_number);
			if(empty($file_name)){

				if(!empty($productDetails->updateNewProductDetailsWithoutImage($product_name, $product_number, $category_id, $manufacturer_id)) AND($productDetails->updateTheProductDetailsWithOutThumbnail($product_number, $product_description, $product_price, $type_id, $quantity, $product_size, $category_id))){

					if($productDetails->checkDeuplicateProductStock($product_name, $category_id, $type_id, $manufacturer_id)){
						$come = $productDetails->getProductStock($product_name, $category_id, $type_id, $manufacturer_id);
						$before = $come['quantity'];
						$nnow = $before - $qty;
						$new = $quantity;
						$total = $nnow+$new;
						$update = $productDetails->updateProductStock($product_name, $total, $category_id, $type_id, $manufacturer_id);
						$action = "Updated $product_name Stock With $quantity Quantity";
						$his = $all_purpose->getUserDetailsandAddActivity($email, $action);
						$_SESSION['success'] = strtoupper("You Have Updated $product_name with the Product Number $product_number To The Products List Successfully and The Product Stock is Updated Successfully");
						$all_purpose->redirect("my-product-details.php?product_number=$product_number");
					}else{
						if(!empty($productDetails->addProductStock($product_name, $category_id, $type_id, $quantity, $manufacturer_id))){
							$action = "Added $product_name with Product Number $product_number to the stock list";
							$his = $all_purpose->getUserDetailsandAddActivity($email, $action);
							$_SESSION['success'] = "$product_name with the Product number $product_number has been Added to the Product Stock successfully";
							$all_purpose->redirect("my-product-details.php?product_number=$product_number");
						}else{
							$return = $_POST['return'];
							$_SESSION['error'] = "Error in adding the Product $product_name to the Product Stock";
							$all_purpose->redirect("$return");
						}
					}

				}else{
					$return = $_POST['return'];
					$_SESSION['error'] = "Error in Updating the Product $product_name to the Product Details";
					$all_purpose->redirect("$return");
				}
			
			
			}else{
				$ext = $file_ext['extension'];
			    $extensions= array("jpeg","jpg","png", "JPEG", "JPG", "PNG");

			    if(!(in_array($ext,$extensions)) OR (in_array($ext2,$extensions))){
			    	$return = $_POST['return'];
			    	$_SESSION['error']="Image Extension not allowed, Please choose a JPEG or PNG file.";
			        $all_purpose->redirect("$return");	
		     	}
				if(($file_size > 2097152) OR ($file_size2 > 2097152)){
					$return = $_POST['return'];
		          	$_SESSION['error'] = 'File size must be not greater than 2 MB';
		          	$all_purpose->redirect("$return");	
		    	}else{
		    		$move= move_uploaded_file($file_tmp, $dir1.$file_name);
					$product_image = $file_name;
					if(!empty($productDetails->updateNewProductDetailsWithImage($product_name, $product_number, $product_image, $category_id, $manufacturer_id))AND($productDetails->updateTheProductDetailsWithOutThumbnail($product_number, $product_description, $product_price, $type_id, $quantity, $product_size, $category_id))){

						if($productDetails->checkDeuplicateProductStock($product_name, $category_id, $type_id, $manufacturer_id)){
							$come = $productDetails->getProductStock($product_name, $category_id, $type_id, $manufacturer_id);
							$before = $come['quantity'];
							$nnow = $before - $qty;
							$new = $quantity;
							$total = $nnow+$new;
							$update = $productDetails->updateProductStock($product_name, $total, $category_id, $type_id, $manufacturer_id);
							$action = "Updated $product_name Stock With $quantity Quantity";
							$his = $all_purpose->getUserDetailsandAddActivity($email, $action);
							$_SESSION['success'] = strtoupper("You Have Added $product_name with the Product Number $product_number To The Products List Successfully and the Product Stock is Updated Successfully");
							$all_purpose->redirect("my-product-details.php?product_number=$product_number");
						}else{
							if(!empty($productDetails->addProductStock($product_name, $category_id, $type_id, $quantity, $manufacturer_id))){
								$action = "Added $product_name with Product Number $product_number to the stock list";
								$his = $all_purpose->getUserDetailsandAddActivity($email, $action);
								$_SESSION['success'] = "You Have Updated $product_name with the Product number $product_number successfully";
								$all_purpose->redirect("my-product-details.php?product_number=$product_number");
							}else{
								$return = $_POST['return'];
								$_SESSION['error'] = "Error in Updating the Product $product_name with the Product number $product_number Stock";
								$all_purpose->redirect("$return");
							}
						}
						
						
					}else{
						$return = $_POST['return'];
						$_SESSION['error'] = strtoupper("Unable To Update $product_name Details at The Moment, Please Try Again Later");
						$all_purpose->redirect("$return");
					}
				}
			}
			
		}else{
			$return = $_POST['return'];
			$_SESSION['error'] = strtoupper("Please Fill The Below Form To Update The Products Details");
			$all_purpose->redirect("$return");
		}
	

	}catch(PDOException $e){
		$return = $_POST['return'];
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect("$return");
	}