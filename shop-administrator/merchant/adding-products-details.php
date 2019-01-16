<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    require '../../libs_dev/products/products_class.php';   
    require '../../libs_dev/merchant/merchant_class.php';
    $productsCate = new ragzNationProductsCategory($db);

    $merchantDetails = new productMerchant($db);
    $productDetails = new ragzNationProducts($db);
    $merchant_email = $_SESSION['user_name'];
    $myDetails = $merchantDetails->gettingMerchantEmailDelatils($merchant_email);
    $merchant_number = $myDetails['merchant_number'];
    $merchant_name = $myDetails['merchant_name'];
    $users = $merchant_email;
    $admin = $register->gettingUserDetails($users);
    $product_number = $_GET['product_number'];
    $ragzProduct = $productDetails->getProductsDet($product_number);
    $product_name = $ragzProduct['product_name'];
    $category_id = $ragzProduct['category_id'];
    $cateDetails = $productsCate->getCategoryDetailsId($category_id);
    $category_name = $cateDetails['category_name'];
    $manufacturer_id = $ragzProduct['manufacturer_id'];
    $manuDetails = $productDetails->getRagzManufacturerDetails($manufacturer_id);
    $manufacturer_name = $manuDetails['manufacturer_name'];
?>
<ul class="breadcrumb">
    <li><a href="./">Home</a></li>                    
    <li><a href="adding-products-details.php?product_number=<?php echo $product_number ?>">Adding Product Details</a></li>  
    <li><a href="add-products.php"><i class="fa fa-plus"></i> Add Products</a></li>  
    <li><a href="view-all-products.php"><i class="fa fa-list"></i> View All Product</p></a></li> 
    <li><a href="unpublish-products.php"><i class="fa fa-list"></i> Un-Publish Product</p></a></li> 
    <li><a href="publish-products-for-sale.php"><i class="fa fa-list"></i> Publish Product</p></a></li>    
    <li><a href="published-products.php"><i class="fa fa-cloud"></i> Published Product</p></a></li>   
    <li class="active">Adding Product Details</li>   
</ul>               

<div class="content-frame">                                    
    <!-- START CONTENT FRAME TOP -->
    <div class="content-frame-top">
        <div class="page-title">                    
            <h2><span class="fa fa-plus"></span> Product Details Form</h2>
        </div>                         
    </div>
    <?php
    if((isset($_SESSION['success'])) OR ((isset($_SESSION['error'])) === true)){ ?>
        <div class="alert alert-info" align="center">
            <button class="close" data-dismiss="alert">
                <i class="ace-icon fa fa-times"></i>
            </button>
         <?php include("../includes/feed-back.php"); ?>
        </div><?php 
    }  ?>
    
    <div class="panel panel-default">
    	<div class="row">
        	<div class="col-md-12">
        	 	<div class="col-md-2">
        	 		<div class="">
		        			<div class="block">
				            <div class="list-group border-bottom">
				                <img src="<?php echo "../../assets/images/products-images/large-image/".$ragzProduct['product_image'] ?>" style="width: 150px; height: 150px;">                  
				            </div> 
				            <h5><P><strong><?php echo $product_number ?></strong></P></h5>
				            <h5><P><strong><?php echo $product_name ?></strong></P></h5>
				            <h5><P><strong><?php echo $category_name ?></strong></P></h5>
				            <h5><P><strong><?php echo $manufacturer_name ?></strong></P></h5>                     
				        </div>
				        
				    </div>
		        </div>
		        <form action="process-adding-product.php" method="post" class="form-horizontal" enctype="multipart/form-data">
	        		<div class="col-md-10">
	        	 		<div class="panel-body form-group-separated">    
		                    <div class="form-group col-md-12">
		            		<label class="col-md-2 col-xs-12 control-label">PRODUCT THUMBNAIL</label>
		                    <div class="col-md-10 col-xs-12">
		                    	<div class="input-group">
		                            <span class="input-group-addon"><span class="fa fa-gallery"></span></span>
		                            <input type="file" class="form-control text" name="image"  required />
		                        </div>                                            
		                        <span class="help-block" style="color: red;">This is field is Required.</span>
		                    </div>
		                </div>
		                <div class="panel-body form-group-separated">    
		                    <div class="form-group col-md-12">
		            		<label class="col-md-2 col-xs-12 control-label">PRODUCT TYPES</label>
		                    <div class="col-md-10 col-xs-12">
		                    	<div class="input-group">
		                            <span class="input-group-addon"><span class="fa fa-sitemap"></span></span>
		                            <select class="form-control " name="type_id" required>
                                        <option value="">-- Select The Product Types From The List --
                                        </option>
                                        <option value=""></option>
                                        <?php
                                        $del = $db->prepare("SELECT * FROM product_type ORDER BY type_name ASC");
                                        $del->execute();
                                        while($nov = $del->fetch()){ ?>
                                            <option value="<?php echo $nov['type_id']; ?>"><?php echo $nov['type_name']; ?></option>
                                            <?php
                                        } ?>
                                    </select>
		                        </div>                                            
		                        <span class="help-block" style="color: red;">This is field is Required.</span>
		                    </div>
		                </div>
		                
		                <div class="panel-body form-group-separated">    
		                    <div class="form-group col-md-12">
		            		<label class="col-md-2 col-xs-12 control-label">PRODUCT SIZE</label>
		                    <div class="col-md-10 col-xs-12">
		                    	<div class="input-group">
		                            <span class="input-group-addon"><span class="fa fa-sitemap"></span></span>
		                            <input type="text" class="form-control text" name="product_size" placeholder="Enter The Product Size" required />
		                        </div>                                            
		                        <span class="help-block" style="color: red;">This is field is Required.</span>
		                    </div>
		                </div>
		                <div class="panel-body form-group-separated">    
		                    <div class="form-group col-md-12">
		            		<label class="col-md-2 col-xs-12 control-label">PRODUCT PRICE</label>
		                    <div class="col-md-10 col-xs-12">
		                    	<div class="input-group">
		                            <span class="input-group-addon"><span class="fa fa-money"></span></span>
		                            <input type="text" class="form-control text" name="product_price" placeholder="Enter The Product Price" required />
		                        </div>                                            
		                        <span class="help-block" style="color: red;">This is field is Required.</span>
		                    </div>
		                </div>
		                <div class="panel-body form-group-separated">    
		                    <div class="form-group col-md-12">
		            		<label class="col-md-2 col-xs-12 control-label">PRODUCT QUANTITY</label>
		                    <div class="col-md-10 col-xs-12">
		                    	<div class="input-group">
		                            <span class="input-group-addon"><span class="fa fa-cog"></span></span>
		                            <input type="text" class="form-control text" name="quantity" placeholder="Enter The Product Quantity"  required />
		                        </div>                                            
		                        <span class="help-block" style="color: red;">This is field is Required.</span>
		                    </div>
		                </div>
		                <div class="panel-body form-group-separated">
		            		<label class="col-md-2 col-xs-12 control-label">PRODUCT DESCRIPTION</label>
		                    <div class="col-md-10 col-xs-12">
		                    	<div class="input-group">
		                            <textarea class="summernote_email" name="product_description" required placeholder="Please Enter The Product Description Here" cols="112">
				                    </textarea> 
		                        </div>                                            
		                        <span class="help-block" style="color: red;">This is field is Required.</span>
		                    </div>
			                
				        </div>
	        		</div>
	        		<input type="hidden" name="product_number" value="<?php echo $product_number ?>">
	        		<input type="hidden" name="category_id" value="<?php echo $category_id ?>">
	        		<input type="hidden" name="return" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
	        		<div class="panel-footer col-md-12">                                 
	                    <button class="btn btn-success pull-right" name="adding-product">ADD A NEW PRODUCT</button>
	                </div>
	            </form>
        	</div>
        </div>
    </div>
                   
    
</div>
</div>
</div>            
</div>
<?php
    include("../log-out-modal.php");
?>
    <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
    <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
    <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>            
    <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
    <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
    <script type="text/javascript" src="js/plugins/summernote/summernote.js"></script>
    <script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>       
    <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>        
    <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-text-input.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>        
    <script type="text/javascript" src="js/actions.js"></script>                   
</body>
</html>






