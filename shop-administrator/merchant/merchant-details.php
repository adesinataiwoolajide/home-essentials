<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
	require '../../libs_dev/products/products_class.php';
	require '../../libs_dev/merchant/merchant_class.php';
    $merchantDetails = new productMerchant($db);
	$productDetails = new ragzNationProducts($db);
	$merchant_number = $_GET['merchant_number'];
	$details = $merchantDetails->gettingMerchantDelatils($merchant_number);
	$merchant_name = $details['merchant_name'];
	$merchant_email = $details['merchant_email'];
	$users = $merchant_email;
	$admin = $register->gettingUserDetails($users);
?>
<ul class="breadcrumb">
    <li><a href="./">Home</a></li>  
    <li><a href="merchant-details.php?merchant_number=<?php echo $merchant_number?>"><?php echo $merchant_name ?> Details</p></a></li>   
    <li><a href="merchant-products-list.php?merchant_number=<?php echo $merchant_number ?>"><i class="fa fa-list"></i> View All Product</p></a></li>  
    <li><a href="merchant-products.php?merchant_number=<?php echo $merchant_number?>">Merchant Products</p></a></li>
    <li><a href="merchant-unpublish-products.php?merchant_number=<?php echo $merchant_number?>"><i class="fa fa-list"></i> Un-Publish Product</p></a></li>     
    <li><a href="merchant-published-products.php?merchant_number=<?php echo $merchant_number?>"><i class="fa fa-cloud"></i> Published Product</p></a></li> 
    <li class="active">Merchant Dashboad</li>   
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
        <div class="col-md-3">
            
            <div class="panel panel-default">

                <div class="panel-body profile" style="background: url('<?php echo '../../assets/images/merchant/'.$details['merchant_logo']; ?>') center center no-repeat;">
                    <div class="profile-image">
                        <img src="<?php echo '../../assets/images/merchant/'.$details['merchant_logo']; ?>" alt="<?php echo $details['merchant_name']; ?>" style="width: 100px; height: 100px;"/>
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name" style="color: black">
                        	<?php echo $details['merchant_name']; ?>
                        </div>
                        <div class="profile-data-title" style="color: black;">
                        	<?php echo $merchant_number; ?>	
                        </div>
                    </div>                                 
                </div>                                
                
            </div>                            
            
        </div>
        
        <div class="row">
        	<div class="col-md-9"> 
	            <div class="panel panel-default">
	                <table id="customers2" class="table datatable">
	                                                        
	                    <div class="panel-body">
	                    	<table class="table table-responsive">
	                    		<thead align="center">
	                                <tr>
	                                   
	                                    <th>Full Name</th> 
	                                    <th>Merchant Name</th>
	                                    <th>Merchant Number</th>
	                                    <th>Merchant E-Mail</th>
	                                    
	                                </tr>
	                            </thead>
	                    		<tbody>
	                    			<tr>
	                    				<td><?php echo  $admin['full_name']; ?></td>
	                    				<td><?php echo $merchant_name; ?></td>
	                    				<td><?php echo $merchant_number; ?></td>
	                    				<td><?php echo $merchant_email; ?></td>
	                    			</tr>
	                    		</tbody>
	                    		
	                    	</table>                       
	                        <div class="panel-footer col-md-12">                                 
			                    <a href="edit-products-details.php?merchant_number=<?php echo $merchant_number; ?>" class="btn btn-success pull-right">EDIT PRODUCT DETAILS</a>
			                </div>
	                    </div>
	                </table>                                    
	            </div>
	        </div>
        </div>
        <div class="row">
        	<div class="col-md-12 card" > 
        		<div class="row">
                    <div class="col-md-3">                        
                        <a href="" class="tile tile-primary tile-valign">&#8358;<?php echo number_format($productDetails->sumMerchantProductsDet($merchant_number)) ?>
                            <div class="informer informer-default dir-tr"><span class="fa fa-cloud"></span></div>
                            <div class="informer informer-default dir-bl">Total Assets on owr website</div>
                        </a>                                                    
                    </div>
                    
                    
                    <div class="col-md-3">                        
                        <a href="" class="tile tile-success tile-valign">&#8358;<?php echo number_format($productDetails->sumMerchantProductsDet($merchant_number)) ?>
                            <div class="informer informer-default dir-tr"><span class="fa fa-cloud"></span></div>
                            <div class="informer informer-default dir-bl">Total Assets on owr website</div>
                        </a>                                                    
                    </div>

                    <div class="col-md-3">                        
                        <a href="" class="tile tile-danger tile-valign">&#8358;<?php echo number_format($productDetails->sumMerchantUnProductsPublish($merchant_number)) ?>
                            <div class="informer informer-default dir-tr"><span class="fa fa-cloud"></span></div>
                            <div class="informer informer-default dir-bl">Total Un Published Assets on owr website</div>
                        </a>                                                    
                    </div>

                    <div class="col-md-3">                        
                        <a href="" class="tile tile-default tile-valign">&#8358;<?php echo number_format($productDetails->sumMerchantProductsDet($merchant_number)) ?>
                            <div class="informer informer-default dir-tr"><span class="fa fa-cloud"></span></div>
                            <div class="informer informer-default dir-bl">Total Assets on owr website</div>
                        </a>                                                    
                    </div>
                    
                </div>
	            <div class="panel panel-default">
	                <div class="col-md-3">
	                    <div class="widget widget-default widget-item-icon" onclick="location.href='merchant-products-list.php?merchant_number=<?php echo $merchant_number ?>';">
	                        <div align="center">
	                            <img src="../../icons/images (3).jpg" style="width: 100px; height: 100px;" align="center">
	                            <p align="center">All Products <?php echo $productDetails->countMerchantProductsDet($merchant_number); ?></p>
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
	                    <div class="widget widget-default widget-item-icon" onclick="location.href='merchant-published-products.php?merchant_number=<?php echo $merchant_number?>';">
	                        <div align="center">
	                            <img src="../../icons/publish.png" style="width: 100px; height: 100px;" align="center">
	                            <p align="center" style="color: green"> 
	                            	Published Product <?php echo $productDetails->countMerchantProductPublish($merchant_number) ?>
	                            		
	                            </p>
	                        </div>      
	                    </div>                            
	                </div>  
	                <div class="col-md-3">
	                    <div class="widget widget-default widget-item-icon" onclick="location.href='merchant-unpublish-products.php?merchant_number=<?php echo $merchant_number?>';">
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
	                            <img src="../../icons/complaint.png" style="width: 100px; height: 100px;" align="center">
	                            <p align="center">Customer Complaints</p>
	                        </div>      
	                    </div>                            
	                </div>  
	                <div class="col-md-3">
	                    <div class="widget widget-default widget-item-icon" onclick="location.href='';">
	                        <div align="center">
	                            <img src="../../icons/salesf.jpg" style="width: 100px; height: 100px;" align="center">
	                            <p align="center">Orders</p>
	                        </div>      
	                    </div>                            
	                </div>     
	                <div class="col-md-3">
	                    <div class="widget widget-default widget-item-icon" onclick="location.href='';">
	                        <div align="center">
	                            <img src="../../icons/activity.png" style="width: 100px; height: 100px;" align="center">
	                            <p align="center">Activity Log</p>
	                        </div>      
	                    </div>                            
	                </div>  
	                <div class="col-md-3">
	                    <div class="widget widget-default widget-item-icon" onclick="location.href='';">
	                        <div align="center">
	                            <img src="../../icons/orders.jpg" style="width: 100px; height: 100px;" align="center">
	                            <p align="center">Orders</p>
	                        </div>      
	                    </div>                            
	                </div>  

	                <div class="col-md-3">
	                    <div class="widget widget-default widget-item-icon" onclick="location.href='';">
	                        <div align="center">
	                            <img src="../../icons/images (3).jpg" style="width: 100px; height: 100px;" align="center">
	                            <p align="center">Products</p>
	                        </div>      
	                    </div>                            
	                </div>

	                <div class="col-md-3">
	                    <div class="widget widget-default widget-item-icon" onclick="location.href='';">
	                        <div align="center">
	                            <img src="../../icons/moneyvault.jpg" style="width: 100px; height: 100px;" align="center">
	                            <p align="center">Money Vault &#8358;<?php echo number_format($productDetails->sumMerchantProductsDet($merchant_number)) ?></p>
	                        </div>      
	                    </div>                            
	                </div>

	                <div class="col-md-3">
	                    <div class="widget widget-default widget-item-icon" onclick="location.href='';">
	                        <div align="center">
	                            <img src="../../icons/investment.png" style="width: 100px; height: 100px;" align="center">
	                            <p align="center">Un Publish Product  &#8358;<?php echo number_format($productDetails->sumMerchantProductsPublish($merchant_number)) ?></p> 
	                        </div>      
	                    </div>                            
	                </div>  
	                <div class="col-md-3">
	                    <div class="widget widget-default widget-item-icon" onclick="location.href='';">
	                        <div align="center">
	                            <img src="../../icons/cancel.jpg" style="width: 100px; height: 100px;" align="center">
	                            <p align="center">Un Publish Product  &#8358;<?php echo number_format($productDetails->sumMerchantUnProductsPublish($merchant_number)) ?></p>
	                        </div>      
	                    </div>                            
	                </div>                                
	            </div>
	        </div>
        </div>
	</div>
<?php
    include("../log-out-modal.php");
	include("../footer.php");
?>
