<?php 

	class productMerchant
	{
		
		public $db;
		function __construct($db){
			$this->db=$db;
		}

		

		public function checkMerchantName($merchant_name)
		{
			try {
				$checkname = $this->db->prepare("SELECT * FROM merchant WHERE merchant_name=:merchant_name");
				$arrCHeck = array(':merchant_name'=>$merchant_name);
				$checkname->execute($arrCHeck);
				if($checkname->rowCount()>0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}

		public function getMerchantName($merchant_name)
		{
			try {
				$checkname = $this->db->prepare("SELECT * FROM merchant WHERE merchant_name=:merchant_name");
				$arrCHeck = array(':merchant_name'=>$merchant_name);
				$checkname->execute($arrCHeck);
				$see = $checkname->fetch();
				return $see;;
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}

		public function checkMerchantEmail($merchant_email)
		{
			try {
				$checkname = $this->db->prepare("SELECT * FROM merchant WHERE merchant_email=:merchant_email");
				$arrCHeck = array(':merchant_email'=>$merchant_email);
				$checkname->execute($arrCHeck);
				if($checkname->rowCount()>0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}

		public function addMerchantDetails($merchant_number, $merchant_name, $merchant_logo, $merchant_email)
		{
			try {
				$addMerchant = $this->db->prepare("INSERT INTO merchant (merchant_name, merchant_number, merchant_logo, merchant_email)VALuES(:merchant_name, :merchant_number, :merchant_logo, :merchant_email)");
				$arrAdd = array(':merchant_name'=>$merchant_name, ':merchant_number'=>$merchant_number, ':merchant_logo'=>$merchant_logo, ':merchant_email'=>$merchant_email);
				if(!empty($addMerchant->execute($arrAdd))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}

		public function updateMerchantWIthoutLogo($merchant_number, $merchant_name)
		{
			try {
				$updateDetails = $this->db->prepare("UPDATE merchant SET merchant_name=:merchant_name WHERE merchant_number=:merchant_number");
				$arrUppDe = array(':merchant_name'=>$merchant_name, ':merchant_number'=>$merchant_number);
				if(!empty($updateDetails->execute($arrUppDe))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}

		public function updateMerchantWIthLogo($merchant_number, $merchant_name, $merchant_logo)
		{
			try {
				$updateDetails = $this->db->prepare("UPDATE merchant SET merchant_name=:merchant_name, merchant_logo=:merchant_logo WHERE merchant_number=:merchant_number");
				$arrUppDe=array(':merchant_name'=>$merchant_name, ':merchant_logo'=>$merchant_logo, ':merchant_number'=>$merchant_number);
				if(!empty($updateDetails->execute($arrUppDe))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}

		public function deleteMarchantDetails($merchant_number)
		{
			try {
				$deleteMerchant = $this->db->prepare("DELETE FROM merchant WHERE merchant_number=:merchant_number");
				$arrDel = array(':merchant_number'=>$merchant_number);
				if(!empty($deleteMerchant->execute($arrDel))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}		
		}

		public function gettingMerchantDelatils($merchant_number)
		{
			try {
				$getting = $this->db->prepare("SELECT * FROM merchant WHERE merchant_number=:merchant_number");
				$arrGet = array(':merchant_number'=>$merchant_number);
				$getting->execute($arrGet);
				$see = $getting->fetch();
				return $see;
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}

		public function gettingMerchantEmailDelatils($merchant_email)
		{
			try {
				$getting = $this->db->prepare("SELECT * FROM merchant WHERE merchant_email=:merchant_email");
				$arrGet = array(':merchant_email'=>$merchant_email);
				$getting->execute($arrGet);
				$see = $getting->fetch();
				return $see;
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}
	}

	class customerOrders extends productMerchant{
		function __construct($db){
			parent:: __construct($db);
		}

		public function gettingProductOrders($product_number)
		{
			try {
				$getting = $this->db->prepare("SELECT * FROM customer_order_details WHERE product_id=:product_number");
				$arrGet = array(':product_number'=>$product_number);
				$getting->execute($arrGet);
				$fetch = $getting->fetchAll(PDO::FETCH_ASSOC);
				return $fetch;
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}

		public function gettingAlThelProductOrders()
		{
			try {
				$getting = $this->db->prepare("SELECT * FROM customer_order_details");
				$getting->execute();
				$fetch = $getting->fetchAll(PDO::FETCH_ASSOC);
				return $fetch;
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}

		public function checkProductOrders($product_number)
		{
			try {
				$getting = $this->db->prepare("SELECT * FROM customer_order_details WHERE product_id=:product_number");
				$arrGet = array(':product_number'=>$product_number);
				$getting->execute($arrGet);
				if($getting->rowCount()==0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] =  $e->getMessage();
				return false;
			}
		}

	}
?>