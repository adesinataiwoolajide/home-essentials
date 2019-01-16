<?php
require_once("includes/session.php");
include('includes/authenticate.php');
include("connection/db_connection.php");
include("dev/account/functions.php");
$getDetails = getBuyerDetails($buyer_id);
$pagetitle = "Home";
include("includes/header.php");
?>
<div class="body-content outer-top-xs" id="top-banner-and-menu">  
  <div class="container">
    <div class="row"> 
      <!-- ============================================== SIDEBAR ============================================== -->
      <div class="col-xs-12 col-sm-12 col-md-3 sidebar"> 
        <!-- ================================== TOP NAVIGATION ================================== -->
        <div class="side-menu animate-dropdown outer-bottom-xs">
          <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Welcome </div>
          <nav class="yamm megamenu-horizontal">
            <ul class="nav">
              <li><a href="#"><i class="icon fa fa-shopping-bag" aria-hidden="true"></i>Home</a></li>
              <li><a href="#"><i class="icon fa fa-shopping-bag" aria-hidden="true"></i>Wishlist</a></li>
              <li><a href="#"><i class="icon fa fa-shopping-bag" aria-hidden="true"></i>Messages</a></li>
              <li><a href="#"><i class="icon fa fa-shopping-bag" aria-hidden="true"></i>Notifications</a></li>
              <li><a href="#"><i class="icon fa fa-shopping-bag" aria-hidden="true"></i>Settings</a></li>
              <li><a href="logout.php"><i class="icon fa fa-shopping-bag" aria-hidden="true"></i>Logout</a></li>              
            </ul>
          </nav>
        </div>

      </div>
      <div class="col-md-9 detail-block"> 
        
   
            <form method="post" class="register-form outer-top-xs" role="form" action="utils/account/reset-password.php">
            <?php foreach($getDetails as $rowInfo){?>
              <div class="form-group">
                  <label class="info-title" for="exampleInputEmail1">New Password<span>*</span></label>
                  <input type="password" name="password" class="form-control unicase-form-control text-input" required>
              </div>

              <div class="form-group">
                  <label class="info-title" for="exampleInputEmail1">New Password<span>*</span></label>
                  <input type="password" name="confirm" class="form-control unicase-form-control text-input" required>
              </div>              
              <button type="submit" name="Login" class="btn-upper btn btn-primary checkout-page-button">UPDATE PASSWORD</button>
              <?php } ?>
            </form>    
      </div>
    </div>
    <!-- /.row --> 
<?php include "includes/footer.php"; ?>