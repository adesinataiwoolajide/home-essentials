<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
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
        
        <!-- START WIDGETS -->                    
        <div class="row">
            <div class="col-md-3"> 
                <div class="widget widget-default widget-carousel">
                    <div class="owl-carousel" id="owl-example"><?php
                        $stu1 = $db->prepare("SELECT count(staff_id) as total_act FROM staff ");
                        $stu1->execute();
                       ?>
                        <div>                                    
                            <div class="widget-title">Total Staff</div><?php                                                                        
                            while($roe1 = $stu1->fetch()){ 
                                $hiss1 = $roe1['total_act']; ?>
                                <div class="widget-int num-count"><?php echo $hiss1; ?></div><?php
                            } ?>
                        </div>
                        <div>                                    
                            <div class="widget-title">Male</div>
                            <div class="widget-subtitle">Staffs</div><?php
                            $stu = $db->prepare("SELECT count(staff_id) as total_act FROM staff WHERE sex='Male' ");
                            $stu->execute();
                            while($roe = $stu->fetch()){ 
                                $hiss = $roe['total_act']; ?>
                                <div class="widget-int"><?php echo $hiss; ?></div><?php
                            } ?>
                            
                        </div>
                        <div>                                    
                            <div class="widget-title">Female</div>
                            <div class="widget-subtitle">Staff</div><?php
                            $stu = $db->prepare("SELECT count(staff_id) as total_act FROM staff WHERE sex='Female' ");
                            $stu->execute();
                            while($roe = $stu->fetch()){ 
                                $hiss = $roe['total_act']; ?>
                                <div class="widget-int"><?php echo $hiss; ?></div><?php
                            } ?>
                        </div>
                    </div>                            
                                            
                </div> 
            </div>   
            <div class="col-md-3">
                <div class="widget widget-default widget-item-icon" onclick="location.href='published-products.php';">
                    <div class="widget-item-left">
                        <span class="fa fa-cloud"></span>
                    </div>
                    <div class="widget-data"><?php
                        $use = $db->prepare("SELECT count(product_id) as total_act FROM products WHERE publish=1");
                        $use->execute();
                        while($roe = $use->fetch()){ 
                            $kiss = $roe['total_act']; ?>
                            <div class="widget-int num-count"><?php echo $kiss; ?></div><?php
                        } ?>
                        <div class="widget-title">Total Published Products</div>
                        <div class="widget-subtitle">On your website</div>
                    </div>                         
                </div>                            
            </div> 
            <div class="col-md-3">
                <div class="widget widget-default widget-item-icon" onclick="location.href='publish-products-for-sale.php';">
                    <div class="widget-item-left">
                        <span class="fa fa-trash-o"></span>
                    </div>
                    <div class="widget-data"><?php
                        $use = $db->prepare("SELECT count(product_id) as total_act FROM products WHERE publish=0");
                        $use->execute();
                        while($roe = $use->fetch()){ 
                            $kiss = $roe['total_act']; ?>
                            <div class="widget-int num-count"><?php echo $kiss; ?></div><?php
                        } ?>
                        <div class="widget-title">Total Un-Published Products</div>
                        <div class="widget-subtitle">On your website</div>
                    </div>                         
                </div>                            
            </div> 
            <div class="col-md-3">
                <div class="widget widget-default widget-item-icon" onclick="location.href='view-school-staff';">
                    <div class="widget-item-left">
                        <span class="fa fa-group"></span>
                    </div>
                    <div class="widget-data"><?php
                        $use = $db->prepare("SELECT count(user_id) as total_act FROM admin_login");
                        $use->execute();
                        while($roe = $use->fetch()){ 
                            $kiss = $roe['total_act']; ?>
                            <div class="widget-int num-count"><?php echo $kiss; ?></div><?php
                        } ?>
                        <div class="widget-title">Registred users</div>
                        <div class="widget-subtitle">On your website</div>
                    </div>                         
                </div>                            
            </div>
            
        </div>
        <div class="row">
            
            <div class="row">
                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='view-all-products-categories.php';">
                        <div align="center">
                            <img src="../../icons/images (1).jpg" style="width: 100px; height: 100px;" align="center">
                            <p align="center">Products Categories</p>
                        </div>      
                    </div>                            
                </div>
                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='view-all-products-types.php';">
                        <div align="center">
                            <img src="../../icons/images (1).jpg" style="width: 100px; height: 100px;" align="center">
                            <p align="center">Product Types</p>
                        </div>      
                    </div>                            
                </div>

                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='view-all-products-manufacturers.php';">
                        <div align="center">
                            <img src="../../icons/brand.png" style="width: 100px; height: 100px;" align="center">
                            <p align="center">Product Manufacturer</p>
                        </div>      
                    </div>                            
                </div>

                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='view-all-products.php';">
                        <div align="center">
                            <img src="../../icons/images (3).jpg" style="width: 100px; height: 100px;" align="center">
                            <p align="center">Products</p>
                        </div>      
                    </div>                            
                </div>

                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='publish-products-for-sale.php';">
                        <div align="center">
                            <img src="../../icons/publish.png" style="width: 100px; height: 100px;" align="center">
                            <p align="center"> Publish Product</p>
                        </div>      
                    </div>                            
                </div>

                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='published-products.php';">
                        <div align="center">
                            <img src="../../icons/prod.png" style="width: 100px; height: 100px;" align="center">
                            <p align="center"> Published Product</p>
                        </div>      
                    </div>                            
                </div>

                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='unpublish-products.php';">
                        <div align="center">
                            <img src="../../icons/unpublish.png" style="width: 100px; height: 100px;" align="center">
                            <p align="center">Un Publish Product</p>
                        </div>      
                    </div>                            
                </div>

                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='';">
                        <div align="center">
                            <img src="../../icons/stock.png" style="width: 100px; height: 100px;" align="center">
                            <p align="center">Publication History</p>
                        </div>      
                    </div>                            
                </div>
                
                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='view-all-staff.php';">
                        <div align="center">
                            <img src="../../icons/prod.png" style="width: 100px; height: 100px;" align="center">                    
                            <p >Staff</p>
                        </div>         
                    </div>                            
                </div>
                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='customer-orders.php';">
                        <div align="center">
                            <img src="../../icons/cart.png" style="width: 100px; height: 100px;" align="center">                    
                            <p align="center">Customer Order</p>
                        </div>      
                    </div>                            
                </div>
                
                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='';">
                        <div align="center">
                            <img src="../../icons/images (2).jpg" style="width: 100px; height: 100px;" align="center">                    
                            <p >Track Products</p>
                        </div>         
                    </div>                            
                </div>

                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href=' view-all-allocated-subject.php';">
                        <div align="center">
                            <img src="../../icons/course=reg (3).jpg" style="width: 100px; height: 100px;" align="center">                    
                            <p >Delevered Products</p>
                        </div>         
                    </div>                            
                </div>
                
                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='';">
                        <div align="center">
                            <img src="../../icons/course=reg (1).png" style="width: 100px; height: 100px;" align="center">                    
                            <p >Pending Order</p>
                        </div>         
                    </div>                            
                </div>
                
                
                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='admission-payments-lists.php';">
                        <div align="center">
                            <img src="../../icons/download (1).jpg" style="width: 100px; height: 100px;" align="center">
                                <p align="">Products Payments</p>
                        </div>         
                    </div>                            
                </div>
               

                

                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='staff-act-log.php';">
                        <div align="center">
                            <img src="../../icons/unnamed (1).png" style="width: 100px; height: 100px;" align="center">                    
                            <p >Staff Activities Log</p>
                        </div>         
                    </div>  
                </div> 
                <div class="col-md-3">
                    <div class="widget widget-default widget-item-icon" onclick="location.href='my-activities.php';">
                        <div align="center">
                            <img src="../../icons/images.jpeg" style="width: 100px; height: 100px;" align="center">                    
                            <p align="center">My Activities</p>
                        </div>      
                    </div>                            
                </div> 

            </div>
        <!-- END DASHBOARD CHART -->
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