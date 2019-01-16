<?php
session_start();
include_once("../../connection/connection.php");
require '../../libs_dev/products/products_class.php';
require_once '../../dev/general/all_purpose_class.php';
$returnUrl = $_SERVER['HTTP_REFERER'];
$all_purpose = new all_purpose($db);
$orderDetails = new ragzNationProducts($db);
	try {
		if(isset($_POST['track-order'])){
			$customer_id = $_POST['customer_id'];
			$orderid = $all_purpose->sanitizeInput($_POST['order_id']);
			$order_id = strtoupper($orderid);

			if($orderDetails->checkProductsOrdersDet($customer_id, $order_id)){
				$_SESSION['error'] = "Ooops!!! $order_id Is Not A Valid Transaction Number";
				$all_purpose->redirect($returnUrl);
			}else{
				$orderDetails->gettingProductsOrders($order_id);
				$_SESSION['success'] = $_SESSION['name']. " Kindly Preview Your Order Details Below";
				$all_purpose->redirect("../../order-details.php?transaction_number=$order_id&&customer_id=$customer_id");
			}
		}else{
			$_SESSION['error'] = "Please Fill The Below Form To Track Your Order";
			$all_purpose->redirect($returnUrl);
		}
	} catch (PDOException $e) {
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect($returnUrl);
	}