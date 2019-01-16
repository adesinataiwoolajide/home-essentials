
<?php $pagetitle = "Shopping Cart";
include_once("includes/header.php"); 
    if(!isset($_SESSION['id'])){ ?>
        <script>
            window.location=('login.php');
        </script><?php 
        $_SESSION['error'] = "Please Register Or Login into Your Account"; 
    }
    
?>
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="#">Home</a></li>
				<li class='active'>Shopping Cart</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
	<div class="container">
		<div class="row "><?php 
			if(!isset($_SESSION['cart'])){ ?>
				<div class="col-lg-3">
					<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
	                    <div class="home-banner outer-top-n">
							<img src="assets/images/banners/LHS-banner.jpg" alt="Image">
						</div>	
	                </div>
	            </div>
				<div class="col-lg-9">
					<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
	                    <div class="more-info-tab clearfix ">
	                        <h3><p style="color: red" align="center">Your Shopping is Empty</p></h3>
	                    </div>
	                </div>
	            </div>  <?php 
			}else{
				$cart = $_SESSION['cart'];
		        $count = count($cart);
		        $reg_number = $_SESSION['reg_number'];
		        $shipLocation = $register->getShippinCusgAddress($reg_number); 
		        $state = $shipLocation['state']; 
		        $shipAmount = $register->getShippinLocationMoney($state); 
		        $shippingFee = $shipAmount['charge']; ?>
				<div class="shopping-cart">
					<div class="cart-table-container">
	                    <table class="table table-cart">
							<thead>
								<tr>
									<th class="cart-romove item">Remove</th>
									<th class="th-lg">Image</th>
									<th class="th-lg">Product Name</th>
									<th class="th-lg">Price</th>
									<th class="cart-qty item">Quantity</th>
									<th class="cart-sub-total item">Size</th>
									<th class="th-lg">Grandtotal</th>
								</tr>
								
							</thead><!-- /thead -->
							<tfoot>
								<tr>
									<td colspan="7">
										<div class="shopping-cart-btn">
											<span class="">
												<a href="./" class="btn btn-upper btn-primary outer-left-xs">Continue Shopping</a>
												<a href="#" class="btn btn-upper btn-primary pull-right outer-right-xs">Update shopping cart</a>
											</span>
										</div><!-- /.shopping-cart-btn -->
									</td>
								</tr>
							</tfoot>
							<tbody>
								<?php
	                            $total = array();
	                            $y =1;
	                            foreach($cart as $item){  
	                                $product_number = $item['product_number'];
	                                $ragzProduct = $productDetails->getProductsDet($product_number);
	                                $ragzProductDetails = $productDetails->getProductsDetails($product_number);
	                                $manufacturer_id = $ragzProduct['manufacturer_id'];
	                                $manuDetails = $productDetails->getRagzManufacturerDetails($manufacturer_id);
	                                $manufacturer_name = $manuDetails['manufacturer_name']; ?>
	                                <tr>
	                                    <td><?php echo $y; ?></td>
	                                    <td class="product-thumbnail">
	                                       <img src="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" alt="product" width="50" height="40">
	                                    </td>
	                                    <td class="product-name">
	                                        <span><?php echo ucwords($item['name']); ?> </span>
	                                    </td>
	                                    
	                                    <td class="product-quantity">
	                                        &#8358;<?php echo number_format($ragzProductDetails['product_price']) ?>
	                                    </td> <?php 
	                                        $price =$ragzProductDetails['product_price'];
	                                        $cal = $price * $item['quantity'];
	                                        array_push($total, $price); ?> 
	                                    <td>
	                                        <?php $early = $ragzProductDetails['quantity'];  $current =1;  ?>
											<select name="quantity" id="quantity" class="form-control" required>
												<?php for($i =  $ragzProductDetails['quantity']; $i >= 1; $i--){?>
													<option value="<?php echo $i;?>" selected> <?php echo $i; ?> </option>
												<?php }?>
											</select>
	                                    </td>
	                                    <td>
	                                        <?php $sizeArray = explode(",", $ragzProductDetails['product_size']);?>
	                                        <?php 
	                                        if(count($sizeArray)){
	                                        	if($sizeArray != "Null"){ ?>
		                                            <select names="sizes" id="product_size" class="form-control" required> <?php  
		                                                foreach($sizeArray as $size){?>
		                                                    <option value="<?php echo trim($size); ?>" selected><?php echo $size; ?></option><?php
		                                                 } ?>
		                                            </select><?php
		                                        }else{ ?>
		                                        	<input type="text" name="product_size" id="product_size"> value="<?php echo "NULL" ?>"><?php
		                                        } 
	                                        } ?>
	                                    </td>
	                                    
	                                    <td class="product-remove">
	                                        <a href="handlers/cart/removeFromCart.php?product_number=<?php echo $product_number?>"><i class="fa fa-trash-o"></i></a>
	                                    </td>
	                                </tr><?php 
	                                $y++; 
	                            } ?>         
								
								
							</tbody><!-- /tbody -->
						</table><!-- /table -->
					</div>
					<script>
						let product_size = document.querySelector("#product_size").value;
						let quantity = document.querySelector("#quantity").value;
						if(product_size == ""){
							alert("Please Select The Product Size");
							return false;
						}

						if(quantity == ""){
							alert("Please Select The Product Quantity");
							return false;
						}								
					</script>	

					<div class="col-md-12 col-sm-12 cart-shopping-total" align="right">
						<table class="table">
							<thead>
								<tr>
									<th>
										<div class="cart-sub-total">
											Shipping Charges<span class="inner-left-md">$600.00</span>
										</div>
										<div class="cart-grand-total">
											Grand Total<span class="inner-left-md">&#8358;<?php echo number_format(array_sum($total)+1000);?></span>
										</div>
									</th>
								</tr>
							</thead><!-- /thead -->
							<tbody>
								<tr>
									<td>
										<div class="cart-checkout-btn pull-left">
											<a href="shipping-address.php" class="btn btn-primary ">SHIPPING ADDRESS</a>
										</div>
										<div class="cart-checkout-btn pull-right">
											<a href="shipping-address.php" class="btn btn-primary">PROCEED TO CHECKOUT</a>
										</div>
									</td>
								</tr>
							</tbody><!-- /tbody -->
							
						</table><!-- /table -->
					</div><!-- /.cart-shopping-total -->			
				</div><!-- /.shopping-cart --><?php 
			} ?>
		</div> <!-- /.row -->
<?php include("includes/footer.php");?>