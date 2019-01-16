<?php 
$pagetitle = "Track Orders";
include("includes/header.php");
	if(!isset($_SESSION['id'])){ ?>
        <script>
            window.location=('login.php');
        </script><?php 
        $_SESSION['error'] = "Please Register Or Login into Your Account"; 
    }
    $customer_id = $_GET['customer_id'];
    $order_id = $_GET['transaction_number'];
    $orders = $productDetails-> gettingProductsOrders($order_id);
    $orderDetails = $productDetails->gettingProductsOrderDetails($order_id);
?>
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="./">Home</a></li>
				<li class='active'> <a href="order-details.php?transaction_number=<?php echo $transaction_number ?>&&customer_id=<?php echo $customer_id ?>"></a> Order Details</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="track-order-page">
			<div class="row">
				<div class="col-md-12">
					<h2 class="heading-title">View Your Order Details Below</h2>
					<span class="title-tag inner-top-ss">Please enter your Order ID in the box below and press Enter. This was given to you on your receipt and in the confirmation email you should have received. </span>
					

					 <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                        <div class="more-info-tab clearfix ">
                            <div class="table-responsive">	
		                		<table class="table table-bordered">
	                            	
	                            	<thead>
	                            		<tr>
	                            			<td>S/N</td>
	                            			<td>Product Image</td>
	                            			<td>Product Name</td>
	                            			<td>Product Price</td>
	                            			<td>Quantity</td>
	                            		</tr>
	                            	</thead>
	                            	<tbody><strong><?php 
	                            		$y=1;
	                            		foreach($orderDetails as $level){ 
	                            			$product_number = $level['product_id'];
	                            			$ragzProduct = $productDetails->getProductsDet($product_number);
	                        				$ragzProductDetails = $productDetails->getProductsDetails($product_number); ?>
		                            		<tr>
		                            			<td><?php echo $y ?></td>
		                            			<td><img src="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" style="width: 50px; height: 50px"></td>
		                            			<td><?php echo $ragzProduct['product_name'] ?></td>
		                            			<td>&#8358;<?php echo number_format($level['amount']) ?></td>
		                            			<td><?php echo ($level['quantity']) ?></td>
		                            			
		                            		</tr><?php  
		                            		$y++;
		                            	} ?></strong>
	                            	</tbody>

	                            	<thead>
	                            		<tr>
	                            			<td>Sub Total</td>
	                            			<td>Shipping Fee</td>
	                            			<td>Total</td>
	                            			<td>Payment Status</td>
	                            			<td>Order Status</td>
	                            		</tr>
	                            	</thead>
	                            	<tbody>
	                            		<tr>
	                            			<td>&#8358;<?php echo number_format($orders['subtotal']) ?></td>
	                            			<td>&#8358;<?php echo number_format($orders['shipping_charge']) ?></td>
	                            			<td>&#8358;<?php echo number_format($orders['amount']) ?></td>
	                            			<td><?php 
	                            				$paid = $orders['order_status'];
	                            				if($paid ==1 ){ ?>
	                            					<p style="color: green">Paid</p><?php
	                            				}else{ ?>
	                            					<p style="color: red">Pending</p><?php
	                            				} ?>
	                            					
	                            			</td>
	                            			<td><?php 
	                            				$status = $orders['paid_status'];
	                            				if($status ==1 ){ ?>
	                            					<p style="color: green">Paid</p><?php
	                            				}else{ ?>
	                            					<p style="color: red">Pending</p><?php
	                            				} ?>	
	                            			</td>
	                            		</tr>
	                            	</tbody>
	                            </table>
	                        </div>
                        </div>
                    </div>  
				</div>			
			</div><!-- /.row -->
		</div><!-- /.sigin-in-->
		<?php 
			include("includes/footer.php"); 
		?>