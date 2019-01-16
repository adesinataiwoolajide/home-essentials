<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder"> 
        <!-- ========================================== SECTION – HERO ========================================= -->
        
    <div id="hero">
        <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
            <div class="item" style="background-image: url(assets/images/sliders/cas.jpg);">
                <div class="container-fluid">
                    <div class="caption bg-color vertical-center text-left">
                        <div class="slider-header fadeInDown-1" style="color: white">Top Brands</div>
                        <div class="big-text fadeInDown-1" style="color: white"> New Collections </div>
                        <div class="excerpt fadeInDown-2 hidden-xs" style="color: white"> 
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                        </div>
                        <div class="button-holder fadeInDown-3"> 
                            <a href="index6c11.html?page=single-product" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a>
                        </div>
                    </div>
                    <!-- /.caption --> 
                </div>
              <!-- /.container-fluid --> 
            </div>

            <div class="item" style="background-image: url(assets/images/sliders/newwatch.jpg);">
                <div class="container-fluid">
                    <div class="caption bg-color vertical-center text-left">
                        <div class="slider-header fadeInDown-1" style="color: white">Spring 2016</div>
                        <div class="big-text fadeInDown-1" style="color: white"> Women <span class="highlight">Fashion</span> </div>
                        <div class="excerpt fadeInDown-2 hidden-xs" style="color: white"> <span>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit</span> 
                        </div>
                        <div class="button-holder fadeInDown-3"> <a href="index6c11.html?page=single-product" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a> </div>
                    </div>
                    <!-- /.caption --> 
                </div>
              <!-- /.container-fluid --> 
            </div> 

            <div class="item" style="background-image: url(assets/images/sliders/home-appliances.png);">
                <div class="container-fluid">
                    <div class="caption bg-color vertical-center text-left">
                        <div class="slider-header fadeInDown-1">Top Brands</div>
                        <div class="big-text fadeInDown-1"> New Collections </div>
                        <div class="excerpt fadeInDown-2 hidden-xs"> 
                            <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</span>
                        </div>
                        <div class="button-holder fadeInDown-3"> 
                            <a href="index6c11.html?page=single-product" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a>
                        </div>
                    </div>
                    <!-- /.caption --> 
                </div>
              <!-- /.container-fluid --> 
            </div>
            <!-- /.item -->
            
            <div class="item" style="background-image: url(assets/images/sliders/new_shorts_news_story_pic_2018.png);">
                <div class="container-fluid">
                    <div class="caption bg-color vertical-center text-left">
                        <div class="slider-header fadeInDown-1">Spring 2016</div>
                        <div class="big-text fadeInDown-1"> Women <span class="highlight">Fashion</span> </div>
                        <div class="excerpt fadeInDown-2 hidden-xs"> <span>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit</span> 
                        </div>
                        <div class="button-holder fadeInDown-3"> <a href="index6c11.html?page=single-product" class="btn-lg btn btn-uppercase btn-primary shop-now-button">Shop Now</a> </div>
                    </div>
                    <!-- /.caption --> 
                </div>
              <!-- /.container-fluid --> 
            </div>
            
            <!-- /.item --> 
        </div>
          <!-- /.owl-carousel --> 
    </div>

    <div class="info-boxes wow fadeInUp">
        <div class="info-boxes-inner">
            <div class="row">
                <div class="col-md-6 col-sm-4 col-lg-4">
                    <div class="info-box">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4 class="info-box-heading green">money back</h4>
                            </div>
                        </div>
                        <h6 class="text">30 Days Money Back Guarantee</h6>
                    </div>
                </div>
               <!-- .col -->
                <div class="hidden-md col-sm-4 col-lg-4">
                    <div class="info-box">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4 class="info-box-heading green">free shipping</h4>
                            </div>
                        </div>
                        <h6 class="text">Shipping on orders over &#8358;<?php echo number_format(15000) ?></h6>
                    </div>
                </div>
               <!-- .col -->
                <div class="col-md-6 col-sm-4 col-lg-4">
                    <div class="info-box">
                        <div class="row">
                            <div class="col-xs-12">
                                <h4 class="info-box-heading green">Special Sale</h4>
                            </div>
                        </div>
                        <h6 class="text">Extra $5 off on all items </h6>
                    </div>
                </div>
              <!-- .col --> 
            </div>
            <!-- /.row --> 
        </div>
        <!-- /.info-boxes-inner -->  
    </div>

        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
            <div class="more-info-tab clearfix ">
                <h3 class="new-product-title pull-left">New Products</h3>
                <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                    <li class="active"><a href="./">All</a></li><?php 
                    $cate = $db->prepare("SELECT * FROM products_category ORDER BY category_id desc LIMIT 0,7");
                    $cate->execute();
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
                        if($totalItems > 11){ ?>
                            <ul class="list-inline list-unstyled">
                                <?php $b = $page - 1;
                                  if($page != 1){ ?>
                                      <li class="prev"><a href="index.php?page=<?php echo $page - 1?>"><i class="fa fa-angle-left">Previous</i></a></li>
                                <?php } ?>
                                <?php if($page != $totalPages){ ?>
                                      <li class="next"><a href="index.php?page=<?php echo $page + 1?>"><i class="fa fa-angle-right">Next</i></a></li>
                                <?php } ?>                                        
                            </ul><?php 
                        } ?>
                        <!-- /.list-inline --> 
                    </div>
            
                 <!-- /.col --> 
                </div>
            </div>
            <div class="tab-content outer-top-xs">
                <div id="myTabContent" class="tab-content category-list">
                    <div class="tab-pane active " id="grid-container">
                        <div class="category-product">
                            <div class="row"><?php
                            
                                foreach($listingProduct as $featureProduct){ 
                                    $product_number = $featureProduct['product_number'];
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
                        
                                                <div class="product-info text-center">
                                                    <h3 class="name"><a href="product-detail.php<?php echo '?product_number='.$sku?>"><?php echo $name = $ragzProduct['product_name']; ?></a></h3>
                                                    <div class="rating rateit-small">
                                                        
                                                    </div>
                                                    <div class="description">
                                                        <?php while($see = $gettingManu->fetch()){ echo $see['manufacturer_name']; } ?>
                                                    </div>
                                                    <div class="product-price"> 
                                                        <span class="price" style="color: green"><?php 
                                                            $num2= (20/100)*$ragzProductDetails['product_price'];
                                                            $adding = $num2 + $ragzProductDetails['product_price'];?> 
                                                            &#8358;<?php echo number_format($adding) ?>    
                                                         </span> 
                                                        <span class="price-before-discount" style="color: red"><?php
                                                            $num3= (40/100)*$ragzProductDetails['product_price'];
                                                            $adding2 = $num3 + $ragzProductDetails['product_price']; ?> 
                                                             &#8358;<?php echo number_format($adding2) ?>
                                                        </span> 
                                                    </div>
                                                  <!-- /.product-price --> 
                                                </div>
                                                
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="lnk wishlist"> 
                                                                <a data-toggle="tooltip" class="add-to-cart" href="handlers/registration/addit.php?product_number=<?php echo $product_number?>&&action=<?php echo 'Wishlist' ?>" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> 
                                                            </li>
                                                            <li class="add-cart-button btn-group">
                                                                <form action="handlers/cart/addToCart.php" method="get">
                                                                    <input type="hidden" name="sizes" value="<?php echo $ragzProduct['product_size'] ?>">
                                                                    <input type="hidden" name="product_price" value="<?php echo $num2 + $ragzProductDetails['product_price']; ?>">
                                                                    <input type="hidden" name="product_number" value="<?php echo $product_number; ?>">
                                                                     <input type="hidden" name="name" value="<?php echo $ragzProduct['product_name']; ?>">
                                                                    <input type="hidden" name="quantity" value="<?php echo 1 ?>">
                                                                    <input type="hidden" name="return" value="<?php $_SERVER['REQUEST_URI'] ?>">

                                                                    <button data-toggle="tooltip" class="btn btn-primary icon" type="submit" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </button>
                                                                </form>
                                                            </li>
                                                            <li class="lnk"> 
                                                                <a data-toggle="tooltip" class="add-to-cart" href="handlers/registration/addit.php?product_number=<?php echo $product_number?>&&action=<?php echo 'Compare' ?>" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> 
                                                                </a> 
                                                            </li>
                                                        </ul>
                                                    </div>
                                                      <!-- /.action --> 
                                                </div>
                                            </div>
                                            <!-- /.home-owl-carousel --> 
                                        </div>
                                          <!-- /.product-slider --> 
                                    </div>
                                    <?php 
                                } ?>
                                <!-- /.tab-pane --> 
                            </div>
                        </div>  
                    </div>
                    <!-- /.tab-content --> 
                </div>
            </div>
        </div>
        <div class="wide-banners wow fadeInUp outer-bottom-xs">
            <div class="row">
                <div class="col-md-7 col-sm-7">
                    <div class="wide-banner cnt-strip">
                        <div class="image"> <img class="img-responsive" src="assets/images/banners/1_5.jpg" alt=""> 
                        </div>
                    </div>
                    <!-- /.wide-banner --> 
                </div>
                <!-- /.col -->
                <div class="col-md-5 col-sm-5">
                    <div class="wide-banner cnt-strip">
                        <div class="image"> <img class="img-responsive" src="assets/images/banners/1_5.jpg" alt=""> 
                        </div>
                    </div>
                     <!-- /.wide-banner --> 
                </div>
                <!-- /.col --> 
            </div>
            <!-- /.row --> 
        </div>
        <!-- /.wide-banners --> 
        <section class="section featured-product wow fadeInUp">
            <h3 class="section-title">Featured products</h3>
                <div class="col col-sm-6 col-md-12 text-right">
                    <div class="pagination-container">
                            <ul class="list-inline list-unstyled">
                                <?php 
                                if($totalItems > 11){ ?>
                                    <ul class="list-inline list-unstyled">
                                        <?php $b = $page - 1;
                                          if($page != 1){ ?>
                                              <li class="prev"><a href="index.php?page=<?php echo $page - 1?>"><i class="fa fa-angle-left"></i></a></li>
                                        <?php } ?>

                                        <?php if($page != $totalPages){ ?>
                                              <li class="next"><a href="index.php?page=<?php echo $page + 1?>"><i class="fa fa-angle-right"></i></a></li>
                                        <?php } ?>                                        
                                    </ul><?php 
                                } ?>                                  
                            </ul>
                            <!-- /.list-inline --> 
                        </div>
                        
                        <!-- /.col --> 
                    </div>
                <div id="myTabContent" class="tab-content category-list">
                <div class="tab-pane active " id="grid-container">
                    <div class="category-product">
                        <div class="row"><?php
                            
                            foreach($bestProduct as $featureProduct){ 
                                $product_number = $featureProduct['product_number'];
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
                                
                                <div class="col-sm-6 col-md-3 wow fadeInUp">
                                    <div class="products">
                                        <div class="product">
                                            <div class="product-image">
                                                <div class="image"> 
                                                    <a href="product-detail.php<?php echo '?product_number='.$sku?>">
                                                    <img src="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" style="width: 150px; height: 150px;"></a> 
                                                </div>
                                                <!-- /.image -->                          
                                                <div class="tag new"><span>new</span>
                                                </div>
                                            </div>
                                            <!-- /.product-image -->
                    
                                            <div class="product-info text-center">
                                                <h3 class="name"><a href="product-detail.php<?php echo '?product_number='.$sku?>"><?php echo $ragzProduct['product_name']; ?></a></h3>
                                                <div class="rating rateit-small">
                                                    
                                                </div>
                                                <div class="description">
                                                        <?php while($see = $gettingManu->fetch()){ echo $see['manufacturer_name']; } ?>
                                                    </div>
                                                <div class="product-price"> 
                                                    <span class="price" style="color: green"><?php 
                                                        $num2= (20/100)*$ragzProductDetails['product_price'];
                                                        $adding = $num2 + $ragzProductDetails['product_price'];?> 
                                                        &#8358;<?php echo number_format($adding) ?>    
                                                     </span> 
                                                    <span class="price-before-discount" style="color: red"><?php
                                                        $num3= (40/100)*$ragzProductDetails['product_price'];
                                                        $adding2 = $num3 + $ragzProductDetails['product_price']; ?> 
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
                                                                <input type="hidden" name="product_price" value="<?php echo $adding ?>">
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
                                                  <!-- /.action --> 
                                            </div>
                                                <!-- /.cart --> 
                                        </div>
                                        <!-- /.home-owl-carousel --> 
                                    </div>
                                      <!-- /.product-slider --> 
                                </div><?php 
                            } ?>
                            <!-- /.tab-pane --> 
                            
                        </div>  
                    </div>
                    <!-- /.tab-content --> 
                </div>
            </div>
        </div>
        
    </section>
     <script>
        let cartToCartButtons = document.querySelectorAll(".cartbutton");
        console.log(cartToCartButtons);
        cartToCartButtons.forEach(function(cartbutton){
                cartbutton.addEventListener("click", (e) => {
                let currentCartButton = e.target;
                let productnumber = currentCartButton.getAttribute("data-id");
                let name = currentCartButton.getAttribute("data-name");
                let product_price = currentCartButton.getAttribute("data-price");
                let quantity = currentCartButton.getAttribute("data-quantity");
                let url = `handlers/cart/addToCart.php?productnumber=${productnumber}&name=${name}&product_price=${product_price}&quantity=${quantity}`;
                let cqty = currentCartButton.getAttribute("data-quantity");
                let xhr = new XMLHttpRequest();
                xhr.open("GET", url, true);
                xhr.onload = (e) => {
                    if(xhr.status === 200){
                        let currentQtyVal = parseInt(document.querySelector("#cqty").textContent);
                        document.querySelector("#cqty").textContent = currentQtyVal + parseInt(quantity);
                        alert("You Have <?php echo $name ?> To Your Shopping Cart Successfully");
                    }
                }
                xhr.send();  

            });
            
        });

    </script> 
    
    <!-- ============================================== FEATURED PRODUCTS : END ============================================== -->    
</div>
  <!-- /.homebanner-holder --> 
  <!-- ============================================== CONTENT : END ============================================== --> 
</div>