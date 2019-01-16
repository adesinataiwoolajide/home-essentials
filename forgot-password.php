<?php

$pagetitle = "Forgot Password";
include ("includes/header.php");?>
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="./">Home</a></li>
				<li><a href="login.php">Login</a></li>
				<li class='active'>Forgot Password</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<div class="account-wrapper">
				<!-- Sign-in -->			
					<div class="col-md-12 col-sm-12 sign-in">
						<h4 class="">Forgot Password</h4>
						<p class="">Enter your email address to reset your password</p>
						<form action="handlers/registration/retrieve-password.php" method="POST">
						  	<div class="form-group">
							    <label class="info-title" for="exampleInputPassword1">Email Address</label>
							    <input type="email" name="user_name" class="form-control unicase-form-control text-input" id="exampleInputPassword1" required >
							</div>
						  	<button type="submit" name="retrieve-password" class="btn-upper btn btn-primary checkout-page-button">Reset Password</button>
						</form>					
					</div>
				<!-- Sign-in -->			
				</div>
			</div><!-- /.row -->
		</div><!-- /.sigin-in-->
<?php include("includes/footer.php"); ?>