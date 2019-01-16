<?php
	session_start();
	require("../../connection/connection.php");
	require("../../dev/general/all_purpose_class.php");
	require '../../libs_dev/products/products_class.php';
    require '../../libs_dev/merchant/merchant_class.php';
    $merchantDetails = new productMerchant($db);
    $productsCate = new ragzNationProductsCategory($db);
    $productDetails = new ragzNationProducts($db);
	$all_purpose = new all_purpose($db);
    try{
    	
		if($_POST){
			$y = $_POST["show"];
			$email = $_SESSION['user_name'];
			$staff_email = $email;
			for($i = 1; $i <= $y; $i++){
				$grant = $_POST["published$i"];
				if($grant ==1){
					$merchant_number = $_POST['merchant_number'];
					$details = $merchantDetails->gettingMerchantDelatils($merchant_number);
				    $merchant_name = $details['merchant_name'];
				    $merchant_email = $details['merchant_email'];
					$product_number = $_POST["product_number$i"];
					$ragzProduct = $productDetails->getProductsDet($product_number);
                    $ragzProductDetails = $productDetails->getProductsDetails($product_number);
					$product_name = $ragzProduct['product_name'];
					$operation = "Published Products";

					if(!empty($productDetails->publishTheProduct($product_number) AND ($productDetails->addProductPublication($product_number, $product_name, $staff_email, $operation, $merchant_number)))){
						$action = "$merchant_name Published $product_number with The Product Name $product_name";
						$his = $all_purpose->getUserDetailsandAddActivity($email, $action);
					}else{
						$_SESSION['error'] = "Unable to Publish The Selected Products At the Moment, Please Try Again Later"; 
						$all_purpose->redirect("publish-my-product.php");
					}
				}
			}
			$_SESSION['success'] = "You Have Published The Selected Products Successfully";
			$all_purpose->redirect("my-published-products.php");
		}
	}catch(PDOException $e){
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect("publish-my-product.php");
	}
