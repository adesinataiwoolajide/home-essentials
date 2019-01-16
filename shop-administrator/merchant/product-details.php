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
    <li><a href="edit-products-details.php?product_number=<?php echo $product_number?>">Edit Details</p></a></li>
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
                <div class="panel-body profile" style="background: url('<?php echo "../../assets/products-images/large-image/".$ragzProduct['product_image'] ?>') center center no-repeat;">
                    <div class="profile-image">
                        <img src="<?php echo "../../assets/images/products-images/large-image/".$ragzProduct['product_image'] ?>" alt="<?php echo $product_number; ?>" style="width: 100px; height: 100px;"/>
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
                	<a href="Product_details.php?product_number=<?php echo $product_number?>" class="list-group-item active"><span class="fa fa-image"></span> Product Thumbnail Image
                	</a>
                	<img src="<?php echo "../../assets/images/products-images/thumbnail/".$ragzProductDetails['product_thumbnail'] ?>" alt="<?php echo $product_number; ?>" align="center" style="width: 200px; height: 200px;"/>
                	<a href="edit-product-thumbnail.php?product_number=<?php echo $product_number ?>" class="btn btn-success">Change The Image</a>
                </div>
                
            </div>                            
            
        </div>
        
        <div class="row">
        	<div class="col-md-9"> 
	            <div class="panel panel-default">
	                <table id="customers2" class="table datatable">
	                                                        
	                    <div class="panel-body">
	                    	<table class="table table-responsive">
	                    		
	                    		<tbody>
	                    			<tr>
	                    				<td>Product Name</td>
	                    				<td><?php echo $product_name; ?></td>
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Product Number</td>
	                    				<td><?php echo $product_number ?></td>
	                    			</tr>
	                    		</tbody>

	                    		<tbody>
	                    			<tr>
	                    				<td>Product Price</td>
	                    				<td><?php echo $ragzProductDetails['product_price']; ?></td>
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Product Quantity</td>
	                    				<td><?php 
	                    					$quantity = $ragzProductDetails['quantity']; 
	                    					if($quantity <= 20){ ?>
	                    						<p style="color: red"><?php echo $quantity; ?></p><?php
	                    					}else{ ?>
	                    						<p style="color: green"> <?php echo $quantity; ?></p><?php
	                    					} ?>	
	                    				</td>
	                    			</tr>
	                    		</tbody>

	                    		<tbody>
	                    			<tr>
	                    				<td>Product Size</td>
	                    				<td><?php echo $ragzProductDetails['product_size'] ?></td>
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Product Manufacturer</td>
	                    				<td><?php echo $manufacturer_name ?></td>
	                    			</tr>
	                    		</tbody>

	                    		<tbody>
	                    			<tr>
	                    				<td>Product Type</td>
	                    				<td><?php echo $type_name ?></td>
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Product Category</td>
	                    				<td><?php echo $category_name ?></td>
	                    			</tr>
	                    		</tbody>
	                    		
	                    		<tbody>
	                    			<tr>
	                    				<td>Product Description</td>
	                    				<td><?php echo $ragzProductDetails['product_description']; ?></td>
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Publish Status</td>
	                    				<td><?php 
	                    					$publish= $ragzProductDetails['publish'];
	                    					if($publish == 0){ ?>
	                    						<p style="color: red">Not Published</p><?php
	                    					}else{ ?>
	                    						<p style="color: green"> Published</p><?php
	                    					}
	                    				 	
	                    				 	?>
	                    				 	
	                    				</td>
	                    			</tr>
	                    		</tbody>
	                    		
	                    	</table>                       
	                        <div class="panel-footer col-md-12">                                 
			                    <a href="edit-products-details.php?product_number=<?php echo $product_number; ?>" class="btn btn-success pull-right">EDIT PRODUCT DETAILS</a>
			                </div>
	                    </div>
	                </table>                                    
	            </div>
	        </div>
        </div>
        <!-- <?php include 'Product-act-log.php'; ?> -->
	</div>
<?php
    include("../log-out-modal.php");
	include("../table-footer.php");
?>

