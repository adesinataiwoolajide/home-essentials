
<?php 
$pagetitle = "Rgeistration Form";
include("includes/header.php");?>
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="./">Home</a></li>
				<li class='active'>Create Account</li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- create a new account -->
				<div class="account-wrapper">
					<div class="col-md-12 col-sm-12 create-new-account">
						<h4 class="checkout-subtitle">Create a new account</h4>
						<div class="form-group">
	            	<a style="float:right;" href="login.php">Log In Here</a>
	            </div>

				<form method="post" action="handlers/registration/process-registration.php" name="register">
					<div class="form-group">
				    	<label class="info-title" for="exampleInputEmail2">Email Address <span>*</span></label>
				    	<input type="email" name="user_name" class="form-control unicase-form-control text-input" id="exampleInputEmail2" required placeholder="email@example.com">
				  	</div>
			        <div class="form-group">
					    <label class="info-title" for="exampleInputEmail1"> Full Name <span>*</span></label>
					    <input type="text" name="full_name" class="form-control unicase-form-control text-input" id="exampleInputEmail1" required placeholder="LastName OtherNames">
					</div>
			        <div class="form-group">
					    <label class="info-title" for="exampleInputEmail1" >Password <span>*</span></label>
					    <input type="password" name="password" class="form-control unicase-form-control text-input" id="password1" required >
					</div>
			         
					<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
					    <input type="password" name="repeat" id="confirm" class="form-control unicase-form-control text-input" id="password2" required="">
					</div>
					<div class="radio outer-xs">
					  	<a href="forgot-password.php" class="forgot-password pull-right">Forgot your Password?</a><br>
					</div>
				  	<input type="submit" id="submit" name="register" value="CREATE ACCOUNT" class="btn-upper btn btn-primary checkout-page-button">
				</form>
			</div>	
		</div>		<!-- create a new account -->			
	</div><!-- /.row -->
</div><!-- /.sigin-in-->
<?php include ("includes/footer.php"); ?>