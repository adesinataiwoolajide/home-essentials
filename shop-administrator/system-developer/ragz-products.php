<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    require '../../libs_dev/products/products_class.php';
    $productsCate = new ragzNationProductsCategory($db);
    $productDetails = new ragzNationProducts($db);
    $email = $_SESSION['user_name'];
   
?>
<ul class="breadcrumb">
    <li><a href="./">Home</a></li>     
    <li><a href="view-all-products.php"><i class="fa fa-list"></i> View All Product</p></a></li>                 
    <li><a href="add-products.php"><i class="fa fa-plus"></i> Add Products</a></li>  
    <li><a href="publish-products-for-sale.php"><i class="fa fa-list"></i> Publish Product</p></a></li>    
    <li><a href="published-products.php"><i class="fa fa-cloud"></i> Published Product</p></a></li>
    <li><a href="unpublish-products.php"><i class="fa fa-list"></i> Un-Publish Product</p></a></li> 
    
    <li class="active">View all Ragz Product</li>   
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
    <div class="panel panel-default">
        
    </div>
        
        <div class="row">
            <div class="col-md-12"> 
                <div class="col-md-12">
                            
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <p>Use search to find contacts. You can search by: name, address, phone. Or use the advanced search.</p>
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <span class="fa fa-search"></span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Who are you looking for?"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <button class="btn btn-success btn-block"><span class="fa fa-plus"></span> Add new contact</button>
                                    </div>
                                </div>
                            </form>                                    
                        </div>
                    </div>
                    
                </div>
                <div class="row"><?php
                     $detail = $db->prepare("SELECT * FROM products_details ORDER BY product_number DESC"); 
                    $detail->execute(); 
                    if($detail->rowCount()==0){ ?>
                        <p style="color: red;" align="center"><h3 align="center">No Product Was Found. </h3></p><?php
                    }else{ 
                         while($row = $detail->fetch()){
                            $product_number = $row['product_number'];
                            $product_name = $row['product_name'];

                            $ragzProduct = $productDetails->getProductsDet($product_number);
                            $ragzProductDetails = $productDetails->getProductsDetails($product_number);
                            $category_id = $ragzProduct['category_id'];
                            $cateDetails = $productsCate->getCategoryDetailsId($category_id);
                            $category_name = $cateDetails['category_name'];
                            $manufacturer_id = $ragzProduct['manufacturer_id'];
                            $manuDetails = $productDetails->getRagzManufacturerDetails($manufacturer_id);
                            $manufacturer_name = $manuDetails['manufacturer_name']; ?>
                            <div class="col-md-3">
                                <!-- CONTACT ITEM -->
                                <div class="panel panel-default">
                                    <div class="panel-body profile">
                                        <div class="profile-image">
                                            <img src="<?php echo "../../images/products-images/large-image/".$ragzProduct['product_image'] ?>" style="width: 100px; height: 100px;">
                                        </div>
                                        <div class="profile-data">
                                            <div class="profile-data-name"><?php echo $product_name ?></div>
                                            <div class="profile-data-title"><?php echo $manufacturer_name ?></div>
                                        </div>
                                        <div class="profile-controls">
                                            <a href="products-details.php?product_number=<?php echo $product_number ?>" class="profile-control-left"><span class="fa fa-info"></span></a>
                                            <a href="products-details.php?product_number=<?php echo $product_number ?>" class="profile-control-right"><span class="fa fa-phone"></span></a>
                                        </div>
                                    </div>                                
                                    <div class="panel-body">                                    
                                        <div class="contact-info">
                                            <p><small>Product Number: </small><?php echo $product_number ?></p>
                                            <p><small>Category Name: </small><?php echo $manufacturer_name ?></p>
                                            <p><small>Publication Status</small><?php 
                                                $publish= $ragzProductDetails['publish'];
                                                if($publish == 0){ ?>
                                                    <p style="color: red" align="center">NOT PUBLISHED</p><?php
                                                }else{ ?>
                                                    <p style="color: green" align="center"> PUBLISHED</p><?php
                                                } ?>
                                            </p>                                   
                                        </div>
                                    </div>                                
                                </div>
                                <!-- END CONTACT ITEM -->
                            </div><?php
                        }
                    } ?>
                </div>
            </div>
        </div>    
</div>        

<?php
    include("../log-out-modal.php");
    include("../table-footer.php");
?>
