<?php //get product main categories 
    session_start();
    
    include_once("connection/connection.php");
    $getCatgories = $db->prepare("SELECT * FROM products_category ORDER BY category_name asc");
    $fetchCategories = $getCatgories->fetchAll();
    $cate = $db->prepare("SELECT * FROM products_category ORDER BY category_id desc LIMIT 0,5 ");
    $cate->execute();
    require 'libs_dev/products/products_class.php';
    require 'libs_dev/merchant/merchant_class.php';
    require 'dev_class/register/customer_registration_class.php';
    require 'dev_class/Cart.php';
    require 'dev_class/General.php';
    $productsCate = new ragzNationProductsCategory($db);
    $productDetails = new ragzNationProducts($db);
    $register = new newCustomerRegistration($db);
    $carting = new Cart();
    $general = new General();
    $merchantDetails = new productMerchant($db);
    $custOrder = new customersOrders($db);
    //$bestProduct = $productDetails->getAllBestProductsPublish();

    $lastProduct = $productDetails->getAllLastProductsPublish();
    $totalItems =  count($productDetails->getAllProductsPublish());
    $itemsPerPage = 12;
    $page = isset($_GET['page']) ? ($_GET['page']) : 1;
    $start = $page > 1 ? ($page * $itemsPerPage) - $itemsPerPage : 0;
    $totalPages = ceil($totalItems / $itemsPerPage);
    $listingProduct = $productDetails->getPaginateProductsPublish($start, $itemsPerPage);
    $bestProduct = $productDetails->getPaginateProductsPublishFeature($start, $itemsPerPage);
    if(!isset($_SESSION['transactionId'])){
        $_SESSION['transactionId'] = $general->generateRandomHash(16);   
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<!-- <meta name="keywords" content="MediaCenter, Template, eCommerce">
 --><meta name="robots" content="all">
<title>HomeEssentials.com | Home of  Quality Home Accessories - <?php echo $pagetitle; ?></title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">

<!-- Customizable CSS -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/blue.css">
<link rel="stylesheet" href="assets/css/owl.carousel.css">
<link rel="stylesheet" href="assets/css/owl.transitions.css">
<link rel="stylesheet" href="assets/css/animate.min.css">
<link rel="stylesheet" href="assets/css/rateit.css">
<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
<link rel="stylesheet" href="assets/css/custom.css">
<link rel="stylesheet" href="libraries/sweetalert/sweetalert.css">
<!-- Icons/Glyphs -->
<link rel="stylesheet" href="assets/css/font-awesome.css">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="libraries/Toast/css/Toast.min.css">

</head>
<body class="cnt-home">
<!-- ============================================== HEADER ============================================== -->
<header class="header-style-1"> 
  
  <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled"><?php

                        if(isset($_SESSION['reg_number'])){ 
                            $reg_number = $_SESSION['reg_number'];
                            $comp =  count($register->gettingCompared($reg_number));
                            $seeWish = $register->gettingWishListlLimit($reg_number);
                            $wish =  count($register->gettingWishList($reg_number));
                            $seeComp = $register->gettingComparedLimit($reg_number); ?>

                            <li><a href="my-wishlist.php?reg_number=<?php echo $reg_number ?>"><i class="icon fa fa-heart"></i>Wishlist<sup class="count"><b><?php if($wish >0){ echo $wish; } else{ echo 0; } ?></b></sup></a></li>
                            <li><a href="my-comparelist.php?reg_number=<?php echo $reg_number ?>"><i class="icon fa fa-signal"></i>Compared <sup class="count"><b><?php if($comp >0){ echo $comp; } else{ echo 0; } ?></b></sup></a></li>
                            <li><a href="shopping-cart.php"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
                            <li><a href="shipping-address.php"><i class="icon fa fa-map-marker"></i>Shipping Address</a></li>
                            <li><a href="dashboard.php"><i class="icon fa fa-user"></i>My Dashboard</a></li>
                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Sign Out</a></li><?php

                        }else{ ?>

                            <li><a href="wishlist.php"><i class="icon fa fa-heart"></i>Wishlist</a></li>
                            <li><a href="shopping-cart.php"><i class="icon fa fa-shopping-cart"></i>My Cart</a></li>
                            <li><a href="register.php"><i class="icon fa fa-user"></i>Create Account</a></li>
                            <li><a href="forgot-password.php"><i class="icon fa fa-lock"></i>Retrieve Account</a></li>
                            <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span>Sign In</a></li><?php

                        } ?>
                    </ul>
                </div>
        
                
                <!-- /.cnt-cart -->
                <div class="clearfix"></div>
            </div>
        <!-- /.header-top-inner --> 
        </div>
    <!-- /.container --> 
    </div>
      <!-- /.header-top --> 
      <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder"> 
          
                    <div class="logo"> <a href="./"> <img src="assets/images/homelogo.jpg" alt="logo" style="width: 51px; height: 58"> </a> </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">  
                    <div class="search-area">
                        <form>
                        <div class="control-group">
                            <ul class="categories-filter animate-dropdown">
                                <li class="dropdown"> 
                                    <a class="dropdown-toggle"  data-toggle="dropdown" href="category.php">Categories <b class="caret"></b></a>
                                    <ul class="dropdown-menu" role="menu" ><?php
                                        while($see_cate = $cate->fetch()){?>
                                            <li>
                                                <a href="products-categories.php?category_name=<?php echo $see_cate['category_name'] ?> ">
                                                    <?php echo $see_cate['category_name'] ?> 
                                                </a> 
                                            </li><?php
                                        } ?>   
                                    </ul>
                                </li>
                            </ul>
                            <input class="search-field" placeholder="Search here..." />
                            <a class="search-button" href="#" ></a> 
                        </div>
                    </form>
                </div>
            </div>
        
            <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row"> 
                  
                <div class="dropdown dropdown-cart"> 
                    <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                        <div class="items-cart-inner">
                            <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                            <div class="basket-item-count"><?php 
                                if(isset($_SESSION['cart'])){?>
                                    <span class="count" id=""><?php
                                    echo count($_SESSION['cart']);?></span><?php
                               }else{ ?>
                                   <span class="count" id="">0 </span><?php
                               }?>
                            </div>
                            <div class="total-price-basket"> 
                                <!-- <span class="lbl">cart -</span> 
                                <span class="total-price"> 
                                    <span class="sign">$</span>
                                    <span class="value">600.00</span> 
                                </span>  -->
                            </div>
                        </div>
                    </a><?php
                    if(isset($_SESSION['cart'])){
                        $cart = $_SESSION['cart'];
                        $count = count($cart);
                        if($count > 0){
                            $total = array(); ?>
                            <ul class="dropdown-menu">
                                <li><?php
                                    foreach($cart as $item){  
                                        $product_number = $item['product_number'];
                                        $ragzProduct = $productDetails->getProductsDet($product_number);
                                        $ragzProductDetails = $productDetails->getProductsDetails($product_number);
                                        $tripple = $productDetails->getTrippleProductsDet($product_number);  ?>
                                        <div class="cart-item product-summary">
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    
                                                    <div class="image"> <a href="product-detail.php?product_number=<?php echo $product_number ?>">
                                                        <img src="<?php echo 'images/product/large-image/'.$ragzProduct['product_image'] ?>" alt="product" width="50" height="50"></a> 
                                                    </div>
                                                </div>
                                                <div class="col-xs-7">
                                                    <h3 class="name"><a href="product-detail.php?product_number=<?php echo $product_number ?>"><?php echo $tripple['product_name']; ?></a></h3>
                                                    <div class="price">&#8358;<?php 
                                                        echo  $price =$item['price'];
                                                        $cal = $price * $item['quantity'];
                                                        array_push($total, $price); ?></div>
                                                </div>
                                                <div class="col-xs-1 action"> <a href="handlers/cart/removeFromCart.php?product_number=<?php echo $product_number ?>"><i class="fa fa-trash"></i></a> </div>
                                            </div>
                                        </div><?php 
                                    } ?>

                                    <!-- /.cart-item -->
                                    <div class="clearfix"></div>
                                    <hr>
                                    <div class="clearfix cart-total">
                                        <div class="pull-right"> 
                                            <span class="text">Sub Total :</span>
                                            <span class='price'>&#8358;<?php echo number_format(array_sum($total));?></span> 
                                        </div>
                                        <div class="clearfix"></div>
                                        <a href="shopping-cart.php" class="btn btn-upper btn-success btn-block m-t-20">Cart</a> 
                                        <!-- <a href="checkout.php" class="btn btn-upper btn-primary btn-block m-t-20">Checkout</a> --> 
                                    </div>
                                </li>
                            </ul><?php 
                        }
                    } ?>
                    <!-- /.dropdown-menu--> 
                </div>
            </div>
        </div>      
    </div>
</div>
  <!-- /.main-header --> 
  
  <!-- ============================================== NAVBAR ============================================== -->
 	
               
<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
                    <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> 
                </button>
            </div>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                    <div class="nav-outer">
                        <ul class="nav navbar-nav">
                            <li class=" dropdown yamm-fw"> <a href="./">Home</a> </li>
                            <li class="dropdown"> 
                                <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Categories</a>
                                <ul class="dropdown-menu pages">
                                    <li>
                                        <div class="yamm-content">
                                            <div class="row">
                                                <div class="col-xs-12 col-menu">
                                                    <ul class="links">
                                                        <?php
                                                        $cate = $db->prepare("SELECT * FROM products_category ORDER BY category_id desc");
                                                        $cate->execute();
                                                        while($see_cate = $cate->fetch()){?>
                                                            <li>
                                                                <a href="products-categories.php?category_name=<?php echo $see_cate['category_name'] ?> ">
                                                                    <?php echo $see_cate['category_name'] ?> 
                                                                </a> 
                                                            </li><?php
                                                        } ?>                       
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown"> 
                                <a href="#" class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown">Product Types</a>
                                <ul class="dropdown-menu pages">
                                    <li>
                                        <div class="yamm-content">
                                            <div class="row">
                                                <div class="col-xs-12 col-menu">
                                                    <ul class="links">
                                                        <?php
                                                         $cate = $db->prepare("SELECT * FROM product_type ORDER BY type_name desc");
                                                         $cate->execute();
                                                         while($see_cate = $cate->fetch()){?>
                                                            <li>
                                                                <a href="products-types.php?type_name=<?php echo $see_cate['type_name'] ?> ">
                                                                    <?php echo $see_cate['type_name'] ?> 
                                                                </a> 
                                                            </li><?php
                                                        } ?>                       
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
               
                            <li class="dropdown hidden-sm"> <a href="faq.php">FAQ</a> </li>
                            <li class="dropdown"> <a href="track-orders.php">TRACK ORDERS</a> </li>
                            <li class="dropdown"> <a href="product-comparison.php">PRODUCT COMPARISON</a> </li>
                            <li class="dropdown"> <a href="track-orders.php">TRACK ORDERS</a> </li>
                            <li class="dropdown"> <a href="product-comparison.php">PRODUCT COMPARISON</a> </li> 
                        </ul>
    
                    </div>
  
</header>

<!-- ============================================== HEADER : END ============================================== -->