<?php
    if(!isset($_SESSION['id'])){
        $_SESSION['error']="Please Login with your Details to Access the System";
        header("Location: .././");
    }
    require("../../connection/connection.php");
    include("../../dev/registration/class_registration.php");
    $register = new staffRegistration($db);
    $users = $_SESSION['user_name'];
    $image = $register->gettingUserImages($users);
?>
<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>GLORIOUS EMPIRE CLOTHENS</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="../../images/diamondville logo.png" style="width: 16px; height: 16px;" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <link rel="stylesheet" type="text/css" href="../assets/Toast/css/Toast.min.css">
        <!-- EOF CSS INCLUDE -->                                    
    </head>
    <body>