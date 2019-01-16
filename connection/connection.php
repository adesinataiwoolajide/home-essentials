<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	$dbname = "best_sellers";
	//DATABASE HOST
	$host = "localhost";
	//DATABASE USER NAME
	$user = "root";
	//DATABASE PASSWORD
	$password = "";
	try{
		$db = new PDO("mysql: host=$host; dbname=$dbname", $user, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//CHECKING IF THE DATABASE IS FOUND
			if(!empty($db)){
				//displaying successmessage
				//echo "DATABASE" . "<br>". $dbname ."<br>". "CONNECTED";
			}return $db;
	//CATCHING EXCEPTION
	} catch (PDOException $e){
		//DISPLAYING THE ERROR MESSAGE
		echo "DATABASE CONNECTION FAILED". $e->getMessage();
	}

	
?>