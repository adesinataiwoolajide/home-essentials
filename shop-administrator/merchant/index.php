<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    require '../../libs_dev/products/products_class.php';
    require '../../libs_dev/merchant/merchant_class.php';
    $merchantDetails = new productMerchant($db);
    $productDetails = new ragzNationProducts($db);
    $merchant_email = $_SESSION['user_name'];
    $myDetails = $merchantDetails->gettingMerchantEmailDelatils($merchant_email);
    $merchant_number = $myDetails['merchant_number'];
    $merchant_name = $myDetails['merchant_name'];
    $users = $merchant_email;
    $admin = $register->gettingUserDetails($users);
?>
    <ul class="breadcrumb">
        <li><a href="./">Home</a></li>                    
        <li class="active"></li>
    </ul>
    <!-- END BREADCRUMB -->                       
    <?php
    if((isset($_SESSION['success'])) OR ((isset($_SESSION['error'])) === true)){ ?>
        <div class="alert alert-info" align="center">
            <button class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
         <?php include("../includes/feed-back.php"); ?>
        </div><?php 
    }  ?> 
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
        <div class="row">
            <div class="col-md-12 card" > 
                <div class="row">
                    <div class="col-md-3">                        
                        <a href="" class="tile tile-primary tile-valign">&#8358;<?php echo number_format($productDetails->sumMerchantProductsDet($merchant_number)) ?>
                            <div class="informer informer-default dir-tr"><span><?php echo $productDetails->countMerchantProductsDet($merchant_number); ?></span></div>
                            <div class="informer informer-default dir-bl">Total Assets on our website</div>
                        </a>                                                    
                    </div>
                    
                    
                    <div class="col-md-3">                        
                        <a href="" class="tile tile-success tile-valign">&#8358;<?php echo number_format($productDetails->sumMerchantProductsDet($merchant_number)) ?>
                            <div class="informer informer-default dir-tr"><span><?php echo $productDetails->countMerchantProductPublish($merchant_number) ?></span></div>
                            <div class="informer informer-default dir-bl">Total Assets on our website</div>
                        </a>                                                    
                    </div>

                    <div class="col-md-3">                        
                        <a href="" class="tile tile-danger tile-valign">&#8358;<?php echo number_format($productDetails->sumMerchantUnProductsPublish($merchant_number)) ?>
                            <div class="informer informer-default dir-tr"><span><?php echo $productDetails->countMerchantProductUnPublish($merchant_number)?></span></div>
                            <div class="informer informer-default dir-bl">Total Un Published Assets on our website</div>
                        </a>                                                    
                    </div>

                    <div class="col-md-3">                        
                        <a href="" class="tile tile-default tile-valign">&#8358;<?php echo number_format($productDetails->sumMerchantProductsDet($merchant_number)) ?>
                            <div class="informer informer-default dir-tr"><span style="color: black">1</span></div>
                            <div class="informer informer-default dir-bl">Total Assets on our website</div>
                        </a>                                                    
                    </div>
                    
                </div>

                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='my-products-list.php';">
                        <div align="center">
                            <img src="../../icons/images (3).jpg" style="width: 100px; height: 100px;" align="center">
                            <p align="center">My Products <?php echo $productDetails->countMerchantProductsDet($merchant_number); ?></p>
                        </div>      
                    </div>                            
                </div>


                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='my-published-products.php';">
                        <div align="center">
                            <img src="../../icons/publish.png" style="width: 100px; height: 100px;" align="center">
                            <p align="center" style="color: green"> 
                                Published Product <?php echo $productDetails->countMerchantProductPublish($merchant_number) ?>
                                    
                            </p>
                        </div>      
                    </div>                            
                </div>  
                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='my-unpublish-products.php';">
                        <div align="center">
                            <img src="../../icons/unpublish.png" style="width: 100px; height: 100px;" align="center">
                            <p align="center" style="color: red">
                                Un Published Products  <?php echo $productDetails->countMerchantProductUnPublish($merchant_number)?>
                                    
                            </p>
                        </div>      
                    </div>                            
                </div>  

                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='';">
                        <div align="center">
                            <img src="../../icons/sold.png" style="width: 100px; height: 100px;" align="center">
                            <p align="center">Sold Product</p>
                        </div>      
                    </div>                            
                </div>
                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='';">
                        <div align="center">
                            <img src="../../icons/complaint.png" style="width: 100px; height: 100px;" align="center">
                            <p align="center">Customer Complaints</p>
                        </div>      
                    </div>                            
                </div>  
                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='';">
                        <div align="center">
                            <img src="../../icons/salesf.jpg" style="width: 100px; height: 100px;" align="center">
                            <p align="center">My Orders</p>
                        </div>      
                    </div>                            
                </div>     
               
                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='';">
                        <div align="center">
                            <img src="../../icons/orders.jpg" style="width: 100px; height: 100px;" align="center">
                            <p align="center">Publish My Products</p>
                        </div>      
                    </div>                            
                </div>  

                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='';">
                        <div align="center">
                            <img src="../../icons/images (3).jpg" style="width: 100px; height: 100px;" align="center">
                            <p align="center">Un Publish My Products</p>
                        </div>      
                    </div>                            
                </div>
                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='my-activities.php';">
                        <div align="center">
                            <img src="../../icons/message.png" style="width: 100px; height: 100px;" align="center">
                            <p align="center">Messages</p>
                        </div>      
                    </div>                            
                </div>  
                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='my-activities.php';">
                        <div align="center">
                            <img src="../../icons/admin.png" style="width: 100px; height: 100px;" align="center">
                            <p align="center">Contact Admin</p>
                        </div>      
                    </div>                            
                </div>  
                 <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='my-activities.php';">
                        <div align="center">
                            <img src="../../icons/subs.png" style="width: 100px; height: 100px;" align="center">
                            <p align="center">Subscription</p>
                        </div>      
                    </div>                            
                </div>  
                 <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='my-activities.php';">
                        <div align="center">
                            <img src="../../icons/activity.png" style="width: 100px; height: 100px;" align="center">
                            <p align="center">My Activity Log</p>
                        </div>      
                    </div>                            
                </div>  


                
            </div>
        </div>
    </div>
    <!-- END PAGE CONTENT WRAPPER -->                                
</div>            
<!-- END PAGE CONTENT -->
</div>

<?php
    include("../log-out-modal.php");
	include("../footer.php");
?>