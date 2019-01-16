
<?php $pagetitle = "Check Out Page";
	include_once("includes/header.php"); 
    // if(!isset($_SESSION['cart'])){ ?>
    //     <script>
    //         window.location=('./');
    //     </script><?php 
    //     $_SESSION['error'] = "Please Select Your Products Below"; 
    // }

    if(!isset($_SESSION['id'])){ ?>
        <script>
            window.location=('./');
        </script><?php 
        $_SESSION['error'] = "Please Login To Access This $pagetitle"; 
    }
?>
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="./">Home</a></li>
				<li class='active'><a href="checkout.php">Checkout</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="checkout-box ">
			<div class="row">
				<div class="col-md-8">
					<div class="panel-group checkout-steps" id="accordion">
						<!-- checkout-step-01  -->
						<div class="panel panel-default checkout-step-01">

							<!-- panel-heading -->
								<div class="panel-heading">
						    	<h4 class="unicase-checkout-title">
							        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
							          <span>1</span>Terms and Condition
							        </a>
							     </h4>
						    </div>
						    <!-- panel-heading -->

							<div id="collapseOne" class="panel-collapse collapse in">

								<!-- panel-body  -->
							    <div class="panel-body">
									<div class="row">		
										<!-- guest-login -->			
										<div class="col-md-12 col-sm-12 guest-login">
											<h4 class="checkout-subtitle">100% Free Shipping On Orders Greater Than 1000000</h4>
											<p class="text title-tag-line">Refund Condition</p>
										</div>
											

									</div>			
								</div>
								<!-- panel-body  -->

							</div><!-- row -->
						</div>
						<!-- checkout-step-01  -->
					    <!-- checkout-step-02  -->
					  	<div class="panel panel-default checkout-step-02">
						    <div class="panel-heading">
						      <h4 class="unicase-checkout-title">
						        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
						          <span>2</span>Refunding Order
						        </a>
						      </h4>
						    </div>
						    <div id="collapseTwo" class="panel-collapse collapse">
						      	<div class="panel-body">
						     		100% Money Refund In Case of Failed Order
						      	</div>
						    </div>
					  	</div>
					  	<!-- checkout-step-02  -->

						<!-- checkout-step-03  -->
					  	<div class="panel panel-default checkout-step-03">
						    <div class="panel-heading">
						      <h4 class="unicase-checkout-title">
						        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseThree">
						       		<span>3</span>Shipping Information
						        </a>
						      </h4>
						    </div>
						    <div id="collapseThree" class="panel-collapse collapse">
						      	<div class="panel-body"><?php 
						     		$reg_number = $_SESSION['reg_number'];
								    $shippingDetails = $register->gettingShippinCustomerAddress($reg_number);
								    $counting = count($shippingDetails); 
			                        if($counting > 0){
			                            foreach ($shippingDetails as$getAddress ){ ?>
			                                <form action="handlers/shipping/update-shipping-address.php" method="POST">
			                                    <div class="form-group required-field" >
			                                        <label>Phone Number </label>
			                                        <input type="number" name="phone" value="<?php echo $getAddress['phone'] ?>" readonly class="form-control" required>
			                                        <span style="color: red">** This Field is Required ** </span>
			                                    </div><!-- End .form-group -->

			                                    <div class="form-group required-field">
			                                        <label>Opposite, Next to or Near by </label>
			                                        <input type="text" name="landmark" value="<?php echo $getAddress['landmark'] ?>" readonly class="form-control" required>
			                                        <span style="color: red">** This Field is Required ** </span>
			                                    </div><!-- End .form-group -->

			                                    <div class="form-group">
			                                        <label>State </label>
			                                        <select class="form-control" name="state" required readonly>
			                                            <option value="<?php echo $getAddress['state'] ?>" selected><?php echo $getAddress['state'] ?> </option>
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
			                                        <textarea type="text" class="form-control" name="address" required readonly><?php echo $getAddress['address'] ?> </textarea>
			                                        <span style="color: red">** This Field is Required ** </span>
			                                    </div><!-- End .form-group -->
			                                    <input type="hidden" name="customer_id" value="<?php echo $getAddress['customer_id'] ?>">
			                                   
			                                    <div class="form-group required-field" align="center">
			                                        <a href="shipping-address.php" class="btn btn-danger" name="update-address">CHANGE SHIPPING ADDRESS</a>
			                                        
			                                    </div><!-- End .form-group -->
			                                   
			                                </form><?php 
			                            }

			                        }else{ ?>
			                        	<div class="col-lg-12">
											<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
							                    <div class="more-info-tab clearfix ">
						                            <div class="form-group required-field" align="center">
				                                        <a href="shipping-address.php" class="btn btn-danger" name="update-address">ADD SHIPPING ADDRESS</a>
				                                        
				                                    </div>
				                                </div>
				                            </div>
				                         </div><?php

			                        } ?>		
						      	</div>
						    </div>
					  	</div>
					  	<!-- checkout-step-03  -->
<!-- 
						
					    <div class="panel panel-default checkout-step-04">
						    <div class="panel-heading">
						      <h4 class="unicase-checkout-title">
						        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseFour">
						        	<span>4</span>Payment Method
						        </a>
						      </h4>
						    </div>
						    <div id="collapseFour" class="panel-collapse collapse">
							    <div class="panel-body">
							    COntent Here
							    </div>
					    	</div>
						</div>
					  	<div class="panel panel-default checkout-step-05">
						    <div class="panel-heading">
						      <h4 class="unicase-checkout-title">
						        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseFive">
						        	<span>5</span>Payment Information
						        </a>
						      </h4>
						    </div>
						    <div id="collapseFive" class="panel-collapse collapse">
						      <div class="panel-body">
						      COntent Here
						      </div>
						    </div>
					    </div>

					  	<div class="panel panel-default checkout-step-06">
						    <div class="panel-heading">
						      <h4 class="unicase-checkout-title">
						        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseSix">
						        	<span>6</span>Order Review
						        </a>
						      </h4>
						    </div>
					    	<div id="collapseSix" class="panel-collapse collapse">
					      		<div class="panel-body">
					        		Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
					      		</div>
					    	</div>
					  	</div> -->
					  	
					  	
					</div><!-- /.checkout-steps -->
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
                    if($count>0){ ?>
		                
						<div class="col-md-4">
							<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
			                    <div class="more-info-tab clearfix ">
			                    	<div class="">
										<ul class="nav nav-checkout-progress list-unstyled">
					                        <h3 align="center" style="color: green"><strong>Your Transaction Summary </strong></h3>
					                        <p>Transaction Number: <strong><?php echo $_SESSION['transactionId'];?></strong></p>
					                        <p>Shipping Fee: <strong>&#8358;<?php echo number_format($shippingFee) ?> </strong></p>
					                        <p>Product Amount: <strong>&#8358;<?php echo number_format(array_sum($total)+0);?> </strong></p>
					                        <p>Order Total: <strong>&#8358;<?php echo number_format(array_sum($total)+$shippingFee);?></strong></p>
					                    </ul>
					                </div>


			                    </div>
			                </div>
			            </div> <?php 
			        }
		        } ?>
				<div class="col-md-4">
					<!-- checkout-progress-sidebar -->
					<div class="checkout-progress-sidebar ">
						<div class="panel-group">
							<div class="panel panel-default">
								<div class="panel-heading">
							    	<h3 align="center" style="color: green">Payment Methods</h3>
							    </div>
							  	 <form action="handlers/orders/saveOrder.php" method="post" id="self">
									<input type="hidden" name="total" value="<?php echo $over = Cart::getTotalQuantity($_SESSION['cart'])[1] + $shippingFee; ?>">
		                            <input type="hidden" name="email" id="email" value="<?php echo $_SESSION['user_name']; ?>">
		                            <input type="hidden" name="subtotal" value="<?php echo Cart::getTotalQuantity($_SESSION['cart'])[1]; ?>"  >
		                            <input type="hidden" name="transactionId" value="<?php echo $_SESSION['transactionId'] ?>">
		                            <input type="hidden" name="shipping_charge" id="shipping" value="<?php echo $shippingFee; ?>">
		                            
	                                
	                                <button name="submit2" id="submit2" class="btn btn-block btn-sm btn-success">Payment On Delivery</button>
	                                <button class="btn btn-block btn-sm btn-primary" id="submit" disabled>Online Payment</button><br>
                                </form>
	                            <!-- End .shipping-address-box -->	
							</div>
						</div>
					</div> 
				</div>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
<?php include("includes/footer.php");?>