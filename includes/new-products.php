<!-- ============================================== CONTENT ============================================== -->
<div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder"> 
    <!-- ========================================== SECTION – HERO ========================================= -->
    
    <div id="hero"> 
        <!-- ============================================== INFO BOXES : END ============================================== --> 
        <!-- ============================================== SCROLL TABS ============================================== -->
        <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
            <div class="more-info-tab clearfix ">
                <h3 class="new-product-title pull-left">New Products</h3>
            <ul class="nav nav-tabs nav-tab-line pull-right" id="new-products-1">
                <li class="active"><a data-transition-type="backSlide" href="#all" data-toggle="tab">All</a></li>
                <li class="active"><a href="smartphone.php" >Clothing</a></li>
                <li><a data-transition-type="backSlide" href="#laptop" data-toggle="tab">Electronics</a></li>
                <li><a data-transition-type="backSlide" href="#apple" data-toggle="tab">Shoes</a></li>
            </ul>
            <!-- /.nav-tabs --> 
        </div>
        <div class="tab-content outer-top-xs">
            <div id="myTabContent" class="tab-content category-list">
                <div class="tab-pane active " id="grid-container">
                    <div class="category-product">
                        <div class="row">
                            <?php
                               $select = $db->prepare("SELECT * FROM products ORDER BY date_modified DESC LIMIT 0,12  ");
                                $select->execute();
                                while($row = $select->fetch()){ 
                                     $sku = $row['sku']; ?>
                                    <div class="col-sm-6 col-md-4 wow fadeInUp">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image"><?php  
                                                    $sku = $row['sku'];
                                                    $select2 = $db->prepare("SELECT * FROM products_image WHERE sku=:sku ");
                                                    $arr = array(':sku'=>$sku);
                                                    $select2->execute($arr); 
                                                    $row1 = $select2->fetch();
                                                    $image = $row1['thumbnail_path'];
                                                        //print_r($row1);?>
                                                    <div class="image"> 
                                                        <a href="detail.php<?php echo '?id='.$sku?>">
                                                        <img src="<?php echo $image;?> " width="100" height="150px" alt=""></a> 
                                                    </div>
                                                    <!-- /.image -->                          
                                                    <div class="tag new"><span>new</span>
                                                    </div>
                                                </div>
                                                <!-- /.product-image -->
                        
                                                <div class="product-info text-left">
                                                    <h3 class="name"><a href="detail.php<?php echo '?id='.$sku?>"><?php echo $row['name']; ?></a></h3>
                                                    <div class="rating rateit-small">
                                                        
                                                    </div>
                                                    <div class="description">
                                                        description
                                                    </div>
                                                    <div class="product-price"> 
                                                        <span class="price">#<?php echo $row['wholesale_price']; ?> </span> <span class="price-before-discount">discount</span> 
                                                        </div>
                                                  <!-- /.product-price --> 
                                                </div>
                                                <!-- /.product-info -->
                                                <div class="cart clearfix animate-effect">
                                                    <div class="action">
                                                        <ul class="list-unstyled">
                                                            <li class="add-cart-button btn-group">
                                                                <button data-toggle="tooltip" class="btn btn-primary icon" type="button" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </button>
                                                                <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                                            </li>
                                                            <li class="lnk wishlist"> 
                                                                <a data-toggle="tooltip" class="add-to-cart" href="detail.php<?php echo '?id='.$sku?>" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> 
                                                            </li>
                                                            <li class="lnk"> 
                                                                <a data-toggle="tooltip" class="add-to-cart" href="detail.php<?php echo '?id='.$sku ?>" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> 
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
                    </div>
                    <!-- /.tab-content --> 
                </div>
            </div>
        </div>