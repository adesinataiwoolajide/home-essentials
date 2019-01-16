<?php
	class ragzNationStaffDetails{

		private $db;

		function __construct($db){
			$this->db = $db;
		}

		public function addNewStaffDetails($file_name, $staff_number, $staff_name, $date_birth, $year_employ, $staff_email, $staff_sex, $staff_phone, $type_id, $address, $marital_status, $qualification_id, $kin_details, $religion, $state_origin){
			try{
				$insertData = $this->db->prepare("INSERT INTO staff(passport, staff_number, staff_name, sex, marital_status, religion, date_birth, staff_email, staff_phone, address, type_id, year_employ, state_origin, qualification_id, kin_details)VALUES(:file_name , :staff_number, :staff_name, :staff_sex, :marital_status, :religion, :date_birth, :staff_email, :staff_phone, :address, :type_id, :year_employ, :state_origin, :qualification_id, :kin_details)");
				$arrInst = array(':file_name'=>$file_name,':staff_number'=>$staff_number, ':staff_name'=>$staff_name, ':staff_sex'=>$staff_sex, ':marital_status'=>$marital_status, ':religion'=>$religion, ':date_birth'=>$date_birth,  ':staff_email'=>$staff_email,  ':staff_phone'=>$staff_phone, ':address'=>$address,':type_id'=>$type_id, ':year_employ'=>$year_employ, ':state_origin'=>$state_origin, ':qualification_id'=>$qualification_id, ':kin_details'=>$kin_details);
				if(!empty($insertData->execute($arrInst))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				
			}
		}

		public function updateStaffDetailsWithImage($file_name, $staff_number, $staff_name, $date_birth, $year_employ, $staff_email, $staff_sex, $staff_phone, $type_id, $address, $marital_status, $qualification_id, $kin_details, $religion, $state_origin){
			try{
				$upDee = $this->db->prepare("UPDATE staff SET passport=:file_name, staff_name=:staff_name, sex=:staff_sex, marital_status=:marital_status, religion=:religion, date_birth=:date_birth, staff_email=:staff_email, staff_phone=:staff_phone, address=:address, type_id=:type_id, year_employ=:year_employ, state_origin=:state_origin, qualification_id=:qualification_id, kin_details=:kin_details  WHERE staff_number=:staff_number");
				$arrup = array(':file_name'=>$file_name, ':staff_number'=>$staff_number, ':staff_name'=>$staff_name, ':staff_sex'=>$staff_sex, ':marital_status'=>$marital_status, ':religion'=>$religion, ':date_birth'=>$date_birth,  ':staff_email'=>$staff_email,  ':staff_phone'=>$staff_phone, ':address'=>$address,':type_id'=>$type_id, ':year_employ'=>$year_employ, ':state_origin'=>$state_origin, ':qualification_id'=>$qualification_id, ':kin_details'=>$kin_details);
				if(!empty($upDee->execute($arrup))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				echo $e->getMessage();
			}
		}

		public function updateStaffDetailsWithOutPass($staff_number, $staff_name, $date_birth, $year_employ, $staff_email, $staff_sex, $staff_phone, $type_id, $address, $marital_status, $qualification_id, $kin_details, $religion, $state_origin){
			try{
				$upDee = $this->db->prepare("UPDATE staff SET staff_name=:staff_name, sex=:staff_sex, marital_status=:marital_status, religion=:religion, date_birth=:date_birth, staff_email=:staff_email, staff_phone=:staff_phone, address=:address, type_id=:type_id, year_employ=:year_employ, state_origin=:state_origin, qualification_id=:qualification_id, kin_details=:kin_details  WHERE staff_number=:staff_number");
				$arrup = array(':staff_number'=>$staff_number, ':staff_name'=>$staff_name, ':staff_sex'=>$staff_sex, ':marital_status'=>$marital_status, ':religion'=>$religion, ':date_birth'=>$date_birth,  ':staff_email'=>$staff_email,  ':staff_phone'=>$staff_phone, ':address'=>$address,':type_id'=>$type_id, ':year_employ'=>$year_employ, ':state_origin'=>$state_origin, ':qualification_id'=>$qualification_id, ':kin_details'=>$kin_details);
				if(!empty($upDee->execute($arrup))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				
			}
		}

		public function checkStaffExistenceEmail($staff_email){
			try{
				$exist = $this->db->prepare("SELECT * FROM staff WHERE staff_email=:staff_email ");
				$arrEx = array('staff_email'=>$staff_email);
				$exist->execute($arrEx);
				if($exist->rowCount()>0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function checkStaffExistencePhoneNumber($staff_phone){
			try{
				$exist = $this->db->prepare("SELECT * FROM staff WHERE staff_phone=:staff_phone");
				$arrEx = array('staff_phone'=>$staff_phone);
				$exist->execute($arrEx);
				if($exist->rowCount()>0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function gettingStafftDetails($staff_number){
			try{
				$getting = $this->db->prepare("SELECT * FROM staff WHERE staff_number=:staff_number");
				$arrGet = array(':staff_number'=>$staff_number);
				$getting->execute($arrGet);
				$depp = $getting->fetch();
				return $depp;
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function gettingStafftEmail($staff_email){
			try{
				$getting = $this->db->prepare("SELECT * FROM staff WHERE staff_email=:staff_email");
				$arrGet = array(':staff_email'=>$staff_email);
				$getting->execute($arrGet);
				$depp = $getting->fetch();
				return $depp;
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}
		public function checkStaffPassPortExistence($file_name){
			try{
				$check = $this->db->prepare("SELECT * FROM staff WHERE passport_url=:file_name");
				$arrCheck = array(':file_name'=>$file_name);
				$check->execute($arrCheck);
				if($check->rowCount() > 0){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}


		public function deleteStaffDetails($staff_number){
			try{
				$del = $this->db->prepare("DELETE FROM staff WHERE staff_number=:staff_number");
				$arrDel = array(':staff_number'=>$staff_number);
				if(!empty($del->execute($arrDel))){
					return true;
				}else{
					return false;
				}
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		
		public function getStaffType($type_id){
			try{
				$type =$this->db->prepare("SELECT * FROM staff_type WHERE type_id=:type_id");
				$arrType = array(':type_id'=>$type_id);
				$type->execute($arrType);
				$rave=$type->fetch();
				return $rave;
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}

		public function getStaffQualification($qualification_id){
			try{
				$qua =$this->db->prepare("SELECT * FROM qualification WHERE qualification_id=:qualification_id");
				$arrQue = array(':qualification_id'=>$qualification_id);
				$qua->execute($arrQue);
				$rav=$qua->fetch();
				return $rav;
			}catch(PDOException $e){
				$_SESSION['error'] = $e->getMessage();
				return false;
			}
		}
	}
?>