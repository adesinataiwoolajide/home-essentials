<?php
	require_once("db_connection_constants.php");
	try{
		$db = new PDO('mysql:host='. HOST .';dbname='.DBNAME,USERNAME,PASSWORD);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	}catch(PDOException $e){
		die($e->getMessage());
	}
?>