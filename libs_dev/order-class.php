<?php
	class Order {

		public $db;
		function __construct($db){
			$this->db=$db;
		}

		public function getSingleOrder()
		{
			$query = $this->db->prepare("SELECT * FROM customer_order WHERE order_id = :order_id");
			$query->bindValue(":order_id", $this->orderId);			
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}

		public function getCustomerOrder()
		{
			$query =  $this->db->prepare("SELECT * FROM customer_order WHERE customer_id = :customer_id ORDER BY id DESC");
			$query->bindValue(":customer_id", $this->customerId);			
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}

	}

?>