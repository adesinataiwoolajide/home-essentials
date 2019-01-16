<?php
	session_start();
	require("../connection/connection.php");
	require("../dev/general/all_purpose_class.php");
	try{
		$all_purpose = new all_purpose($db);
		if(isset($_POST['login'])){
			$email = $all_purpose->sanitizeInput($_POST['email']);
			$password = sha1($_POST['password']);

			$query = $db->prepare("SELECT * FROM admin_login  WHERE user_name =:email AND password =:password");
			$arr=array(':email'=>$email, ':password'=>$password);
			$query->execute($arr);
			$check = $query->rowCount();
			if($check == 0){
				$_SESSION['error'] = "invalid username or password";
				$all_purpose->redirect("./");
			}else{
				$result = $query->fetch();
				$_SESSION['user_name'] = $result['user_name'];
				$_SESSION['access'] = $result['access_level'];
				$_SESSION['name'] = $result['full_name'];
				$_SESSION['id'] = $result['user_id'];

				$user_email = $_SESSION['user_name'];
				$access = $_SESSION['access'];
				$action ="Logged In";
				$login =  $all_purpose->userAccessLevel($access, $action, $email);
			}
		}else{
			$_SESSION['error'] = "Please Login with your details";
			$all_purpose->redirect("./");
		}
	}catch(PDOException $e){
		$_SESSION['error'] = $e->getMessage();
		$all_purpose->redirect("./");
	}