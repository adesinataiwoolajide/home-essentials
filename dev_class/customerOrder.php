<?php
	class Order{		
		public $db;
		private $productId;
		private $quantity;
		private $amount;

		public function getProductId($productId){
			$this->productId = $productId;
		} 
		public function getQuantity($quantity){
			$this->quantity = $quantity;
		}
		public function getAmount($amount){
			$this->amount = $amount;
		}	
		function __construct($db){
			$this->db= $db;
		}

		public function getSingleOrder($order_id)
		{
			$query = $this->db->prepare("SELECT * FROM customer_order WHERE order_id = :order_id");
			$query->bindValue(":order_id", $orderId);			
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getCustomerOrder($customer_id)
		{
			$query = $this->db->prepare("SELECT * FROM customer_order WHERE customer_id = :customer_id ORDER BY id DESC");
			$query->bindValue(":customer_id", $customerId);			
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}

		public function ckeckExitenceOrder($customer_id)
		{
			$query = $this->db->prepare("SELECT * FROM customer_order WHERE customer_id = :customer_id ORDER BY id DESC");
			$query->bindValue(":customer_id", $customerId);			
			$query->execute();
			if($query->rowCount()==0){
				return true;
			}else{
				false;
			}
		}


		public function getCustomerOrderSummary($customer_id, $order_id)
		{
			$query = $this->db->prepare("SELECT * FROM customer_order WHERE customer_id = :customer_id AND order_id = :order_id ORDER BY id DESC");
			$query->bindValue(":customer_id", $customerId);			
			$query->bindValue(":order_id", $orderId);			
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}		

		public function getCustomerOrderDetails($order_id)
		{
			$query = $this->db->prepare("SELECT * FROM customer_order_details WHERE order_id = :order_id");
			$query->bindValue(":order_id", $orderId);			
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getOrderTotalAmount($order_id)
		{
			$totalAmount = 0;
			$query = $this->db->prepare("SELECT amount, quantity FROM customer_order_details WHERE order_id = :order_id");
			$query->bindValue(":order_id", $orderId);
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach($fetch as $price){
				$amount = $price['quantity'] * $price['amount'];
				$totalAmount += $amount;
			}
			return $totalAmount;
		}

		public function saveOrder($customer_id, $order_id, $paystack_reference, $paid_status, $order_status, $subtotal, $shipping_charge, $amount)
		{
			$query = $this->db->prepare("INSERT INTO customer_order (customer_id, order_id, paystack_reference, paid_status, order_status, subtotal, shipping_charge, amount) VALUES (:customer_id, :order_id, :paystack_reference, :paid_status, :order_status, :subtotal, :shipping_charge, :amount)");
			$query->bindValue(":customer_id", $customer_id);
			$query->bindValue(":order_id", $order_id);
			$query->bindValue(":paystack_reference", $paystack_reference);
			$query->bindValue(":paid_status", $paid_status);
			$query->bindValue(":order_status", $order_status);
			$query->bindValue(":subtotal", $subtotal);
			$query->bindValue(":shipping_charge", $shipping_charge);
			$query->bindValue(":amount", $amount);
			
			if($query->execute()){
				return true;
			}
			return false;
		}

		public function saveOrderDetails($orderId, $productId, $quantity, $amount)
		{
			$query = $this->db->prepare("INSERT INTO customer_order_details (order_id, product_id, quantity, amount) VALUES (:order_id, :product_id, :quantity, :amount)");
			$query->bindValue(":order_id", $orderId);
			$query->bindValue(":product_id", $productId);
			$query->bindValue(":quantity", $quantity);
			$query->bindValue(":amount", $amount);
			if($query->execute()){
				return true;
			}
			return false;			
		}

		public function deleteOrders($order_id){
			$query = $this->db->prepare("DELETE FROM customer_order WHERE order_id = '$order_id'");
			$query->execute();
			$query = $this->db->prepare("DELETE FROM customer_order_details WHERE order_id = '$order_id'");
			$query->execute();
			return true;
		}

		public function updateOrderWithPaystackReference($order_id, $paystack)
		{
			$query = $this->db->prepare("UPDATE customer_order SET paystack_reference = '$paystack' WHERE order_id = '$order_id'");
			$query->execute();
		}

		public function updateOrderPaymentStatus($order_id)
		{
			$query = $this->db->prepare("UPDATE customer_order SET paid_status = 1 WHERE order_id = '$order_id'");
			$query->execute();
		}

		

		public function interpretOrderStatus($status)
		{
			if($status == 0){
				return "Unshipped";
			}else if($status == 1){
				return "Shipped";
			}elseif($status == 2){
				return "Delivered";
			}
		}	

		public function interpretPriceRequestStatus($status)
		{
			if($status == 0){
				return "Unanswered";
			}else if($status == 1){
				return "Answered";
			}
		}

		public function getAllOrders()
		{
			$query = $db->query("SELECT * FROM customer_order ORDER BY id DESC");
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}

		
		
		public function updateCustomerOrderId($new_orderId, $orderId)
		{
			$query = $this->db->prepare("UPDATE customer_order SET order_id = :new_orderId WHERE order_id = :order_id");
			$query->bindValue(":new_orderId", $newOrderId);
			$query->bindValue(":order_id", $orderId);			
			if($query->execute()){
				return true;
			}
			return false;
		}

		public function updateCustomerOrderDetailsId($order_id, $new_orderId)
		{
			$query = $this->db->prepare("UPDATE customer_order_details SET order_id = :new_orderId WHERE order_id = :order_id");
			$query->bindValue(":new_orderId", $newOrderId);
			$query->bindValue(":order_id", $orderId);			
			if($query->execute()){
				return true;
			}
			return false;
		}	

		public function addPaymentType($method_name, $paystackReference, $customer_id){
			$addType = $this->db->prepare("INSERT INTO payment_method(method_name, paystackReference, customer_id) VALUES(:method_name, :paystackReference, :customer_id)");
			$arrType = array(':method_name'=>$method_name, ':paystackReference'=>$paystackReference, ':customer_id'=>$customer_id);
			if(!empty($addType->execute($arrType))){
				return true;
			}else{
				return false;
			}											
		}															
}
?>
