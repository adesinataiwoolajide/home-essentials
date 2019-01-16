<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    require '../../libs_dev/products/products_class.php';
    require '../../libs_dev/merchant/merchant_class.php';
    $merchantDetails = new productMerchant($db);
    $productsCate = new ragzNationProductsCategory($db);
    $productDetails = new ragzNationProducts($db);
    $merchant_email = $_SESSION['user_name'];
    $myDetails = $merchantDetails->gettingMerchantEmailDelatils($merchant_email);
    $merchant_number = $myDetails['merchant_number'];
    $merchant_name = $myDetails['merchant_name'];
    $details = $merchantDetails->gettingMerchantDelatils($merchant_number);
    $merchant_name = $details['merchant_name'];
    $merchant_email = $details['merchant_email'];
    $users = $merchant_email;
    $admin = $register->gettingUserDetails($users);
   
?>
<ul class="breadcrumb">
    <li><a href="./">Home</a></li> 
    <li><a href="unpublish-my-products.php"><i class="fa fa-cloud"></i>Un Publish Product</p></a></li>  
    <li><a href="my-unpublished-products.php"><i class="fa fa-cloud"></i>My Un-Published Product</p></a></li>  
    <li><a href="publish-my-product.php"><i class="fa fa-list"></i> Publish Product</p></a></li>    
   
    <li><a href="my-products-list.php"><i class="fa fa-list"></i> View All My Product</p></a></li>                 
    <li><a href="add-products.php"><i class="fa fa-plus"></i> Add Products</a></li>  
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
        <div class="col-md-12"> 
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">List of All <?php echo $merchant_name ?> Un Published Product</h3>
                    <?php include("../table-modal.php"); ?>
                </div>
                <div class="panel-body"><?php
                    $detail = $db->prepare("SELECT * FROM products WHERE publish=1 AND merchant_number=:merchant_number ORDER BY product_id DESC"); 
                    $arr = array(':merchant_number'=>$merchant_number);
                    $detail->execute($arr); 
                    if($detail->rowCount()==0){ ?>
                        <h3 align="center"><p style="color: red;" align="center">No Product Was Found. </p></h3><?php
                    }else{ ?>
                        <form action="process-unpublish-product.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <table id="customers2" class="table datatable">
                                
                                <thead align="center">
                                    <tr>
                              
                                        <th>S/N</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Number</th> 
                                        <th>Manufacturer</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Action Time</th> 
                                        <th>Operation</th>
                                    </tr>
                                </thead>
                                <tfoot align="center">
                                    <tr>
                              
                                        <th>S/N</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Number</th> 
                                        <th>Manufacturer</th>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Action Time</th> 
                                        <th>Operation</th>
                                    </tr>
                                </tfoot>

                                <tbody><?php
                                    $y =1;
                                    while($row = $detail->fetch()){
                                        $product_number = $row['product_number'];
                                        
                                        $ragzProduct = $productDetails->getProductsDet($product_number);
                                        $ragzProductDetails = $productDetails->getProductsDetails($product_number);
                                        $category_id = $ragzProduct['category_id'];
                                        $cateDetails = $productsCate->getCategoryDetailsId($category_id);
                                        $category_name = $cateDetails['category_name'];
                                        $manufacturer_id = $ragzProduct['manufacturer_id'];
                                        $product_name = $ragzProduct['product_name'];
                                        $manuDetails = $productDetails->getRagzManufacturerDetails($manufacturer_id);
                                        $manufacturer_name = $manuDetails['manufacturer_name']; ?>
                                        <tr>
                                            
                                            <td><?php echo $y;  ?></td>
                                            <td><img src="<?php echo "../../assets/images/products-images/large-image/".$ragzProduct['product_image'] ?>" style="width: 50px; height: 50px;"></td>
                                            <td><?php echo $product_name; ?></td>
                                            <td><?php echo $row['product_number']; ?></td>
                                            <td><?php echo $manufacturer_name; ?></td>
                                            <td><?php echo $category_name; ?></td>
                                            <td><?php $quantity = $ragzProductDetails['quantity']; 
                                                if($quantity <= 20){ ?>
                                                    <p style="color: red"><?php echo $quantity; ?></p><?php
                                                }else{ ?>
                                                    <p style="color: green"> <?php echo $quantity; ?></p><?php
                                                }  ?>
                                            </td>
                                            <td><?php echo $row['created']; ?></td>
                                            <td>
                                                <input type="checkbox" value="1" name="published<?php echo $y; ?>"> Un-Publish
                                                
                                            </td>
                                            <input type="hidden" name="merchant_number" value="<?php echo $merchant_number ?>">
                                            <input type="hidden" name="product_number<?php echo $y; ?>" value="<?php echo $product_number; ?>">
                                        </tr><?php
                                        $y++;
                                    } ?> 
                                </tbody>
                            </table>
                            <div class="col-md-12" align="center">
                                 <input type="hidden" name="show" value="<?php echo $y; ?>">
                                <button class="btn btn-danger">UnPublish The Selected Products</button>
                            </div>
                        </form><?php
                    
                    } ?>    
                </div>
            </div>
        </div>
    </div>    
</div>        

<?php
    include("../log-out-modal.php");
    include("../table-footer.php");
?>
