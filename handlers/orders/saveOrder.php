<?php
session_start();
//require_once("../../dev/autoload.php");
include_once("../../connection/connection.php");
require '../../dev_class/customerOrder.php';
require '../../dev_class/Payment.php';
//require_once("../../vendor/autoload.php");
//require_once("../account/authenticate.php");
$order = new Order($db);
$payment = new Payment;

    $_SESSION['paystackReference'] = bin2hex(random_bytes(10));
    $customer_id = $_SESSION['reg_number'];
    $order->deleteOrders($_SESSION['transactionId']);
    $paystackReference = $_SESSION['paystackReference']; // delete instance of this order
   
    $saveOrder = $order->saveOrder($_SESSION['reg_number'], $_SESSION['transactionId'], $_SESSION['paystackReference'], 0,0, $_POST['subtotal'], $_POST['shipping_charge'], $_POST['total']); //save order
    if($saveOrder){

        foreach($_SESSION['cart'] as $key){
            $order->getProductId($key['product_number']);
            $order->getQuantity($key['quantity']);
            $order->getAmount($key['price']);
            $order->saveOrderDetails($_SESSION['transactionId'], $key['product_number'], $key['quantity'], $key['price']);
        }

        if(isset($_POST['submit2'])){
            $method_name = "Payment on Delivery";
            $order->addPaymentType($method_name, $paystackReference, $customer_id);
            $_SESSION['success'] = "You Have Selected Payment on Delivery Successfully, The Company will Contact You To Confirm Your Orders, Please Kindly Logout To Begin Another Transaction. Thanks";
            unset($_SESSION['cart']);
            //destroying the session
            session_destroy();
            header('Location: ../.././');
        }else{
            $method_name = "Online Payment";
            $_SESSION['orderAmount'] = $_POST['total'];
            $order->addPaymentType($method_name, $paystackReference, $customer_id);
            $paystack = new Yabacon\Paystack('sk_test_483ce8535dad2c223ce439f44dfb75db683aa029');
            try
            {
                $tranx = $paystack->transaction->initialize([
                    'amount'=> $_POST['total'] * 100,       // in kobo
                    'email'=> $_SESSION['user_name'],         // unique to customers
                    'reference'=> $_SESSION['paystackReference'], // unique to transactions
                ]);
            } catch(\Yabacon\Paystack\Exception\ApiException $e){
                $_SESSION['error'] = "Unable to proceed with the transaction. Please try again";
                General::redirectTo("../../checkout.php");        
            }
            $order->updateOrderWithPaystackReference($_SESSION['transactionId'], $tranx->data->reference);
            header('Location: ' . $tranx->data->authorization_url);    
         }
       
    }else{
        $_SESSION['error'] = "Unable to proceed with the transaction. Please try again";
        General::redirectTo("../../checkout.php");            
    }


?>