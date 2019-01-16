<?php
$pagetitle = "Login In";
include ("includes/header.php");?>
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="./">Home</a></li>
				<li class='active'>Login</li>
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
						<h4 class="">Sign in</h4>
						<p class="">Hello, Welcome to your account.</p>
						<form method="post" action="handlers/registration/process-login.php" name="register">
							<div class="form-group">
							    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
							    
							    <input type="email" name="user_name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required>
							</div>
						  	<div class="form-group">
							    <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
							    <input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" required >
							</div>
							<div class="radio outer-xs">
							  	<a href="forgot-password.php" class="forgot-password pull-right">Forgot your Password?</a><br>
							  	<a href="register.php" class="forgot-password pull-right">Sign Up?</a>
							</div>
						  	<button type="submit" name="login" class="btn-upper btn btn-primary checkout-page-button">Login</button>
						</form>					
					</div>
				<!-- Sign-in -->			
				</div>
</div><!-- /.row -->
</div><!-- /.sigin-in-->
<?php include("includes/footer.php"); ?>