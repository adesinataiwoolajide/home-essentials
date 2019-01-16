<?php
session_start();
require_once("../../dev/autoload.php");
require_once("../account/authenticate.php");
unset($_SESSION['amount']);
unset($_SESSION['transactionId']);
General::redirectTo("../../orders.php");
?>