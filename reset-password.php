<?php
include("includes/session.php");
require_once("connection/db_connection.php");
$pagetitle = "Reset";
include ("includes/header.php");?>
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="./">Home</a></li>
				<li><a href="sign-in.php">Login</a></li>
				<li><a href="forgot.php">Forgot</a></li>
				<li class='active'>Reset</li>
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
						<form method="post" class="register-form outer-top-xs" role="form" action="utils/account/reset-forgot-password.php">
						  	<div class="form-group">
							    <label class="info-title" for="exampleInputPassword1">New Password</label>
							    <input type="hidden" name="code" value="<?php echo $_SESSION['registration_code'];?>">
							    <input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1" required >
							</div>

						  	<div class="form-group">
							    <label class="info-title" for="exampleInputPassword1">Confirm Password</label>
							    <input type="password" name="confirm" class="form-control unicase-form-control text-input" id="exampleInputPassword1" required >
							</div>
						  	<button type="submit" name="Login" class="btn-upper btn btn-primary checkout-page-button">Reset Password</button>
						</form>					
					</div>
				<!-- Sign-in -->			
				</div>
</div><!-- /.row -->
</div><!-- /.sigin-in-->
<?php include("includes/footer.php"); ?>