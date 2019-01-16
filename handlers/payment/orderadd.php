<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "fagsam";
$dbname = "coopco";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);




if (isset($_POST['submit'])) {

	$customerid = (trim($_POST['customerid']));
	$orderid = (trim($_POST['orderid']));
	$qty = (trim($_POST['num_items']));
	


	$query = "INSERT INTO customer_order(customer_id, order_id, num_items) VALUES ('$customerid', '$orderid', '$qty')";

	$result = mysqli_query($conn, $query);

	if ($result) {
		

			
	}




}