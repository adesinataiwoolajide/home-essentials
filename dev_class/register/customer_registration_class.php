<?php

	class newCustomerRegistration 
	{
		public $db;

		function __construct($db){
			$this->db= $db;
		}

		public function  sendTheActivationEmail($full_name, $user_name, $reg_number){
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "To: $full_name <$user_name>\r\n";
			$headers .= "From: HOME ESSENTIALS <info@homeessaitials.com>\r\n";
			$headers .= "Return-Path: info@homeessaitials.com\r\n";

			$txt = "************************************************<br />
				THIS IS AN AUTOMATED EMAIL - PLEASE DO NOT REPLY <br />
				************************************************<br /><br />
				Dear $full_name, 
				<p>
				Thanks for your creating an account but your registration is not yet completed. You must click on the link below to activate your account and complete your registration. <br /><br />
					============================================ <br />
					<a href = localhost/home-essentials/handlers/registration/process-login.php?registration_number=$reg_number>Click Here to Activate Your Account.</a><br /> 
					============================================<br />
					Reminder: You must click on the link above to complete your registration and activate your account. <br />
					<br />
					For inqueries and support please send a mail to info@homeessaitials.com<br />
					Thank you. <br />
					</p>
				<br />
				For inqueries and support please use our contact form. <br />

				Thank you. <br />
				</p>
				<p>
				====================================================================<br />
				This email was sent to $user_name<br />
				Read our Privacy Notice and Conditions of Use.<br />
				You are receiving this email because you created a profile on Home Essantials. <br />
				============================================ ========================
					</p>			
				";

			mail($user_name,"Registration Received: Activate your Account", $msg , $headers);
			
		}
		public function sendPasswordResetLink($user_name, $reset_code){
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "To: $full_name <$user_name>\r\n";
			$headers .= "From: MYGUDS <info@myguds.com>\r\n";
			$headers .= "Return-Path: info@myguds.com\r\n";

			$msg = "************************************************<br />
			THIS IS AN AUTOMATED EMAIL - PLEASE DO NOT REPLY <br />
			************************************************<br /><br />
			
			You requested for a new pasword. Click on the link below below to reset your password.<br /><br />
				============================================ <br />
				<a href = http://www.dev.myguds.com/utils/account/reset.php?code=$reg_number>Click Here to Get Started.</a><br /> 
				============================================<br />
				Reminder: You must click on the link above to reset your password. <br />
				<br />
				For inqueries and support please send a mail to info@myguds.com<br />
				Thank you. <br />
				</p>
			<br />
			For inqueries and support please use our contact form. <br />

			Thank you. <br />
			</p>
			<p>
			====================================================================<br />
			This email was sent to $user_name<br />
			Read our Privacy Notice and Conditions of Use.<br />
			You are receiving this email because you created a profile on Home Essantials. <br />
			============================================ ========================
				</p>			
			";

			@mail($user_name,"Password reset link", $msg , $headers);
		}

		public function activateTheUser($reg_number, $status){
			$query = $this->db->prepare("UPDATE customer_registration SET status = :status WHERE reg_number = :reg_number");
			$query->bindValue(":reg_number", $reg_number);
			$query->bindValue(":status", $status);
			$query->execute();
			if($query->rowCount() == 1){
				return true;
			}
			return false;
		}
		public function newUserRegistration($full_name, $user_name, $password, $reg_number){
			try{
				$insert = $this->db->prepare("INSERT INTO customer_registration(full_name, user_name, password, reg_number) VALUES(:full_name, :user_name, :password, :reg_number)");
				$arr = array(':full_name'=>$full_name, ':user_name'=>$user_name, ':password'=>$password, ':reg_number'=>$reg_number);
				if($insert->execute($arr)){
					return true;
				}else{
					return false;
				}

			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function checkingNewUserExistence($user_name){
			try{
				$real = $this->db->prepare("SELECT * FROM customer_registration WHERE user_name=:user_name");
				$att = array(':user_name'=>$user_name);
				$real->execute($att);
				if($real->rowCount() >0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
			}
		}

		public function generateRegNumber($length = 8) {
			$lel = date('Y').uniqid();
		    $characters = $lel;
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		}
		public function gettingUserDetails($user_name, $reg_number){
			try{
				$geting = $this->db->prepare("SELECT * FROM customer_registration WHERE user_name =:user_name OR reg_number=:reg_number");
				$arr = array(':user_name'=>$user_name, ':reg_number'=>$reg_number);
				$geting->execute($arr);
				$see = $geting->fetch();
				return $see;
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function gettingUserCredential($user_name){
			try{
				$geting = $this->db->prepare("SELECT * FROM customer_registration WHERE user_name =:user_name");
				$arr = array(':user_name'=>$user_name);
				$geting->execute($arr);
				$see = $geting->fetch();
				return $see;
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function updateUserdetailsID($user_name, $full_name, $password){
			try{
				$update = $this->db->prepare("UPDATE customer_registration SET full_name=:full_name, password=:password WHERE user_name=:user_name");
				$arr = array(':full_name'=>$full_name, ':user_name'=>$user_name, ':password'=>$password);
				$result = $update->execute($arr);
				if(!empty($result)){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		
		public function checkCustomerLogin($user_name, $password)
		{
			try {
				$login = $this->db->prepare("SELECT * FROM customer_registration WHERE user_name=:user_name AND password=:password");
				$arrLog = array(':user_name'=>$user_name, ':password'=>$password);
				$login->execute($arrLog);
				if($login->rowCount()==0){
					return true;
				}else{
					return false;
				}
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function forgotPassword($user_name)
		{
			try {
				$login = $this->db->prepare("SELECT * FROM customer_registration WHERE user_name=:user_name");
				$arrLog = array(':user_name'=>$user_name);
				$login->execute($arrLog);
				if($login->rowCount()==0){
					return true;
				}else{
					return false;
				}
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}


		public function CustomerLogin($user_name, $password)
		{
			try {
				$login = $this->db->prepare("SELECT * FROM customer_registration WHERE user_name=:user_name AND password=:password");
				$arrLogo = array(':user_name'=>$user_name, ':password'=>$password);
				$login->execute($arrLogo);
				$seeDetails = $login->fetch();
				return $seeDetails;
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}


		public function saveTheShippingAddress($customer_id, $phone, $address, $landmark, $state, $city)
		{
			try {
				$shipping = $this->db->prepare("INSERT INTO shipping_address (customer_id, phone, address, landmark, state, city) VALUES (:customer_id, :phone, :address, :landmark, :state, :city)");
				$arrShip = array(':customer_id'=>$customer_id, ':phone'=>$phone, ':address'=>$address, ':landmark'=>$landmark, ':state'=>$state, 
					':city'=>$city);
				if(!empty($shipping->execute($arrShip))){
					true;
				}else{
					return false;
				}
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
			
		}

		public function updateTheShippingAddress($customer_id, $phone, $address, $landmark, $state, $city)
		{
			try {
				$shipping = $this->db->prepare("UPDATE shipping_address SET phone=:phone, address=:address, landmark=:landmark, state=:state, city=:city WHERE customer_id=:customer_id");
				$arrShip = array(':phone'=>$phone, ':address'=>$address, ':landmark'=>$landmark, ':state'=>$state, ':city'=>$city, ':customer_id'=>$customer_id);
				if(!empty($shipping->execute($arrShip))){
					true;
				}else{
					return false;
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
				return false;
			}
			
		}

		public function checkShippingAddress($reg_number)
		{
			try {
				$login = $this->db->prepare("SELECT * FROM shipping_address WHERE customer_id=:reg_number");
				$arrLogo = array(':reg_number'=>$reg_number);
				$login->execute($arrLogo);
				if($login->rowCount()==0){
					return true;
				}else{
					return false;
				}
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function checkShippingAddressExist($reg_number)
		{
			try {
				$login = $this->db->prepare("SELECT * FROM shipping_address WHERE customer_id=:reg_number");
				$arrLogo = array(':reg_number'=>$reg_number);
				$login->execute($arrLogo);
				if($login->rowCount() > 0){
					return true;
				}else{
					return false;
				}
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function getShippinCusgAddress($reg_number)
		{
			try{
				$query = $this->db->prepare("SELECT * FROM shipping_address WHERE customer_id = :reg_number");
				$arrQ = array(':reg_number'=>$reg_number);
				$query->execute($arrQ);
				$fetch = $query->fetch();
				return $fetch;
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function gettingShippinCustomerAddress($reg_number)
		{
			try{
				$query = $this->db->prepare("SELECT * FROM shipping_address WHERE customer_id = :reg_number");
				$arrQ = array(':reg_number'=>$reg_number);
				$query->execute($arrQ);
				return $query->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function getShippinLocationMoney($state)
		{
			try{
				$query = $this->db->prepare("SELECT * FROM shipping_location_charge WHERE location = :state");
				$arrQ = array(':state'=>$state);
				$query->execute($arrQ);
				$fetch = $query->fetch();
				return $fetch;
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function gettingWishList($reg_number)
		{
			try{
				$query = $this->db->prepare("SELECT * FROM wishlist WHERE customer_id = :reg_number AND action='Wishlist'");
				$arrQ = array(':reg_number'=>$reg_number);
				$query->execute($arrQ);
				return $query->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function gettingCompared($reg_number)
		{
			try{
				$query = $this->db->prepare("SELECT * FROM wishlist WHERE customer_id = :reg_number AND action='Compare'");
				$arrQ = array(':reg_number'=>$reg_number);
				$query->execute($arrQ);
				return $query->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function gettingWishListlLimit($reg_number)
		{
			try{
				$query = $this->db->prepare("SELECT * FROM wishlist WHERE customer_id = :reg_number AND action='Wishlist' ORDER BY list_id DESC LIMIT 0,3");
				$arrQ = array(':reg_number'=>$reg_number);
				$query->execute($arrQ);
				return $query->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function gettingComparedLimit($reg_number)
		{
			try{
				$query = $this->db->prepare("SELECT * FROM wishlist WHERE customer_id = :reg_number AND action='Compare' ORDER BY list_id DESC LIMIT 0,3");
				$arrQ = array(':reg_number'=>$reg_number);
				$query->execute($arrQ);
				return $query->fetchAll(PDO::FETCH_ASSOC);
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function checkWishList($reg_number)
		{
			try{
				$query = $this->db->prepare("SELECT * FROM wishlist WHERE customer_id =:reg_number AND action='Wishlist'");
				$arrQ = array(':reg_number'=>$reg_number);
				$query->execute($arrQ);
				if($query->rowCount()==0){
					return true;
				}else{
					return false;
				}
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function checkCompared($reg_number)
		{
			try{
				$query = $this->db->prepare("SELECT * FROM wishlist WHERE customer_id =:reg_number AND action='Compare'");
				$arrQ = array(':reg_number'=>$reg_number);
				$query->execute($arrQ);
				if($query->rowCount()==0){
					return true;
				}else{
					return false;
				}
			} catch (PDOException $e) {
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}
	}

	class customersOrders extends newCustomerRegistration
		{
			
			function __construct($db){
				parent:: __construct($db);
			}

			public function getSingleOrder()
			{
				$query = $this->db->prepare("SELECT * FROM customer_order WHERE order_id = :order_id");
				$query->bindValue(":order_id", $this->orderId);			
				$query->execute();
				return $query->fetchAll(PDO::FETCH_ASSOC);
			}

			public function getTheCustomersOrder($customer_id)
			{
				$query =  $this->db->prepare("SELECT * FROM customer_order WHERE customer_id = :customer_id ORDER BY id DESC");
				$query->bindValue(":customer_id", $customer_id);			
				$query->execute();
				return $query->fetchAll(PDO::FETCH_ASSOC);
			}

			public function getTheCustomersOrderList($order_id)
			{
				$query =  $this->db->prepare("SELECT * FROM customer_order WHERE order_id = :order_id ORDER BY id DESC");
				$query->bindValue(":order_id", $order_id);			
				$query->execute();
				return $query->fetch();
			}

			public function getTheCustomerOrderDetails($order_id)
			{
				$query =  $this->db->prepare("SELECT * FROM customer_order_details WHERE order_id=:order_id ORDER BY id DESC");
				$query->bindValue(':order_id', $order_id);			
				$query->execute();
				return $query->fetchAll(PDO::FETCH_ASSOC);
			}

			public function getAllCustomerOrderDetails($order_id)
			{
				$query =  $this->db->prepare("SELECT * FROM customer_order_details WHERE order_id=:order_id ORDER BY id DESC");
				$query->bindValue(':order_id', $order_id);			
				$query->execute();
				return $query->fetch();
			}

			public function interpretePayment($pay_status)
			{
				if($pay_status == 1){ ?>
					<p style="color: green">Confirmed</p><?php
				}else{ ?>
					<p style="color: red">Pending</p><?php
				}
			}

			public function interpreteOrder($order_status)
			{
				if($order_status == 1){ ?>
					<p style="color: green">Confirmed</p><?php
				}else{ ?>
					<p style="color: red">Pending</p><?php
				}
			}
		}
?>