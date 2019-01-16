<?php
	class Payment{
		//const MERIT_ID = 6519;
		const MERIT_ID = 6487;
		const CURRENCY = 566;
		const INTERSWITCH_ID = "GTB401350078111";
		//const HASH_KEY = "D3D1D05AFE42AD50818167EAC73C109168A0F108F32645C8B59E897FA930DA44F9230910DAC9E20641823799A107A02068F7BC0F4CC41D2952E249552255710F";
		const HASH_KEY = "0196B2DD78944DCE35F5A566443440C3708223C53B9E9FD49437B5BD8652A3118779735403B43FCDBC859A2D86D3AE265398EC8B5DACD67DA9CFE02F67512354";	
		private $transactionId;
		private $amount;
		private $customerId;
		private $redirectUrl;
		public $tellerNumber;
		public $tellerName;
		public $orderId;
		public $status;
		public $paymentMode;
		public $id;


		public function getRedirectURL($url)
		{
			$this->redirectUrl = $url;
		}

		public function getTransactionId($transactionId)
		{
			$this->transactionId = $transactionId;
		}		

		public function getAmount($amount){
			$this->amount = $amount;
		}

		public function getCustomerId($customerId){
			$this->customerId = $customerId;
		}		




	


		public function markOrderAsPaid()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("UPDATE customer_order SET paid_status = :status WHERE order_id = :order_id");
			$query->bindValue(":order_id", $this->orderId);
			$query->bindValue(":status", $this->status);
			if($query->execute()){
				return true;
			}
			return false;			
		}

		public function getAllOnlineTransactions()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM payment_history");
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}

		public function paginateAllOnlineTransactions()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM payment_history ORDER BY id DESC LIMIT :start, :items_per_page");
			$query->bindValue(":start", $this->start, PDO::PARAM_INT);
			$query->bindValue(":items_per_page", $this->itemsPerPage, PDO::PARAM_INT);
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;		
		}			

		public function getPaymentHistory()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM payment_history WHERE response_code = :code");
			$query->bindValue(":code", $this->status);
			$query->execute();
			return $query->fetchAll(PDO::FETCH_ASSOC);
		}		

		public function paginatePaymentHistory()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM payment_history WHERE response_code = :code ORDER BY id DESC LIMIT :start, :items_per_page");
			$query->bindValue(":code", $this->status);
			$query->bindValue(":start", $this->start, PDO::PARAM_INT);
			$query->bindValue(":items_per_page", $this->itemsPerPage, PDO::PARAM_INT);
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			return $fetch;		
		}	

		public function saveFinalPayment()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("INSERT INTO payment_history (customer_id, payment_mode, transaction_id, merchant_reference, response_code, amount) VALUES (:customer_id, :payment_mode, :transaction_id, :merchant_reference, :response_code, :amount)");
			$query->bindValue(":customer_id", $this->customerId);
			$query->bindValue(":payment_mode", $this->paymentMode);
			$query->bindValue(":transaction_id", $this->transactionId);
			$query->bindValue(":merchant_reference", $this->tellerNumber);
			$query->bindValue(":response_code", $this->status);
			$query->bindValue(":amount", $this->amount);
			if($query->execute()){
				return true;
			}
			return false;
		}

		public function interpretPayStatus($status)
		{
			if($status == 0){
				$result = "Unpaid";
			}else if($status == 1){
				$result = "Paid";
			}
			return $result;
		}

		public function interpretPaymentMethod($mode)
		{
			if($mode == 0){
				$result = "Unknown";
			}elseif($mode == 1){
				$result = "Bank Payment";
			}elseif($mode == 2){
				$result = "Online Payment";
			}
			return $result;
		}	

		public function interpretBankVerificationStatus($status)
		{
			if($status == 0){
				$result = "Unverified";
			}elseif($status == 1){
				$result = "Verified";
			}
			return $result;
		}				

		public function calculateDiscount($cartTotal, $discount)
		{
			$value = $discount / 100;
			$amountToPay = $value * $cartTotal;
			return $amountToPay;
		}		

		public function getDiscountedAmount($memberType, $amount, $currentCredit, $cartAmount)
		{
			if($memberType == "FAMILY SUPPORT"){
				if($cartAmount < $currentCredit){
					$amount = $this->calculateDiscount($cartAmount, 40);
				}
			}
			return $amount;
		}
	}
?>