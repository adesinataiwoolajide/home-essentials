<?php
	class Account{
		private $name;
		private $email;
		private $password;
		private $username;
		public $adminId;
		protected $customerId;


		public function getName($name)
		{
			return $this->name = $name;
		}
				
		public function getEmail($email)
		{
			return $this->email = $email;
		}

		public function getCustomerId($customerId)
		{
			return $this->customerId = $customerId;
		}
		public function getCustomerZone($zone)
		{
			return $this->zoneId = $zoneId;
		}	

		public function getUsername($username)
		{
			return $this->username = $username;
		}				

		public function getPassword($password, $actionType)
		{
			if($actionType == "registration"){
				return $this->password = password_hash($password, PASSWORD_DEFAULT, ["cost" => 12]);
			}elseif($actionType == "login"){
				return $this->password = $password;
			}
		}

		public function checkIfAlreadyRegistered()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM customer_information WHERE email = :email");
			$query->bindValue(":email", $this->email);
			$query->execute();
			$fetch = $query->rowCount();
			return $fetch;
		}

		public function createUserAccount()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("INSERT INTO customer_information (customer_id, name, email, password) VALUES (:customerId, :name, :email, :password)");
			$query->bindValue(":customerId", $this->customerId);
			$query->bindValue(":password", $this->password);
			$query->bindValue(":name", $this->name);
			$query->bindValue(":email", $this->email);
			if($query->execute()){
				return true;
			}
			return false;
		}

		public function loginUser()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM customer_information WHERE email = :email");
			$query->bindValue(":email", $this->email);
			if($query->execute())
			{
				$fetch = $query->fetch(PDO::FETCH_ASSOC);
				$hashedPassword = $fetch["password"];

				// var_dump(password_verify($this->password, $hashedPassword));
				// die();

				if(password_verify($this->password, $fetch["password"]))
				{
					$_SESSION['customerid'] = $fetch['customer_id'];
					$_SESSION['name'] = $fetch['name'];
					$_SESSION['email'] = $fetch['email'];
					$_SESSION['current_credit'] = $fetch['current_credit_amount'];
					$_SESSION['memberType'] = $this->getMembershipType($fetch['customer_id']);
					$_SESSION['memberDiscountAmount'] = $this-> getMembershipTypeDiscount($this->getMembershipType($fetch['customer_id']));
					return true;
				}
			}
			return false;
		}

		public function loginAdmin()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM administrator WHERE username = :username");
			$query->bindValue(":username", $this->username);
			if($query->execute())
			{
				$fetch = $query->fetch();
				$hashedPassword = $fetch['password'];
				if(password_verify($this->password, $hashedPassword))
				{
					$_SESSION['id'] = $fetch['id'];
					return true;
				}
			}
			return false;
		}		

		public function getMembershipType($cid)
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM membership_form WHERE cid = '$cid'");
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			if($fetch){
				foreach($fetch as $data){
					return $data['membership_type'];
				}
			}
			return 0;
		}

		public function getSingleOrderForCUstomer($cid)
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM customer_order WHERE customer_id = :cid ORDER BY id DESC LIMIT 0,1");
			$query->bindValue(":cid", $cid);			
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			if($fetch){
				foreach($fetch as $data){
					return $data['time_created'];
				}
			}
		}	

		public function checkSingleOrderForCUstomer($cid)
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM customer_order WHERE customer_id = :cid ORDER BY id DESC LIMIT 0,1");
			$query->bindValue(":cid", $cid);			
			$query->execute();
			if($query->rowCount()==0){
				return true;
			}else{
				return false;
			}
		}			

		public function getMembershipTypeDiscount($memberType)
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("SELECT * FROM discount_value WHERE name = '$memberType'");
			$query->execute();
			$fetch = $query->fetchAll(PDO::FETCH_ASSOC);
			if($fetch){
				foreach($fetch as $data){
					return $data['discount_value'];
				}
			}
			return 0;
		}		

		public function isLoggedIn()
		{
			if(isset($_SESSION['customerid'])){
				return true;
			}
		}

		public function isAdminLoggedIn()
		{
			if(isset($_SESSION['id'])){
				return true;
			}
		}		

		public function logoutUser()
		{
			session_destroy();
			unset($_SESSION['customerid']);
			return true;
		}	

		public function logoutAdmin()
		{
			session_destroy();
			unset($_SESSION['id']);
			return true;
		}		

		public function updateAdminPassword()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("UPDATE administrator SET password = :password WHERE id = :id");
			$query->bindValue(":id", $this->adminId);
			$query->bindValue(":password", $this->password);
			if($query->execute()){
				return true;
			}
			return false;
		}

		public function updatePassword()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("UPDATE customer_information SET password = :password WHERE customer_id = :customer_id");
			$query->bindValue(":customer_id", $this->customerId);
			$query->bindValue(":password", $this->password);
			if($query->execute()){
				return true;
			}
			return false;
		}

		public function resetPassword()
		{
			$db = Database::getInstance()->getConnection();
			$query = $db->prepare("UPDATE customer_information SET password = :password WHERE email = :email");
			$query->bindValue(":email", $this->email);
			$query->bindValue(":password", $this->password);
			if($query->execute()){
				return true;
			}
			return false;
		}		
	}
?>