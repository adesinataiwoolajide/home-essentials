<?php
	if(!isset($_SESSION['buyer_id'])){
		header("Location: sign-in.php");
	}
	$buyer_id = $_SESSION['buyer_id'];
?>