
<?php $pagetitle = "Shipping Address";

    include_once("includes/header.php"); 
    if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
        $count = count($cart);
    }else{
        $count = 0;
    }
    if(!isset($_SESSION['id'])){ ?>
       
        <script>
            window.location=('login.php');
        </script><?php 
        $_SESSION['error'] = "Please Register Or Login into Your Account"; 
    }

    $reg_number = $_SESSION['reg_number'];
    $shippingDetails = $register->gettingShippinCustomerAddress($reg_number);
    $counting = count($shippingDetails);
?>

<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="./">Home</a></li>
				<li><a href="shipping-address.php"> Shipping Address</a></li>
				
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product'>
			<div class='col-md-3 sidebar'>
				<div class="sidebar-module-container">
					<div class="home-banner outer-top-n">
						<img src="assets/images/banners/LHS-banner.jpg" alt="Image">
					</div>		
   
					<div class="sidebar-widget hot-deals wow fadeInUp outer-top-vs">
						<h3 class="section-title">Newsletters</h3>
						<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs">
							<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
		                        <h2 class="title">Help Center</h2>
		                        <p>Incase of Any Emergency.</p>
		                        <ul class="contact-link">
		                        	<li>
		                                <a href="#"> 
		                                    <i class="fa fa-user"></i>
		                                    Adesina Taiwo Olajide
		                                </a>
		                            </li>
		                            <li>
		                                <a href="#"> 
		                                    <i class="fa fa-map-marker"></i>
		                                    Adesina Taiwo Olajide
		                                </a>
		                            </li>
		                            <li>
		                                <a href="tel:+55-417-634-7071"> 
		                                    <i class="fa fa-phone"></i>
		                                    08138139333
		                                </a>
		                            </li>
		                            <li>
		                                <a href="mailto:info@themevessel.com">
		                                    <i class="fa fa-envelope-o"></i>
		                                    support@homeessantials.com
		                                </a>
		                            </li>
		                        </ul>
		                    </div>
							<div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
					            
					            <div class="sidebar-widget-body outer-top-xs">
					                <p>Sign Up for Our Newsletter!</p>
					                <form>
					                    <div class="form-group">
					                        <label class="sr-only" for="exampleInputEmail1">Email address</label>
					                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
					                    </div>
					                    <button class="btn btn-primary">Subscribe</button>
					                </form>
					            </div>
					            <!-- /.sidebar-widget-body --> 
					        </div>
					    </div>
					</div>
				</div>
			</div><!-- /.sidebar -->
			<div class='col-md-9'>
	            <div class="detail-block">
					<div class="row  wow fadeInUp">
						<div class="account-wrapper">
						<!-- Sign-in -->			
							<div class="col-md-12 col-sm-12 sign-in">
								<h4 class="" align="center">Product Shipping Address</h4>
								<p class="" align="center">Please Add Your Shipping Address Below</p>
								<?php 
		                        if($counting > 0){
		                            foreach ($shippingDetails as$getAddress ){ ?>
		                                <form action="handlers/shipping/update-shipping-address.php" method="POST">
		                                    <div class="form-group required-field" >
		                                        <label>Phone Number </label>
		                                        <input type="number" name="phone" value="<?php echo $getAddress['phone'] ?>" class="form-control" required>
		                                        <span style="color: red">** This Field is Required ** </span>
		                                    </div><!-- End .form-group -->

		                                    <div class="form-group required-field">
		                                        <label>Opposite, Next to or Near by </label>
		                                        <input type="text" name="landmark" value="<?php echo $getAddress['landmark'] ?>" class="form-control" required>
		                                        <span style="color: red">** This Field is Required ** </span>
		                                    </div><!-- End .form-group -->

		                                    <div class="form-group">
		                                        <label>State </label>
		                                        <select class="form-control" name="state" required>
		                                            <option value="<?php echo $getAddress['state'] ?>"><?php echo $getAddress['state'] ?> </option>
		                                            <option value=""></option><?php 
		                                            $zone = $db->prepare("SELECT * FROM shipping_location_charge ORDER BY location ASC");
		                                            $zone->execute(); 
		                                            while($see_state = $zone->fetch()){ ?>
		                                                <option value="<?php echo $see_state['location']; ?>"><?php echo $see_state['location']. " State"; ?></option><?php  
		                                            } ?>
		                                        </select>
		                                        <span style="color: red">** This Field is Required ** </span>
		                                    </div><!-- End .form-group -->
		                                     
		                                    <div class="form-group required-field">
		                                        <label>Street Address </label>
		                                        <textarea type="text" class="form-control" name="address" required><?php echo $getAddress['address'] ?> </textarea>
		                                        <span style="color: red">** This Field is Required ** </span>
		                                    </div><!-- End .form-group -->
		                                    <input type="hidden" name="customer_id" value="<?php echo $getAddress['customer_id'] ?>">
		                                   
		                                    <div class="form-group required-field" align="center">
		                                        <button class="btn btn-danger" name="update-address">UPDATE SHIPPING ADDRESS</button>
		                                        
		                                    </div><!-- End .form-group -->
		                                   
		                                </form><?php 
		                            }

		                        }else{ ?>
		                            <form action="handlers/shipping/add-shipping-address.php" method="POST">
		                                <div class="form-group required-field" >
		                                    <label>Phone Number </label>
		                                    <input type="number" name="phone" class="form-control" required>
		                                    <span style="color: red">** This Field is Required ** </span>
		                                </div><!-- End .form-group -->

		                                <div class="form-group required-field">
		                                    <label>Opposite, Next to or Near by </label>
		                                    <input type="text" name="landmark" class="form-control" required>
		                                    <span style="color: red">** This Field is Required ** </span>
		                                </div><!-- End .form-group -->

		                                <div class="form-group">
		                                    <label>State </label>
		                                    <select class="form-control" name="state" required>
		                                        <option value="">-- Select Your City or State --</option>
		                                        <option value=""> </option><?php 
		                                        $zone = $db->prepare("SELECT * FROM shipping_location_charge ORDER BY location ASC");
		                                        $zone->execute(); 
		                                        while($see_state = $zone->fetch()){ ?>
		                                            <option value="<?php echo $see_state['location']; ?>"><?php echo $see_state['location']; ?></option><?php  
		                                        } ?>

		                                    </select>
		                                    <span style="color: red">** This Field is Required ** </span>
		                                </div><!-- End .form-group -->
		                                 
		                                <div class="form-group required-field">
		                                    <label>Street Address </label>
		                                    <textarea type="text" class="form-control" name="address" required> </textarea>
		                                    <span style="color: red">** This Field is Required ** </span>
		                                </div><!-- End .form-group -->

		                               
		                                <div class="form-group required-field" align="center">
		                                    <button class="btn btn-danger" name="add-address">ADD SHIPPING/DELIVERY ADDRESS</button>

		                                </div><!-- End .form-group -->
		                               
		                            </form><?php
		                        } ?>		
							</div>
						<!-- Sign-in -->			
						</div>

					</div>
                </div>
                <?php
		        if(isset($_SESSION['cart'])){ 
		        	$cart = $_SESSION['cart'];
                    $count = count($cart);
                    $reg_number = $_SESSION['reg_number'];
                    $shipLocation = $register->getShippinCusgAddress($reg_number); 
                    $state = $shipLocation['state']; 
                    $shipAmount = $register->getShippinLocationMoney($state); 
                    $shippingFee = $shipAmount['charge']; 
                    if($count>0){ ?> ?>
		                <div class="col-lg-6">
							<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
			                    <div class="more-info-tab clearfix ">
			                    	<h3 align="center" style="color: green"><strong>More Options </strong></h3>
			                    	<a href="shopping-cart.php"class="btn btn-block btn-sm btn-danger">BACK TO CART</a>
		                            <a href="checkout.php" class="btn btn-block btn-sm btn-success">Go to Checkout</a>
		                            <a href="./" class="btn btn-block btn-sm btn-primary">Continue Shopping</a>   
								</div>	
			                </div>
			            </div>
						<div class="col-lg-6">
							<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
			                    <div class="more-info-tab clearfix ">
			                        <h3 align="center" style="color: green"><strong>Your Transaction Summary </strong></h3>
			                        <p>Transaction Number: <strong><?php echo $_SESSION['transactionId'];?></strong></p>
			                        <p>Shipping Fee: <strong>&#8358;<?php echo number_format($shippingFee) ?> </strong></p>
			                        <p>Product Amount: <strong>&#8358;<?php echo number_format(array_sum($total)+0);?> </strong></p>
			                        <p>Order Total: <strong>&#8358;<?php echo number_format(array_sum($total)+$shippingFee);?></strong></p>
			                    </div>
			                </div>
			            </div> <?php 
			        }else{ ?>
			        	<div class="col-lg-12">
							<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
			                    <div class="more-info-tab clearfix ">
			                        <a href="./" class="btn btn-block btn-sm btn-danger">Continue Shopping</a>  
			                    </div>
			                </div>

	                    </div><?php
			        }
		        }else{ ?>
                     <div class="col-lg-12">
						<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
		                    <div class="more-info-tab clearfix ">
		                        <a href="./" class="btn btn-block btn-sm btn-danger">Continue Shopping</a>  
		                    </div>
		                </div>

                    </div><!-- End .checkout-methods --><?php
		        } ?>
            </div>
        </div>
        
    </section>
   

</div><!-- /.col -->
	<div class="clearfix"></div>
</div><!-- /.row -->
<?php include("includes/footer.php");?>