<?php
	class staffRegistration{
		public $db;

		function __construct($db){
			$this->db= $db;
		}
		public function userRegistration($full_name, $eemail, $password, $access){
			try{
				$insert = $this->db->prepare("INSERT INTO admin_login(full_name, user_name, password, access_level) VALUES(:full_name, :eemail, :password, :access)");
				$arr = array(':full_name'=>$full_name, ':eemail'=>$eemail, ':password'=>$password, ':access'=>$access);
				if($insert->execute($arr)){
					return true;
				}else{
					return false;
				}

			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function checkDoublePassport($file_name){
			try{
				$checkPass = $this->db->prepare("SELECT * FROM passports WHERE passport_url=:file_name");
				$arrChc = array(':file_name'=>$file_name);
				$checkPass->execute($arrChc);
				if($checkPass->rowCount()>0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function addingUserPassport($eemail, $file_name){
			try{
				$insert = $this->db->prepare("INSERT INTO passports(email, passport_url)VALUES(:eemail, :file_name)");
				$arr = array(':eemail'=>$eemail, ':file_name'=>$file_name);
				$result = $insert->execute($arr);
				if($result){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function gettingRole($access){
			if($access ==1){ ?>
				<p style="color: green"> Admin </p><?php
			}else{ ?>
				<p style="color: red"> Not yet an Admin </p><?php
			}
		}

		public function gettingUserImages($users){
			try{
				$sel = $this->db->prepare("SELECT * FROM passports 	WHERE email=:users");
				$arr = array(':users'=>$users);
				$sel->execute($arr);
				$dev = $sel->fetch();
				return $dev;
				
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}

		}
		
		public function checkingUserExistence($users){
			try{
				$real = $this->db->prepare("SELECT * FROM admin_login WHERE user_name=:users");
				$att = array(':users'=>$users);
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

		public function gettingUserDetails($users){
			try{
				$geting = $this->db->prepare("SELECT * FROM admin_login WHERE user_name =:users");
				$arr = array(':users'=>$users);
				$geting->execute($arr);
				$see = $geting->fetch();
				return $see;
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function gettingPassportDetails($users){
			try{
				$getting = $this->db->prepare("SELECT * FROM passports WHERE email =:users");
				$arr = array(':users'=>$users);
				$getting->execute($arr);
				$dee = $getting->fetch();
				return $dee;
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		
		public function updateUserdetailsWithoutPic($user_id, $full_name, $eemail, $password, $access){
			try{
				$update = $this->db->prepare("UPDATE admin_login SET full_name=:full_name, user_name=:eemail, password=:password, access_level=:access WHERE user_id=:user_id");
				$arr = array(':full_name'=>$full_name, ':password'=>$password, ':eemail'=>$eemail, ':user_id'=>$user_id, ':access'=>$access);
				$result = $update->execute($arr);
				if(!empty($result)){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function updateUserThedetails($user_id, $full_name){
			try{
				$update = $this->db->prepare("UPDATE admin_login SET full_name=:full_name WHERE user_id=:user_id");
				$arr = array(':full_name'=>$full_name, ':user_id'=>$user_id);
				$result = $update->execute($arr);
				if(!empty($result)){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}


		public function updateUserdetailsID($user_id, $full_name, $access){
			try{
				$update = $this->db->prepare("UPDATE admin_login SET full_name=:full_name, access_level=:access WHERE user_id=:user_id");
				$arr = array(':full_name'=>$full_name, ':user_id'=>$user_id, ':access'=>$access);
				$result = $update->execute($arr);
				if(!empty($result)){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		
		public function seeAccess($eemail){
			try{
				$check = $this->db->prepare("SELECT * FROM admin_login WHERE user_name =:eemail");
				$arr = array(':eemail'=>$eemail);
				$check->execute($arr);
				$see = $check->fetch();
				return $see;
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function forgetPassword($email){
			try{
				$select = $this->db->prepare("SELECT * FROM admin_login WHERE user_name=:email");
				$arr = array(':email'=>$email);
				$select->execute($arr);
				if($select->rowCount()==0){
					$_SESSION['error'] = $email." ". "does not exist";
					header("Location: forget-password.php");
					die();
				}else{
					$disp = $select->fetch();
					return $disp;
				} 
			}catch(PDOException $e){
				echo $e->getMessage();
				return false;
			}
		}

		public function deleteAdminDetails($staff_email){
			try{
				$delete = $this->db->prepare("DELETE FROM admin_login WHERE user_name=:staff_email");
				$aro = array(':staff_email'=>$staff_email);
				if(!empty($delete->execute($aro))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		
		
	}
?>