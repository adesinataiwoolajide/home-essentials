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
                <div class="panel panel-default">
                    <?php
                    $detail = $db->prepare("SELECT * FROM products_details ORDER BY details_id DESC"); 
                    $detail->execute(); 
                    if($detail->rowCount()==0){ ?>
                        <h3 align="center"><p style="color: red;" align="center">No Product Was Found.</p> </h3><?php
                    }else{ ?>
                        <div class="panel-heading">
                            <h3 class="panel-title">List of All Ragz Product</h3>
                            <?php include("../table-modal.php"); ?>
                        </div>
                        <div class="panel-body">
                             <table id="customers2" class="table datatable">
                                
                                <thead align="center">
                                    <tr>
                              
                                        <th>S/N</th>
                                        <th>Product Image</th>
                                        <th>Product Name</th>
                                        <th>Product Number</th> 
                                        <th>Manufacturer</th>
                                        <th>Category</th>
                                        <th>Type</th>
                                        <th>Quantity</th>
                                        <th>Publication</th>
                                        
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
                                        <th>Type</th>
                                        <th>Quantity</th>
                                        <th>Publication</th>
                                      
                                        <th>Operation</th>
                                    </tr>
                                </tfoot>

                                <tbody><?php
                                    $y =1;
                                    while($row = $detail->fetch()){
                                        $product_number = $row['product_number'];
                                        $product_name = $row['product_name'];

                                        $ragzProduct = $productDetails->getProductsDet($product_number);
                                        $ragzProductDetails = $productDetails->getProductsDetails($product_number);
                                        $type_id = $ragzProduct['type_id'];
                                        $typeDe = $productsCate->getTypeDetailsId($type_id);
                                        $category_id = $typeDe['category_id'];
                                        $cateDetails = $productsCate->getCategoryDetailsId($category_id);
                                        $category_name = $cateDetails['category_name'];
                                        $manufacturer_id = $ragzProduct['manufacturer_id'];
                                        $manuDetails = $productDetails->getRagzManufacturerDetails($manufacturer_id);
                                        $manufacturer_name = $manuDetails['manufacturer_name']; ?>
                                        <tr>
                                            
                                            <td><?php echo $y; ?></td>
                                            <td><img src="<?php echo "../../images/product/large-image/".$ragzProduct['product_image'] ?>" style="width: 50px; height: 50px;"></td>
                                            <td><?php echo $row['product_name']; ?></td>
                                            <td><?php echo $row['product_number']; ?></td>
                                            <td><?php echo $manufacturer_name; ?></td>
                                            <td><?php echo $category_name; ?></td>
                                            <td><?php echo $typeDe['type_name'] ?></td>
                                            <td><?php $quantity = $ragzProductDetails['quantity']; 
                                                if($quantity <= 20){ ?>
                                                    <p style="color: red"><?php echo $quantity; ?></p><?php
                                                }else{ ?>
                                                    <p style="color: green"> <?php echo $quantity; ?></p><?php
                                                }  ?>
                                            </td>
                                            <td><?php 
                                                $publish= $ragzProductDetails['publish'];
                                                if($publish == 0){ ?>
                                                    <p style="color: red">Not Published</p><?php
                                                }else{ ?>
                                                    <p style="color: green"> Published</p><?php
                                                }
                                                
                                                ?>
                                                
                                            </td>
                                            <!-- <td><?php echo $row['time_added']; ?></td> -->
                                            <td>
                                                <a href="product-details.php?product_number=<?php echo $product_number ?>" class="btn btn-success"><i class="fa fa-cogs"></i></a>
                                                <a href="edit-products-details.php?product_number=<?php echo $product_number ?>" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                                <a href="delete-product-details.php?product_number=<?php echo $product_number ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                                
                                            </td>
                                        </tr><?php
                                        $y++;
                                    } ?> 
                                </tbody>
                            </table>
                         </div><?php
                        
                    } ?>    
                </div>
            </div>
        </div>    
</div>        

<?php
    include("../log-out-modal.php");
    include("../table-footer.php");
?>
