<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    require '../../libs_dev/products/products_class.php';
    $productsCate = new ragzNationProductsCategory($db);
	$productDetails = new ragzNationProducts($db);
    $product_number = $_GET['product_number'];
    $ragzProduct = $productDetails->getProductsDet($product_number);
    $ragzProductDetails = $productDetails->getProductsDetails($product_number);
    $product_name = $ragzProduct['product_name'];
    $category_id = $ragzProduct['category_id'];
    $cateDetails = $productsCate->getCategoryDetailsId($category_id);
    $category_name = $cateDetails['category_name'];
    $manufacturer_id = $ragzProduct['manufacturer_id'];
    $manuDetails = $productDetails->getRagzManufacturerDetails($manufacturer_id);
    $manufacturer_name = $manuDetails['manufacturer_name'];
    $type_id = $ragzProductDetails['type_id'];
    $typeDetails = $productsCate->getTypeDetailsId($type_id);
    $type_name = $typeDetails['type_name'];
?>
<ul class="breadcrumb">
    <li><a href="./">Home</a></li>  
    <li><a href="product-details.php?product_number=<?php echo $product_number?>"><?php echo $product_name ?> Details</p></a></li>  
                  
    <li><a href="add-products.php"><i class="fa fa-plus"></i> Add Products</a></li>  
    <li><a href="view-all-products.php"><i class="fa fa-list"></i> View All Product</p></a></li>  
    <li><a href="edit-product-details.php?product_number=<?php echo $product_number?>">Edit Details</p></a></li>
    <li><a href="unpublish-products.php"><i class="fa fa-list"></i> Un-Publish Product</p></a></li> 
    <li><a href="publish-products-for-sale.php"><i class="fa fa-list"></i> Publish Product</p></a></li>    
    <li><a href="published-products.php"><i class="fa fa-cloud"></i> Published Product</p></a></li> 
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
        <div class="col-md-3">
            
            <div class="panel panel-default">
                <div class="panel-body profile" style="background: url('<?php echo "../../images/products-images/large-image/".$ragzProduct['product_image'] ?>') center center no-repeat;">
                    <div class="profile-image">
                        <img src="<?php echo "../../images/products-images/large-image/".$ragzProduct['product_image'] ?>" alt="<?php echo $product_number; ?>" style="width: 100px; height: 100px;"/>
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name" style="color: black">
                        	<?php echo $product_name; ?>
                        </div>
                        <div class="profile-data-title" style="color: black;">
                        	<?php echo $product_number; ?>	
                        </div>
                    </div>                                 
                </div>                                
                <div class="panel-body">                                    
                    <div class="row" align="center">
                        Product Image
                    </div>
                </div>
                <div class="panel-body list-group border-bottom" align="center">
                	<a href="product_details.php?product_number=<?php echo $product_number?>" class="list-group-item active"><span class="fa fa-image"></span> Product Thumbnail Image
                	</a>
                	<img src="<?php echo "../../images/products-images/thumbnail/".$ragzProductDetails['product_thumbnail'] ?>" alt="<?php echo $product_number; ?>" align="center" style="width: 200px; height: 200px;"/>
                	<a href="edit-products-thumbnails?product_number=<?php echo $product_number ?>" class="btn btn-success">Change The Image</a>
                </div>
                
            </div>                            
            
        </div>
        
        <div class="row">
        	<div class="col-md-9"> 
	            <div class="panel panel-default">
	                <form action="process-update-product-image.php" method="post" class="form-horizontal" enctype="multipart/form-data">
	                                                        
	                    <div class="panel-body">
	                    	<div class="panel-body form-group-separated">    
			                    <div class="form-group col-md-12">
			                    	<div class="panel-body form-group-separated">   
				                        <label class="col-md-2 col-xs-12 control-label">PRODUCT NAME</label>
				                        <div class="col-md-10 col-xs-12">
				                        	<div class="input-group">
				                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
				                                <input type="text" class="form-control" name="product_name" placeholder="Enter The Product Name" value="<?php echo $product_name ?>" required minlength="3" readonly />
				                            </div>                                             
				                                                                       
				                            <span class="help-block" style="color: red;">This is field is Required.</span>
				                        </div> 
				                    </div>
				                    <div class="panel-body form-group-separated">   
				                        <label class="col-md-2 col-xs-12 control-label">PRODUCT NUMBER</label>
				                        <div class="col-md-10 col-xs-12">
				                        	<div class="input-group">
				                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
				                                <input type="text" class="form-control" name="" placeholder="Enter The Product Name" value="<?php echo $product_number ?>" required minlength="3" readonly />
				                            </div>                                             
				                                                                       
				                            <span class="help-block" style="color: red;">This is field is Required.</span>
				                        </div> 
				                    </div>
			                    	<div class="panel-body form-group-separated">   
				                		<label class="col-md-2 col-xs-12 control-label">CHANGE <BR>PRODUCT <BR> IMAGE</label>
				                        <div class="col-md-10 col-xs-12">

				                        	<div class="input-group">
				                                <span class="input-group-addon"><span class="fa fa-image"></span></span>
				                                <input type="file" class="form-control file" name="image" />
				                            </div>                                            
				                            <span class="help-block" style="color: red;">This is field is Required.</span>
				                        </div>
				                    </div>
				                    
				                    
				        		</div>
				        		<input type="hidden" name="product_number" value="<?php echo $product_number ?>">
				        		<input type="hidden" name="return" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
				        		<div class="panel-footer col-md-12">                                 
				                    <button class="btn btn-success pull-right" name="update-product">UPDATE THE PRODUCT THUMBNAIL</button>
				                </div>
				            </div>
				        </div>
	                </form>                                    
	            </div>
	        </div>
        </div>
        

	</div>
<?php
    include("../log-out-modal.php");
	include("../table-footer.php");
?>

