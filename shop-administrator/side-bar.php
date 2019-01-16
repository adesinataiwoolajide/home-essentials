<?php
    $access = $_SESSION['access'];;
?>
<!-- START PAGE CONTAINER -->
<div class="page-container">
    
    <!-- START PAGE SIDEBAR -->
    <div class="page-sidebar">
        <!-- START X-NAVIGATION -->
        <ul class="x-navigation">
            <li class="xn-logo">
                <a class="navbar-brand" href="./"><h5>HOME ESSENTIAL</h5></a>
                <a href="#" class="x-navigation-control"></a>
            </li>
            <li class="xn-profile">
                
                <div class="profile"><?php 
                    $merchant_email = $_SESSION['user_name'];
                    $pass = $db->prepare("SELECT * FROM merchant WHERE merchant_email=:merchant_email");
                    $passArr = array(':merchant_email'=>$merchant_email);
                    $pass->execute($passArr);
                    if($pass->rowCount() ==0){  ?>
                        <a href="./" class="profile-mini">
                            <img src="../../icons/cart.png" alt="<?php echo $_SESSION['name']; ?>" width="48" height="48"/>
                        </a>
                        <div class="profile">
                            <div class="profile-image">
                                <img src="../../icons/cart.png" alt="<?php echo $_SESSION['name']; ?>" width="100" height="100"/>
                            </div>
                            <div class="profile-data">
                                <div class="profile-data-name"><?php echo $_SESSION['name']; ?></div>
                                <div class="profile-data-title"><?php echo $_SESSION['user_name']; ?></div>
                            </div>
                            <div class="profile-controls">
                                <a href="./" class="profile-control-left"><span class="fa fa-info"></span></a>
                                <a href="./" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                            </div>
                        </div>     <?php
                    }else{ 
                         while($see_logo = $pass->fetch()){ ?>
                            <a href="./" class="profile-mini">
                                <img src="<?php echo '../../assets/images/merchant/'.$see_logo['merchant_logo']; ?>" alt="<?php echo $_SESSION['name']; ?>" width="48" height="48"/>
                            </a>
                            <div class="profile">
                                <div class="profile-image">
                                    <img src="<?php echo '../../assets/images/merchant/'.$see_logo['merchant_logo']; ?>" alt="<?php echo $_SESSION['name']; ?>" width="100" height="100"/>
                                </div>
                                <div class="profile-data">
                                    <div class="profile-data-name"><?php echo $_SESSION['name']; ?></div>
                                    <div class="profile-data-title"><?php echo $_SESSION['user_name']; ?></div>
                                </div>
                                <div class="profile-controls">
                                    <a href="./" class="profile-control-left"><span class="fa fa-info"></span></a>
                                    <a href="./" class="profile-control-right"><span class="fa fa-envelope"></span></a>
                                </div>
                            </div> <?php

                        }
                    } ?>
                   
                </div>                                                                        
            </li>
            <li class="xn-title">Navigation</li>
            <li class="">
                <a href="./"><span class="fa fa-desktop"></span> <span class="xn-text">Home Page</span></a>
            </li><?php
            if($access ==1){ ?>

                <li class="xn-openable">
                    <a href=""><span class="fa fa-users"></span> <span class="xn-text">Staff</span></a>
                    <ul>
                        <li><a href="add-staff-biodata.php"><span class="fa fa-align-center"></span> Add Staff</a></li>
                        <li><a href="view-all-staff.php"><span class="fa fa-align-justify"></span> View Staffs</a></li>
                    </ul>         
                </li> 
                <li class="xn-openable">
                    <a href=""><span class="fa fa-cogs"></span> <span class="xn-text">Products Category</span></a>
                    <ul>
                        <li><a href="add-products-category.php"><span class="fa fa-align-center"></span> Add Category</a></li>
                        <li><a href="view-all-products-categories.php"><span class="fa fa-align-justify"></span> View Categories</a></li>
                    </ul>         
                </li> 
                <li class="xn-openable">
                    <a href=""><span class="fa fa-cogs"></span> <span class="xn-text">Products Manufacturer</span></a>
                    <ul>
                        <li><a href="add-products-manufacturer.php"><span class="fa fa-align-center"></span> Add Manufacturer</a></li>
                        <li><a href="view-all-products-manufacturers.php"><span class="fa fa-align-justify"></span> View Manufacturers</a></li>
                    </ul>         
                </li> 
                <li class="xn-openable">
                    <a href=""><span class="fa fa-cogs"></span> <span class="xn-text">Products Types</span></a>
                    <ul>
                        <li><a href="add-products-type.php"><span class="fa fa-align-center"></span> Add Types</a></li>
                        <li><a href="view-all-products-types.php"><span class="fa fa-align-justify"></span> View All Types</a></li>
                    </ul>         
                </li> 
               
                <li class="xn-openable">
                    <a href=""><span class="fa fa-cogs"></span> <span class="xn-text">Manage Products</span></a>
                    <ul>
                        <li><a href="add-products.php"><span class="fa fa-align-center"></span> Add Products</a></li>
                        <li><a href="view-all-products.php"><span class="fa fa-align-justify"></span> View All Products</a></li>
                        <li><a href="publish-products-for-sale.php"><span class="fa fa-cloud"></span> Publish Products</a></li>
                        <li><a href="unpublish-products.php"><span class="fa fa-align-justify"></span> Unpubish Products</a></li>
                        <li><a href="published-products.php"><span class="fa fa-cloud"></span> Pubished Products</a></li>
                    </ul>         
                </li> 
               
                 <li class="xn-openable">
                    <a href=""><span class="fa fa-shopping-cart"></span> <span class="xn-text">My Orders </span></a>
                    <ul>
                       <li> <a href="customer-orders.php"><span class="fa fa-exchange"></span> New Orders</a></li>
                       <li> <a href=""><span class="fa fa-tasks"></span> Pending Orders</a></li>
                        <li><a href=""><span class="fa fa-check-square-o"></span> Delivered Orders</a></li>
                    </ul>         
                </li>
                <li class="xn-openable">
                    <a href=""><span class="fa fa-users"></span> <span class="xn-text">Track Order</span></a>
                    <ul>
                        <li><a href=""><span class="fa fa-align-center"></span> Add Bio Data</a></li>
                        <li><a href=""><span class="fa fa-align-justify"></span> View Details</a></li>
                        
                    </ul>
                </li>
                <li class="xn-openable">
                    <a href=""><span class="fa fa-users"></span> <span class="xn-text">Track Delivery</span></a>
                    <ul>
                        <li><a href=""><span class="fa fa-align-center"></span> Add Bio Data</a></li>
                        <li><a href=""><span class="fa fa-align-justify"></span> View Details</a></li>
                        
                    </ul>
                </li>

                <li class="">
                    <a href="site-history.php"><span class="fa fa-cloud"></span> 
                        <span class="xn-text">Site Activities</span>
                    </a> 
                    <?php 
                    $his = $db->prepare("SELECT count(act_id) as total_act FROM activity");
                    $his->execute();
                    while($rope = $his->fetch()){ 
                        $piss = $rope['total_act']; ?>
                        <div class="informer informer-danger"><?php echo $piss; ?></div> <?php 
                    } ?>                      
                </li> <?php
            }elseif($access ==2){ ?>
                
                <li class="xn-openable">
                    <a href=""><span class="fa fa-cogs"></span> <span class="xn-text">My Products</span></a>
                    <ul>
                        <li><a href="add-products.php"><span class="fa fa-plus"></span> Add Products</a></li>
                        <li><a href="my-products-list.php"><span class="fa fa-align-justify"></span> View All My Products</a></li>
                    </ul>         
                </li>
                <li class="xn-openable">
                    <a href=""><span class="fa fa-cloud"></span> <span class="xn-text">Published Products</span></a>
                    <ul>
                        <li><a href="publish-my-product.php"><span class="fa fa-cloud"></span> Publish My Products</a></li>
                        <li><a href="my-published-products.php"><span class="fa fa-align-justify"></span> My Published Products</a></li>
                    </ul>         
                </li>
                <li class="xn-openable">
                    <a href=""><span class="fa fa-ban"></span> <span class="xn-text">Un Published Products</span></a>
                    <ul>
                        <li><a href="unpublish-my-products.php"><span class="fa fa-cloud"></span> Un Publish My Products</a></li>
                       <li> <a href="my-unpublish-products.php"><span class="fa fa-align-justify"></span>UnPublished Products</a></li>
                    </ul>         
                </li>
                <li class="xn-openable">
                    <a href=""><span class="fa fa-shopping-cart"></span> <span class="xn-text">My Orders </span></a>
                    <ul>
                       <li> <a href=""><span class="fa fa-exchange"></span> New Orders</a></li>
                       <li> <a href=""><span class="fa fa-tasks"></span> Pending Orders</a></li>
                        <li><a href=""><span class="fa fa-check-square-o"></span> Delivered Orders</a></li>
                    </ul>         
                </li>
                 <li class="xn-openable">
                    <a href=""><span class="fa fa-envelope"></span> <span class="xn-text">My Messages </span></a>
                    <ul>
                       <li> <a href=""><span class="fa fa-plus-circle"></span> Send Message</a></li>
                       <li> <a href=""><span class="fa fa-exclamation-circle"></span> Inbox</a></li>
                        <li><a href=""><span class="fa fa-pencil-square"></span> Sent</a></li>
                    </ul>         
                </li>
               <?php
            }elseif($access ==2){ ?>
                
                <li class="xn-openable">
                    <a href=""><span class="fa fa-cogs"></span> <span class="xn-text">My Products</span></a>
                    <ul>
                        <li><a href="add-products.php"><span class="fa fa-plus"></span> Add Products</a></li>
                        <li><a href="my-products-list.php"><span class="fa fa-align-justify"></span> View All My Products</a></li>
                    </ul>         
                </li>
                <li class="xn-openable">
                    <a href=""><span class="fa fa-cloud"></span> <span class="xn-text">Published Products</span></a>
                    <ul>
                        <li><a href="publish-my-product.php"><span class="fa fa-cloud"></span> Publish My Products</a></li>
                        <li><a href="my-published-products.php"><span class="fa fa-align-justify"></span> My Published Products</a></li>
                    </ul>         
                </li>
                <li class="xn-openable">
                    <a href=""><span class="fa fa-ban"></span> <span class="xn-text">Un Published Products</span></a>
                    <ul>
                        <li><a href="unpublish-my-products.php"><span class="fa fa-cloud"></span> Un Publish My Products</a></li>
                       <li> <a href="my-unpublish-products.php"><span class="fa fa-align-justify"></span>UnPublished Products</a></li>
                    </ul>         
                </li>
                <li class="xn-openable">
                    <a href=""><span class="fa fa-shopping-cart"></span> <span class="xn-text">My Orders </span></a>
                    <ul>
                       <li> <a href=""><span class="fa fa-exchange"></span> New Orders</a></li>
                       <li> <a href=""><span class="fa fa-tasks"></span> Pending Orders</a></li>
                        <li><a href=""><span class="fa fa-check-square-o"></span> Delivered Orders</a></li>
                    </ul>         
                </li>
                 <li class="xn-openable">
                    <a href=""><span class="fa fa-envelope"></span> <span class="xn-text">My Messages </span></a>
                    <ul>
                       <li> <a href=""><span class="fa fa-plus-circle"></span> Send Message</a></li>
                       <li> <a href=""><span class="fa fa-exclamation-circle"></span> Inbox</a></li>
                        <li><a href=""><span class="fa fa-pencil-square"></span> Sent</a></li>
                    </ul>         
                </li>
               <?php
            }  ?>
            <li class="">
                <a href="my-activities.php"><span class="fa fa-cloud"></span> <span class="xn-text">My Activities</span></a>
            </li>
            <li class="">
                <a href="../log-out.php"><span class="fa fa-lock"></span> <span class="xn-text">Log Out</span></a>                        
            </li>
        </ul>
        <!-- END X-NAVIGATION -->
    </div>
    <div class="page-content">
               
        <!-- START X-NAVIGATION VERTICAL -->
        <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
            <!-- TOGGLE NAVIGATION -->
            <li class="xn-icon-button">
                <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
            </li>
            <!-- END TOGGLE NAVIGATION -->
            <!-- SEARCH -->
            <li class="xn-search">
                <form role="form">
                    <input type="text" name="search" placeholder="Search..."/>
                </form>
            </li>   
            <!-- END SEARCH -->
            <!-- SIGN OUT -->
            <li class="xn-icon-button pull-right">
                <a href="../log-out.php" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>                        
            </li> 
            <!-- END SIGN OUT -->
            <!-- MESSAGES -->
            
        </ul>