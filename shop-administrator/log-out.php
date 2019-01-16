<?php
	//starting session
	session_start();
	require("../connection/connection.php");
	require("../dev/general/all_purpose_class.php");
	try{
		$all_purpose = new all_purpose($db);
		//assigning session variable to a variable
		$email = $_SESSION['user_name'];
		$action = "Logged Out";
		$his = $all_purpose->getUserDetailsandAddActivity($email, $action);
		$_SESSION['success'] = $email. " ". "You have logged out successfully";
		
		unset($email);
		//destroying the session
		session_destroy();
		//redirecting to the index page
		$all_purpose->redirect("./");	
	}catch(PDOException $e){
		$_SESSION['error'] = "Network Failure". $e->getMessage();
		$all_purpose->redirect("./");	
	}	
?>