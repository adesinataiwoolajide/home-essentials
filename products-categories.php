<?php
    $pagetitle = "Product Categoires"; 
    include("includes/header.php");
    $category_name = $_GET['category_name'];
    $cateDetails = $productsCate->getCategoryDetailsName($category_name);
    $category_id = $cateDetails['category_id'];
    $totalItems =  count($productDetails->getAllProductsCategoryList($category_id));
    $itemsPerPage = 4;
    $page = isset($_GET['page']) ? ($_GET['page']) : 1;
    $start = $page > 1 ? ($page * $itemsPerPage) - $itemsPerPage : 0;
    $totalPages = ceil($totalItems / $itemsPerPage);
    $seeProdcut = $productDetails->getCategoryProductsDeta($category_id, $start, $itemsPerPage);
?>
<div class="body-content outer-top-xs" id="top-banner-and-menu">  
    <div class="container">
        <div class="row"> 
            <!-- ============================================== SIDEBAR ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar"> 
            <!-- ================================== TOP NAVIGATION ================================== -->
            <div class="breadcrumb">
                <div class="container">
                    <div class="breadcrumb-inner">
                        <ul class="list-inline list-unstyled">
                            <li><a href="./">Home</a></li>
                            <li><a href="products-categories.php?category_name=<?php echo $category_name ?>"> Categories</a></li>
                            <li class='active'><?php echo $category_name ?></li>
                        </ul>
                    </div><!-- /.breadcrumb-inner -->
                </div><!-- /.container -->
            </div><!-- /.breadcrumb -->
            <div class="sidebar-widget outer-bottom-small wow fadeInUp">
                <h3 class="section-title">New Arrivals</h3>
                <div class="sidebar-widget-body outer-top-xs">
                    <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
                        <div class="item">
                            <div class="products special-product">
                                <?php 
                                foreach($productDetails->getAllTheProductsSideBarSpecialTwo() as $sideProduct){
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
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> 
                                                            <a href="product-detail.php?product_number=<?php echo $product_number ?>"> <img src="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" "> </a> 
                                                        </div>
                                                            <!-- /.image --> 
                                                    </div>
                                                  <!-- /.product-image --> 
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name">
                                                            <a href="product-detail.php?product_number=<?php echo $product_number ?>">
                                                                <?php echo $ragzProduct['product_name']; ?>
                                                            </a>
                                                        </h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description">
                                                            <?php while($see = $gettingManu->fetch()){ echo $see['manufacturer_name']; } ?>
                                                        </div>
                                                        <div class="product-price"> 
                                                            <span class="price" style="color: green"> <?php 
                                                                $num2= (20/100)*$ragzProductDetails['product_price'];
                                                                $adding = $num2 + $ragzProductDetails['product_price'];
                                                                number_format($ragzProductDetails['product_price']); ?> 
                                                                 &#8358;<?php echo number_format($adding) ?> </span> 
                                                            <span class="price-before-discount" style="color: red"><?php
                                                                $num3= (40/100)*$ragzProductDetails['product_price'];
                                                                $adding2 = $num3 + $ragzProductDetails['product_price'];
                                                                number_format($ragzProductDetails['product_price']); ?> 
                                                                 &#8358;<?php echo number_format($adding2) ?>
                                                            </span> 
                                                        </div>
                                                    </div><!-- /.product-price --> 
                                                </div>

                                                <!-- /.col --> 
                                            </div>
                                            <!-- /.product-micro-row --> 
                                        </div>
                                        <!-- /.product-micro --> 
                                    </div><?php 
                                } ?>
                                
                            </div>
                        </div>
                        <div class="item">
                            <div class="products special-product">
                                <?php 
                                foreach($productDetails->getAllTheProductsSideBarSpecialThree() as $sideProduct){
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
                                    <div class="product">
                                        <div class="product-micro">
                                            <div class="row product-micro-row">
                                                <div class="col col-xs-5">
                                                    <div class="product-image">
                                                        <div class="image"> 
                                                            <a href="product-detail.php?product_number=<?php echo $product_number ?>"> <img src="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" "> </a> 
                                                        </div>
                                                            <!-- /.image --> 
                                                    </div>
                                                  <!-- /.product-image --> 
                                                </div>
                                                <!-- /.col -->
                                                <div class="col col-xs-7">
                                                    <div class="product-info">
                                                        <h3 class="name">
                                                            <a href="product-detail.php?product_number=<?php echo $product_number ?>">
                                                                <?php echo $ragzProduct['product_name']; ?>
                                                            </a>
                                                        </h3>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description">
                                                            <?php while($see = $gettingManu->fetch()){ echo $see['manufacturer_name']; } ?>
                                                        </div>
                                                        <div class="product-price"> 
                                                            <span class="price" style="color: green"> <?php 
                                                                $num2= (20/100)*$ragzProductDetails['product_price'];
                                                                $adding = $num2 + $ragzProductDetails['product_price'];
                                                                number_format($ragzProductDetails['product_price']); ?> 
                                                                 &#8358;<?php echo number_format($adding) ?> </span> 
                                                            <span class="price-before-discount" style="color: red"><?php
                                                                $num3= (40/100)*$ragzProductDetails['product_price'];
                                                                $adding2 = $num3 + $ragzProductDetails['product_price'];
                                                                number_format($ragzProductDetails['product_price']); ?> 
                                                                 &#8358;<?php echo number_format($adding2) ?>
                                                            </span> 
                                                        </div>
                                                    </div><!-- /.product-price --> 
                                                </div>
                                                <!-- /.col --> 
                                            </div>
                                            <!-- /.product-micro-row --> 
                                        </div>
                                        <!-- /.product-micro --> 
                                    </div><?php 
                                } ?></div>
                            </div>
                            <div class="item">
                                <div class="products special-product">
                                    <?php 
                                    foreach($productDetails->getAllTheProductsSideBarSpecial() as $sideProduct){
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
                                        <div class="product">
                                            <div class="product-micro">
                                                <div class="row product-micro-row">
                                                    <div class="col col-xs-5">
                                                        <div class="product-image">
                                                            <div class="image"> 
                                                                <a href="product-detail.php?product_number=<?php echo $product_number ?>"> <img src="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" "> </a> 
                                                            </div>
                                                                <!-- /.image --> 
                                                        </div>
                                                      <!-- /.product-image --> 
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-xs-7">
                                                        <div class="product-info">
                                                            <h3 class="name">
                                                                <a href="product-detail.php?product_number=<?php echo $product_number ?>">
                                                                    <?php echo $ragzProduct['product_name']; ?>
                                                                </a>
                                                            </h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="description">
                                                                <?php while($see = $gettingManu->fetch()){ echo $see['manufacturer_name']; } ?>
                                                            </div>
                                                            <div class="product-price"> 
                                                                <span class="price" style="color: green"> <?php 
                                                                    $num = (5/100)*$ragzProductDetails['product_price'] + $ragzProductDetails['product_price'];
                                                                    $num2= (20/100)*$ragzProductDetails['product_price'];
                                                                    $adding = $num2 + $ragzProductDetails['product_price'];
                                                                    number_format($ragzProductDetails['product_price']); ?> 
                                                                     &#8358;<?php echo number_format($adding) ?> </span> 
                                                                <span class="price-before-discount" style="color: red"><?php
                                                                    $num3= (40/100)*$ragzProductDetails['product_price'];
                                                                    $adding2 = $num3 + $ragzProductDetails['product_price'];
                                                                    number_format($ragzProductDetails['product_price']); ?> 
                                                                     &#8358;<?php echo number_format($adding2) ?>
                                                                </span> 
                                                            </div>
                                                        </div><!-- /.product-price --> 
                                                    </div>
                                                    <!-- /.col --> 
                                                </div>
                                                <!-- /.product-micro-row --> 
                                            </div>
                                            <!-- /.product-micro --> 
                                        </div><?php 
                                    } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.sidebar-widget-body --> 
                    </div>

            
                    <div class="sidebar-widget product-tag wow fadeInUp">
                        <h3 class="section-title">Product tags</h3>
                        <div class="sidebar-widget-body outer-top-xs">
                            <div class="tag-list"> 
                                <?php
                                $cate = $db->prepare("SELECT * FROM product_type ORDER BY type_id desc  LIMIT 0,15");
                                $cate->execute();
                                while($see_cate = $cate->fetch()){?>
                                    <a class="item" href="products-types.php?type_name=<?php echo $see_cate['type_name'] ?>" name="<?php echo $see_cate['type_name'] ?>"><?php echo $see_cate['type_name'] ?> </a><?php
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
                            <h3><p style="color: red" align="center">No Product is Found for <?php echo $category_name ?> Categories</p></h3>
                        </div>
                    </div>  <?php 
                } else{ ?>         
                    <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                        <div class="more-info-tab clearfix ">
                            <h3 class="new-product-title pull-left">Products in <?php echo $category_name ?> Categories </h3>
                            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                                <li class="active"><a href="./">All</a></li>
                                <li class="active"><a href="products-categories.php?category_name=<?php echo $category_name ?> " ><?php echo $category_name ?></a>
                                </li><?php 
                                $cate = $db->prepare("SELECT * FROM products_category WHERE category_name !=:category_name ORDER BY category_id DESC LIMIT 0,5");
                                $arr = array(':category_name'=>$category_name);
                                $cate->execute($arr);
                                while($see_cate = $cate->fetch()){?>
                                    <li>
                                        <a href="products-categories.php?category_name=<?php echo $see_cate['category_name'] ?> ">
                                            <?php echo $see_cate['category_name'] ?> 
                                        </a> 
                                    </li><?php
                                } ?>    
                            </ul>
                            <!-- /.nav-tabs --> 
            
                            <div class="col col-sm-6 col-md-12 text-right">
                                <div class="pagination-container">
                                    <?php 
                                    if($totalItems > 3){ ?>
                                        <ul class="list-inline list-unstyled">
                                            <?php $b = $page - 1;
                                              if($page != 1){ ?>
                                                  <li class="prev"><a href="products-categories.php?category_name=<?php echo $category_name ?>&&page=<?php echo $page - 1?>"><i class="fa fa-angle-left"></i></a></li>
                                            <?php } ?>

                                            <?php if($page != $totalPages){ ?>
                                                  <li class="next"><a href="products-categories.php?category_name=<?php echo $category_name ?>&&page=<?php echo $page + 1?>"><i class="fa fa-angle-right"></i></a></li>
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
                                                                            <li class="lnk wishlist"> 
                                                                                <a data-toggle="tooltip" class="add-to-cart" href="handlers/registration/addit.php?product_number=<?php echo $product_number?>&&action=<?php echo 'Wishlist' ?>" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> 
                                                                            </li>
                                                                            <li class="add-cart-button btn-group">
                                                                                <form action="handlers/cart/addToCart.php" method="get">
                                                                                    <input type="hidden" name="sizes" value="<?php echo $ragzProduct['product_size'] ?>">
                                                                                    <input type="hidden" name="product_price" value="<?php echo $ragzProductDetails['product_price'] ?>">
                                                                                    <input type="hidden" name="product_number" value="<?php echo $product_number; ?>">
                                                                                     <input type="hidden" name="name" value="<?php echo $ragzProduct['product_name']; ?>">
                                                                                    <input type="hidden" name="quantity" value="<?php echo 1 ?>">
                                                                                    <input type="hidden" name="return" value="<?php $_SERVER['REQUEST_URI'] ?>">

                                                                                    <button data-toggle="tooltip" class="btn btn-primary icon" type="submit" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </button>
                                                                                </form>
                                                                            </li>
                                                                            <li class="lnk"> 
                                                                                <a data-toggle="tooltip" class="add-to-cart" href="handlers/registration/addit.php?product_number=<?php echo $product_number?>&&action=<?php echo 'Compare' ?>" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> 
                                                                            </li>
                                                                        </ul>
                                                                    </div>
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
        </div>

    </div>
</div>
<?php
    include("includes/footer.php"); 
?>