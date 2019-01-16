<?php
session_start();
require_once("../../dev/autoload.php");
require_once("../account/authenticate.php");
$notification = new Notifications;
$notification->notificationId = General::sanitiseInput($_GET['id']);
$notification->status = 1;
if($notification->markNotificationAsRead()){
	$_SESSION['success'] = "Notification marked as read";
	General::redirectTo("../../notifications.php");
}else{
	$_SESSION['error'] = "Unable to mark notification as read";
	General::redirectTo("../../notifications.php");	
}
?>