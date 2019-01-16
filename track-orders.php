<?php 
$pagetitle = "Track Orders";
include("includes/header.php");
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
				<li><a href="./">Home</a></li>
				<li class='active'>Track your orders</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="track-order-page">
			<div class="row">
				<div class="col-md-12">
					<h2 class="heading-title">Track your Order</h2>
					<span class="title-tag inner-top-ss">Please enter your Order ID in the box below and press Enter. This was given to you on your receipt and in the confirmation email you should have received. </span>
					<form action="handlers/orders/track-order.php" method="post" name="register">
						<div class="form-group col-md-6" >
						    <label class="info-title" for="exampleBillingEmail1">Customer ID</label>
						    <input type="email" class="form-control unicase-form-control text-input" value="<?php echo $_SESSION['reg_number']; ?>" id="exampleBillingEmail1" readonly>
						</div>
						<input type="hidden" name="customer_id" value="<?php echo $_SESSION['reg_number']; ?>">
						<div class="form-group col-md-6" >
						    <label class="info-title" for="exampleOrderId1">Transaction ID</label>
						    <input type="text" class="form-control unicase-form-control text-input" id="exampleOrderId1" name="order_id" placeholder="Enter The Transaction Number">
						</div>
					  	<div class="form-group col-md-12"  align="center">
					  		<button type="submit" class="btn-upper btn btn-success checkout-page-button" name="track-order">Track The Order</button>
					  	</div>
					</form>	
				</div>			
			</div><!-- /.row -->
		</div><!-- /.sigin-in-->
<?php include("includes/footer.php"); ?>