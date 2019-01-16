<?php
    $pagetitle = "Product Categoires"; 
    include("includes/header.php");
    $type_name = $_GET['type_name'];
    $cateDetails = $productsCate->ggetTypeDetailsName($type_name);
    $type_id = $cateDetails['type_id'];
    $totalItems =  count($productDetails->getAllProductsCategoryList($category_id));
    $itemsPerPage = 20;
    $page = isset($_GET['page']) ? ($_GET['page']) : 1;
    $start = $page > 1 ? ($page * $itemsPerPage) - $itemsPerPage : 0;
    $totalPages = ceil($totalItems / $itemsPerPage);
    $seeProdcut = $productDetails->getAllProductsTypeList($type_id, $category_id, $start, $itemsPerPage);
?>
<div class="body-content outer-top-xs" id="top-banner-and-menu">  
    <div class="container">
        <div class="row"> 
            <!-- ============================================== SIDEBAR ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar"> 
            <!-- ================================== TOP NAVIGATION ================================== -->
            <?php 
                include("includes/category-sidebar.php"); 
            ?>
            <div class="sidebar-widget hot-deals wow fadeInUp outer-bottom-xs">
                <h3 class="section-title">hot deals</h3>
                <div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-ss"><?php 
                    foreach($productDetails->getAllTheProductsSideBar() as $sideProduct){
                        $product_number = $sideProduct['product_number'];
                        $ragzProduct = $productDetails->getProductsDet($product_number);
                        $ragzProductDetails = $productDetails->getProductsDetails($product_number);
                        $type_id = $ragzProduct['type_id'];
                        $typeDe = $productsCate->getTypeDetailsId($type_id);
                        $category_id = $typeDe['category_id'];
                        $cateDetails = $productsCate->getCategoryDetailsId($category_id);
                        $categoryname = $cateDetails['category_name'];
                        $manufacturer_id = $ragzProduct['manufacturer_id'];
                        $gettingManu = $db->prepare("SELECT * FROM manufacturer WHERE manufacturer_id=:manufacturer_id");
                        $arr = array(':manufacturer_id'=>$manufacturer_id);
                        $gettingManu->execute($arr); 
                        $sku = $product_number; ?>
                        <div class="item">
                            <div class="products">
                                <div class="hot-deal-wrapper">
                                    <div class="image"> 
                                        <img src="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" ">
                                    </div>
                                </div>
                                <!-- /.hot-deal-wrapper -->
                                <div class="product-info text-left m-t-20">
                                    <h3 class="name">
                                        <a href="product-detail.php?product_number=<?php echo $product_number ?>"><?php echo $ragzProduct['product_name']; ?>
                                            
                                        </a>
                                    </h3>
                                    <div class="rating rateit-small">
                                        
                                    </div>
                                    <div class="product-price"> 
                                        <span class="price" style="color: green"> <?php 
                                            $num = (5/100)*$ragzProductDetails['product_price'] + $ragzProductDetails['product_price'];
                                            $num2= (20/100)*$ragzProductDetails['product_price'];
                                            $adding = $num2 + $ragzProductDetails['product_price'];
                                            number_format($ragzProductDetails['product_price']); ?> 
                                             &#8358;<?php echo number_format($adding) ?> 
                                        </span> 
                                        <span class="price-before-discount" style="color: red"><?php
                                            $num3= (40/100)*$ragzProductDetails['product_price'];
                                            $adding2 = $num3 + $ragzProductDetails['product_price'];
                                            number_format($ragzProductDetails['product_price']); ?> 
                                             &#8358;<?php echo number_format($adding2) ?>
                                        </span> 
                                    </div>
                                    <!-- /.product-price -->  
                                </div><!-- /.product-info -->
                            
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <div class="add-cart-button btn-group">
                                          <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>

                                          <button class="btn btn-primary cart-btn" type="button">Add to cart</button> 
                                          <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                        </div>
                                    </div>
                                  <!-- /.action --> 
                                </div>
                                <!-- /.cart --> 
                            </div>
                        </div><?php 
                    } ?>

                </div>
                      <!-- /.sidebar-widget --> 
            </div>
            <div class="sidebar-widget product-tag wow fadeInUp">
                <h3 class="section-title">Product tags</h3>
                <div class="sidebar-widget-body outer-top-xs">
                    <div class="tag-list"> 
                        <?php
                        $cate = $db->prepare("SELECT * FROM product_type ORDER BY type_id desc  LIMIT 0,15");
                        $cate->execute();
                        while($see_cate = $cate->fetch()){?>
                            <a class="item" href="" name="<?php echo $see_cate['type_name'] ?>"><?php echo $see_cate['type_name'] ?> </a><?php
                        } ?>
                    </div>
                    <!-- /.tag-list --> 
                </div>
                <!-- /.sidebar-widget-body --> 
            </div>


            <div class="home-banner"> <img src="assets/images/banners/LHS-banner.jpg" alt="Image"> </div>
        </div>
        <!-- ============================================== CONTENT ============================================== -->
    <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder"> 
        <!-- ========================================== SECTION – HERO ========================================= -->
        
        <div id="hero"> <?php
            if($totalItems == 0){ ?>
                <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                    <div class="more-info-tab clearfix ">
                        <h3><p style="color: red" align="center">No Product is Found for <?php echo $type_name ?></p></h3>
                    </div>
                </div>  <?php 
            } else{ ?>         
                <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                    <div class="more-info-tab clearfix ">
                        <h3 class="new-product-title pull-left">Products in <?php echo $type_name ?> Categories </h3>
                        <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                            <li class="active"><a href="./">All</a></li>
                            <li class="active"><a href="products-categories.php?category_name=<?php echo $category_name ?> " ><?php echo $category_name ?></a>
                            </li><?php 
                            $cate = $db->prepare("SELECT * FROM products_type WHERE type_name !=:type_name ORDER BY type_id DESC LIMIT 0,5");
                            $arr = array(':type_name'=>$type_name);
                            $cate->execute($arr);
                            while($see_cate = $cate->fetch()){?>
                                <li>
                                    <a href="products-types.php?type_name=<?php echo $see_cate['type_name'] ?> ">
                                        <?php echo $see_cate['category_name'] ?> 
                                    </a> 
                                </li><?php
                            } ?>    
                        </ul>
                        <!-- /.nav-tabs --> 
        
                        <div class="col col-sm-6 col-md-12 text-right">
                            <div class="pagination-container">
                                <?php 
                                if($totalItems > 320){ ?>
                                    <ul class="list-inline list-unstyled">
                                        <?php $b = $page - 1;
                                          if($page != 1){ ?>
                                              <li class="prev"><a href="products-types.php?type_name=<?php echo $type_name ?>&&page=<?php echo $page - 1?>"><i class="fa fa-angle-left"></i></a></li>
                                        <?php } ?>

                                        <?php if($page != $totalPages){ ?>
                                              <li class="next"><a href="products-types.php?type_name=<?php echo $type_name ?>&&page=<?php echo $page + 1?>"><i class="fa fa-angle-right"></i></a></li>
                                        <?php } ?>                                        
                                    </ul><?php 
                                } ?>
                                <!-- /.list-inline --> 
                            </div>
                    
                         <!-- /.col --> 
                        </div>

                        <hr>
                        <div class="tab-content outer-top-xs">
                            <div id="myTabContent" class="tab-content category-list">
                                <div class="tab-pane active " id="grid-container">
                                    <div class="category-product">
                                        <div class="row"><?php
                                            foreach($seeProdcut as $featureProduct){ 
                                                $product_number = $featureProduct['product_number'];
                                                $ragzProduct = $productDetails->getProductsDet($product_number);
                                                $ragzProductDetails = $productDetails->getProductsDetails($product_number);
                                                $type_id = $ragzProduct['type_id'];
                                                $typeDe = $productsCate->getTypeDetailsId($type_id);
                                                $category_id = $typeDe['category_id'];
                                                $cateDetails = $productsCate->getCategoryDetailsId($category_id);
                                                $categoryname = $cateDetails['category_name'];
                                                $manufacturer_id = $ragzProduct['manufacturer_id'];
                                                $gettingManu = $db->prepare("SELECT * FROM manufacturer WHERE manufacturer_id=:manufacturer_id");
                                                $arr = array(':manufacturer_id'=>$manufacturer_id);
                                                $gettingManu->execute($arr); 
                                                $sku = $product_number; ?>
                                                <div class="col-sm-6 col-md-3 wow fadeInUp">
                                                    <div class="products">
                                                        <div class="product">
                                                            <div class="product-image">
                                                                <div class="image"> 
                                                                    <a href="product-detail.php?product_number=<?php echo $product_number ?>">
                                                                     <img src="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" style="width: 150px; height: 150px;"></a>
                                                                </div>
                                                                <!-- /.image -->                          
                                                                <div class="tag new"><span>new</span>
                                                                </div>
                                                            </div>
                                                            <!-- /.product-image -->
                                    
                                                            <div class="product-info text-left">
                                                                <h3 class="name"><a href="product-detail.php<?php echo '?id='.$sku?>"><?php echo $ragzProduct['product_name']; ?></a></h3>
                                                                <div class="rating rateit-small">
                                                                    
                                                                </div>
                                                                <div class="description">
                                                                    <?php while($see = $gettingManu->fetch()){ echo $see['manufacturer_name']; } ?>
                                                                </div>
                                                                <div class="product-price"> 
                                                                    <span class="price" style="color: green"><?php 
                                                                        $num = (5/100)*$ragzProductDetails['product_price'] + $ragzProductDetails['product_price'];
                                                                        $num2= (20/100)*$ragzProductDetails['product_price'];
                                                                        $adding = $num2 + $ragzProductDetails['product_price'];
                                                                        number_format($ragzProductDetails['product_price']); ?> 
                                                                         &#8358;<?php echo number_format($adding) ?>    
                                                                     </span> 
                                                                     <span class="price-before-discount" style="color: red"><?php
                                                                        $num3= (40/100)*$ragzProductDetails['product_price'];
                                                                        $adding2 = $num3 + $ragzProductDetails['product_price'];
                                                                        number_format($ragzProductDetails['product_price']); ?> 
                                                                         &#8358;<?php echo number_format($adding2) ?>
                                                                    </span>  
                                                                    </div>
                                                              <!-- /.product-price --> 
                                                            </div>
                                                            <!-- /.product-info -->
                                                            <div class="cart clearfix animate-effect">
                                                                <div class="action">
                                                                    <ul class="list-unstyled">
                                                                        <!-- <li class="add-cart-button btn-group">
                                                                            <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </button>
                                                                            <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                                        </li> -->
                                                                        <li class="lnk wishlist"> 
                                                                            <a data-toggle="tooltip" class="add-to-cart" href="product-detail.php<?php echo '?id='.$sku?>" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> 
                                                                        </li>
                                                                        <li class="lnk"> 
                                                                            <a data-toggle="tooltip" class="add-to-cart" href="product-detail.php<?php echo '?id='.$sku ?>" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> 
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                  <!-- /.action --> 
                                                            </div>
                                                                <!-- /.cart --> 
                                                        </div>
                                                        <!-- /.home-owl-carousel --> 
                                                    </div>
                                                      <!-- /.product-slider --> 
                                                </div><?php 
                                            } ?>
                                        </div>  
                                    </div>
                                    <!-- /.tab-content --> 
                                </div>
                            </div>
                        </div> 
                    </div>
                </div><?php 
            } ?>
        </div>
            <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->    
        
        <!-- ============================================== CONTENT : END ============================================== --> 
    </div>
</div>
<?php
    include("includes/footer.php"); 
?>