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
            $category_name = $cateDetails['category_name'];
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
                    <div class="product-info text-center m-t-20" >
                        <h3 class="name">
                            <a href="product-detail.php?product_number=<?php echo $product_number ?>">
                                <?php echo $ragzProduct['product_name']; ?>
                                
                            </a>
                        </h3>
                        <div class="rating rateit-small" >
                            
                        </div>
                        <div class="description">
                            <?php while($see = $gettingManu->fetch()){ echo $see['manufacturer_name']; } ?>
                        </div>
                        <div class="product-price"> 
                            <span class="price" style="color: green"> <?php 
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
                   
                    <div class="col-md-12" align="center"> 
                        <form action="handlers/cart/addToCart.php" method="get">
                            <input type="hidden" name="sizes" value="<?php echo $ragzProductDetails['product_size'] ?>">
                            <input type="hidden" name="product_price" value="<?php echo $adding ?>">
                            <input type="hidden" name="product_number" value="<?php echo $product_number; ?>">
                             <input type="hidden" name="name" value="<?php echo $ragzProduct['product_name']; ?>">
                            <input type="hidden" name="quantity" value="<?php echo 1 ?>">
                            <input type="hidden" name="return" value="<?php $_SERVER['REQUEST_URI'] ?>">
                            <a data-toggle="tooltip" class="btn btn-danger" href="handlers/registration/addit.php?product_number=<?php echo $product_number?>&&action=<?php echo 'Wishlist' ?>" title="Wishlist"> <i class="icon fa fa-heart"></i>  </a> 

                            <button data-toggle="tooltip" class="btn btn-primary icon" type="submit" title="Add Cart"> <i class="fa fa-shopping-cart"></i>  </button>

                            <a data-toggle="tooltip" class="btn btn-danger" href="handlers/registration/addit.php?product_number=<?php echo $product_number?>&&action=<?php echo 'Wishlist' ?>" title="Compare"> <i class="icon fa fa-signal"></i>  </a> 
                        </form> 
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
            $cate = $db->prepare("SELECT * FROM product_type ORDER BY type_name asc  LIMIT 0,20");
            $cate->execute();
            while($see_cate = $cate->fetch()){?>
                <a class="item" href="products-types.php?type_name=<?php echo $see_cate['type_name'] ?>" name="<?php echo $see_cate['type_name'] ?>"><?php echo $see_cate['type_name'] ?> </a><?php
            } ?>
        </div>
        <!-- /.tag-list --> 
    </div>
    <!-- /.sidebar-widget-body --> 
</div>     
<div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title">Special Offer</h3>
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
                        $category_name = $cateDetails['category_name'];
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
                        $category_name = $cateDetails['category_name'];
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
                            $category_name = $cateDetails['category_name'];
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
        
        <!-- ============================================== NEWSLETTER ============================================== -->
        <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
            <h3 class="section-title">Newsletters</h3>
            <div class="sidebar-widget-body outer-top-xs">
                <p>Sign Up for Our Newsletter!</p>
                <form>
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
                    </div>
                    <button class="btn btn-primary">Subscribe</button>
                </form>
            </div>
            <!-- /.sidebar-widget-body --> 
        </div>
        
        <!-- ============================================== Testimonials============================================== -->
        <div class="sidebar-widget  wow fadeInUp outer-top-vs ">
            <div id="advertisement" class="advertisement">
                <div class="item">
                    <div class="avatar">
                        <img src="assets/images/testimonials/member1.png" alt="Image">
                    </div>
                    <div class="testimonials">
                        <em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.
                        <em>"</em>
                    </div>
                    <div class="clients_author">John Doe <span>Abc Company</span> 
                    </div>
                      <!-- /.container-fluid --> 
                </div>
                <!-- /.item -->
                <div class="item">
                    <div class="avatar"><img src="assets/images/testimonials/member3.png" alt="Image"></div>
                    <div class="testimonials"><em>"</em>Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                    <div class="clients_author">Stephen Doe <span>Xperia Designs</span> </div>
                </div>
                <!-- /.item -->
                <div class="item">
                    <div class="avatar"><img src="assets/images/testimonials/member2.png" alt="Image"></div>
                    <div class="testimonials"><em>"</em> Vtae sodales aliq uam morbi non sem lacus port mollis. Nunc condime tum metus eud molest sed consectetuer.<em>"</em></div>
                    <div class="clients_author">Saraha Smith <span>Datsun &amp; Co</span> </div>
                  <!-- /.container-fluid --> 
                </div>
                <!-- /.item --> 
            </div>
          <!-- /.owl-carousel --> 
        </div>
        
        <div class="home-banner"> 
            <img src="assets/images/banners/LHS-banner.jpg" alt="Image"> 
        </div>
        <div class="sidebar-widget newsletter wow fadeInUp outer-bottom-small">
            <h3 class="section-title">Newsletters</h3>
            <div class="sidebar-widget-body outer-top-xs">
                <p>Sign Up for Our Newsletter!</p>
                <form>
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Subscribe to our newsletter">
                    </div>
                    <button class="btn btn-primary">Subscribe</button>
                </form>
            </div>
            <!-- /.sidebar-widget-body --> 
        </div>

    </div>