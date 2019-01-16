<?php
session_start();
require_once("../../dev/autoload.php");
require_once("../../vendor/autoload.php");
require_once("../account/authenticate.php");
$order = new Order;

$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
if(!$reference){
    die('No reference supplied');
}

// initiate the Library's Paystack Object
$paystack = new Yabacon\Paystack('sk_test_483ce8535dad2c223ce439f44dfb75db683aa029');
try{
    $tranx = $paystack->transaction->verify([
        'reference'=> $_SESSION['paystackReference'], // unique to transactions
    ]);
} catch(\Yabacon\Paystack\Exception\ApiException $e){
    print_r($e->getResponseObject());
    die($e->getMessage());
}

if('success' === $tranx->data->status) {
    $order->updateOrderPaymentStatus($_SESSION['transactionId']);
    $_SESSION['success'] = "Transaction successful.";

    //send user receipt to email
    Email::sendUserPaymentReceipt($_SESSION['email'], $_SESSION['name'], $_SESSION['transactionId'], number_format($_SESSION['orderAmount']));

    //notify admin of order
    Email::sendAdminOrderNotificationEmail($_SESSION['transactionId'], $_SESSION['customerid']);
    unset($_SESSION['cart']);
    unset($_SESSION['transactionId']);
    unset($_SESSION['paystackReference']);
    General::redirectTo("../../orders.php");
}else{
    $_SESSION['error'] = "Unable to verify your transaction";
    General::redirectTo("../../checkout.php");
}

?>