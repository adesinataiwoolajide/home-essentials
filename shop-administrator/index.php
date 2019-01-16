<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>        
        <!-- META SECTION -->
        <title>ONLINE SHOPPING MALL ADMIN PANEL</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="icon" href="favicon.ico" type="image/x-icon" />   
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                     
    </head>
    <body>
        
        <div class="login-container lightmode">
        
            <div class="login-box animated fadeInDown">
                <div class="col-md-12" align="center">
                    <a class="navbar-brand" href="./">
                        <img src="../icons/1530774243228.jpg" style="width: 100px; height: 100px; margin-top: -70px; margin-left: 100px" class="logo-change" alt="RAGZ NATION"/>
                    </a>
                </div>
                <h1 align="center" style="color: white">
                <div class="login-body">
                    <?php
                    if((isset($_SESSION['success'])) OR ((isset($_SESSION['error'])) === true)){ ?>
                        <div class="alert alert-info" align="center">
                            <button class="close" data-dismiss="alert">
                                <i class="ace-icon fa fa-times"></i>
                            </button>
                         <?php include("includes/feed-back.php"); ?>
                        </div><?php 
                    }  ?>
                    
                    <div class="login-title"><strong>Log In</strong> with your Details</div>
                    <form action="process-login.php" class="form-horizontal" method="post">
                    <div class="form-group">
                        <div class="col-md-12">
                            <h6><i class="fa-envelope"></i> E-Mail: </h6><input type="email" class="form-control" name="email" placeholder="Please Enter Your E-mail" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <h6><i class="fa-lock"></i>Password: </h6><input type="password" class="form-control" name="password" placeholder="Enter Your Password" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <!-- <div class="col-md-6">
                            <a href="" class="btn btn-link btn-block">Forgot your password?</a>
                        </div> -->
                        <div class="col-md-6">
                            <button class="btn btn-info btn-block" name="login">Log In</button>
                        </div>
                    </div>
                    
                    </form>
                </div><br>
                <div class="login-footer">
                    <p style="color: white"><h5>&copy; <?php echo date("Y"); ?> Powered by Glorious Empire for Ragz.</h5></p>
                </div>
            </div>
            
        </div>
        
    </body>
</html>






