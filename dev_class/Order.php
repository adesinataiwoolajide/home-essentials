<?php
	class Order extends Account{		
		private $orderId;
		private $amount;
		private $numItems;
		private $paidStatus;
		private $orderStatus;
		private $quantity;
		private $productId;
		private $shippingCharge;
		private $paymentMode;
		public $status;
		private $id;
		public $start;
		public $newOrderId;
		public $itemsPerPage;
		public $sizes;

		public function getId($id){
			$this->id = $id;
		}

		public function getProductId($productId){
			$this->productId = $productId;
		}

		public function getQuantity($quantity){
			$this->quantity = $quantity;
		}

		public function getOrderId($orderId){
			$this->orderId = $orderId;
		}

		public function getNumberOfGoods($numItems){
			$this->numItems = $numItems;
		}

		public function paidStatus($paidStatus){
			$this->paidStatus = $paidStatus;
		}

		public function getOrderStatus($orderStatus){
			$this->orderStatus = $orderStatus;
		}

		public function getAmount($amount){
			$this->amount = $amount;
		}		

		public function getShippingCharges($shippingCharge){
			$this->shippingCharge = $shippingCharge;
		}

		public function getPaymentMode($payMode){
			$this->paymentMode = $payMode;
		}

		public function getWeight($wght){
			$this->wght = $wght;
		}

		public function getSingleOrder()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM customer_order WHERE order_id = :order_id");
			$query->bindValue(":order_id", $this->orderId);			
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getCustomerOrder()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM customer_order WHERE customer_id = :customer_id ORDER BY id DESC");
			$query->bindValue(":customer_id", $this->customerId);			
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}

		public function ckeckExitenceOrder()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM customer_order WHERE customer_id = :customer_id ORDER BY id DESC");
			$query->bindValue(":customer_id", $this->customerId);			
			$query->execute();
			if($query->rowCount()==0){
				return true;
			}else{
				false;
			}
		}

		public function paginateCustomerOrder()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM customer_order WHERE customer_id = :customer_id ORDER BY id DESC LIMIT :start, :items_per_page");
			$query->bindValue(":customer_id", $this->customerId);
			$query->bindValue(":start", $this->start, PDO::PARAM_INT);
			$query->bindValue(":items_per_page", $this->itemsPerPage, PDO::PARAM_INT);
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;		
		}		


		public function getCustomerOrderSummary()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM customer_order WHERE customer_id = :customer_id AND order_id = :order_id ORDER BY id DESC");
			$query->bindValue(":customer_id", $this->customerId);			
			$query->bindValue(":order_id", $this->orderId);			
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}		

		public function getCustomerOrderDetails()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM customer_order_details WHERE order_id = :order_id");
			$query->bindValue(":order_id", $this->orderId);			
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getOrderTotalAmount()
		{
			$totalAmount = 0;
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT amount, quantity FROM customer_order_details WHERE order_id = :order_id");
			$query->bindValue(":order_id", $this->orderId);
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach($fetch as $price){
				$amount = $price['quantity'] * $price['amount'];
				$totalAmount += $amount;
			}
			return $totalAmount;
		}

		public function saveOrder($customer_id, $order_id, $paystack_reference, $paid_status, $order_status, $subtotal, $shipping_charge, $discount_percent, $discount_value, $amount, $wght)
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("INSERT INTO customer_order (customer_id, order_id, paystack_reference, paid_status, order_status, subtotal, shipping_charge, discount_percent, discount_value, amount, wght) VALUES (:customer_id, :order_id, :paystack_reference, :paid_status, :order_status, :subtotal, :shipping_charge, :discount_percent, :discount_value, :amount, :wght)");
			$query->bindValue(":customer_id", $customer_id);
			$query->bindValue(":order_id", $order_id);
			$query->bindValue(":paystack_reference", $paystack_reference);
			$query->bindValue(":paid_status", $paid_status);
			$query->bindValue(":order_status", $order_status);
			$query->bindValue(":subtotal", $subtotal);
			$query->bindValue(":shipping_charge", $shipping_charge);
			$query->bindValue(":discount_percent", $discount_percent);
			$query->bindValue(":discount_value", $discount_value);
			$query->bindValue(":amount", $amount);
			$query->bindValue(":wght", $wght);
			
			if($query->execute()){
				return true;
			}
			return false;
		}

		public function saveOrderDetails($orderId, $productId, $quantity, $amount)
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("INSERT INTO customer_order_details (order_id, product_id, quantity, amount) VALUES (:order_id, :product_id, :quantity, :amount)");
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
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("DELETE FROM customer_order WHERE order_id = '$order_id'");
			$query->execute();
			$query = $db->prepare("DELETE FROM customer_order_details WHERE order_id = '$order_id'");
			$query->execute();
			return true;
		}

		public function updateOrderWithPaystackReference($order_id, $paystack)
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("UPDATE customer_order SET paystack_reference = '$paystack' WHERE order_id = '$order_id'");
			$query->execute();
		}

		public function updateOrderPaymentStatus($order_id)
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("UPDATE customer_order SET paid_status = 1 WHERE order_id = '$order_id'");
			$query->execute();
		}

		public function notifyUnpricedOrders()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("INSERT INTO price_request (order_id, customer_id, status) VALUES (:order_id, :customer_id, :status)");
			$query->bindValue(":order_id", $this->orderId);
			$query->bindValue(":customer_id", $this->customerId);
			$query->bindValue(":status", $this->status);
			if($query->execute()){
				return true;
			}
			return false;
		}

		public function getPriceRequest()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->query("SELECT * FROM price_request ORDER BY id DESC");
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}

		public function paginatePriceRequest()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM price_request ORDER BY id DESC LIMIT :start, :items_per_page");
			$query->bindValue(":start", $this->start, PDO::PARAM_INT);
			$query->bindValue(":items_per_page", $this->itemsPerPage, PDO::PARAM_INT);
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;		
		}		

		public function getUnansweredPriceRequest()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->query("SELECT * FROM price_request WHERE status = 0 ORDER BY id DESC");
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}

		public function savePriceRequest()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("UPDATE customer_order_details SET amount = :amount WHERE id = :id");
			$query->bindValue(":amount", $this->amount);
			$query->bindValue(":id", $this->id);
			if($query->execute()){
				return true;
			}
			return false;
		}

		public function updatePriceRequestStatus()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("UPDATE price_request SET status = :status WHERE order_id = :order_id");
			$query->bindValue(":status", $this->status);
			$query->bindValue(":order_id", $this->orderId);
			if($query->execute()){
				return true;
			}
			return false;
		}

		public function updateOrderStatus()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("UPDATE customer_order SET order_status = :status WHERE order_id = :order_id");
			$query->bindValue(":status", $this->status);
			$query->bindValue(":order_id", $this->orderId);
			if($query->execute()){
				return true;
			}
			return false;
		}

		public function updatePaymentMode()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("UPDATE customer_order SET payment_mode = :payment_mode WHERE order_id = :order_id");
			$query->bindValue(":payment_mode", $this->paymentMode);
			$query->bindValue(":order_id", $this->orderId);
			if($query->execute()){
				return true;
			}
			return false;
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
			$db = Database::getInstance()->getConnection();
			$query = $db->query("SELECT * FROM customer_order ORDER BY id DESC");
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}		

		public function paginateOrders()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM customer_order ORDER BY id DESC LIMIT :start, :items_per_page");
			$query->bindValue(":start", $this->start, PDO::PARAM_INT);
			$query->bindValue(":items_per_page", $this->itemsPerPage, PDO::PARAM_INT);
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;		
		}
		
		public function getAllOrderPaidStatus()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM customer_order WHERE paid_status = :paid_status ORDER BY id DESC");
			$query->bindValue(":paid_status", $this->paidStatus);
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}		

		public function paginateAllOrderPaidStatus()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM customer_order WHERE paid_status = :paid_status ORDER BY id DESC LIMIT :start, :items_per_page");
			$query->bindValue(":paid_status", $this->paidStatus, PDO::PARAM_INT);
			$query->bindValue(":start", $this->start, PDO::PARAM_INT);
			$query->bindValue(":items_per_page", $this->itemsPerPage, PDO::PARAM_INT);
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;		
		}	

		public function getAllOrderShippedStatus()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM customer_order WHERE order_status = :order_status ORDER BY id DESC");
			$query->bindValue(":order_status", $this->orderStatus);
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}		

		public function paginateAllShippedStatus()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM customer_order WHERE order_status = :order_status ORDER BY id DESC LIMIT :start, :items_per_page");
			$query->bindValue(":order_status", $this->orderStatus, PDO::PARAM_INT);
			$query->bindValue(":start", $this->start, PDO::PARAM_INT);
			$query->bindValue(":items_per_page", $this->itemsPerPage, PDO::PARAM_INT);
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;		
		}	

		public function updateCustomerOrderId()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("UPDATE customer_order SET order_id = :new_orderId WHERE order_id = :order_id");
			$query->bindValue(":new_orderId", $this->newOrderId);
			$query->bindValue(":order_id", $this->orderId);			
			if($query->execute()){
				return true;
			}
			return false;
		}

		public function updateCustomerOrderDetailsId()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("UPDATE customer_order_details SET order_id = :new_orderId WHERE order_id = :order_id");
			$query->bindValue(":new_orderId", $this->newOrderId);
			$query->bindValue(":order_id", $this->orderId);			
			if($query->execute()){
				return true;
			}
			return false;
		}																
	}
?>
