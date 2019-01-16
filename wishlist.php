<?php
require_once("includes/session.php");
include("includes/authenticate.php");
include("connection/db_connection.php");
include("dev/account/functions.php");
include("dev/wishlist/functions.php");
include("dev/product/functions.php");
$getWishlists = fetchWishlists($buyer_id);
$countWishlists = count($getWishlists);

//current page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

//products per page
$products_per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 12;

//start page
$start = $page > 1 ? ($page * $products_per_page) - $products_per_page : 0;

//total pages
$total_pages = ceil($countWishlists / $products_per_page);

//get paginated products
$getWishlistedProducts = getPaginatedWishlist($buyer_id, $start, $products_per_page);

$pagetitle = "Wishlists";
include("includes/header.php");
?>

<div class="breadcrumb">
  <div class="container">
    <div class="breadcrumb-inner">
      <ul class="list-inline list-unstyled">
        <li><a href="#">Home</a></li>
        <li class='active'>Handbags</li>
      </ul>
    </div>
    <!-- /.breadcrumb-inner --> 
  </div>
  <!-- /.container --> 
</div>
<!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
  <div class='container'>
    <div class='row'>
      <div class='col-md-3 sidebar'> 
        <!-- ================================== TOP NAVIGATION ================================== -->
        <?php include("includes/category-sidebar.php");?>
        <!-- /.side-menu --> 
        <!-- ================================== TOP NAVIGATION : END ================================== -->
        <div class="sidebar-module-container">
          <div class="sidebar-filter"> 
            <!-- ============================================== SIDEBAR CATEGORY ============================================== -->
            <div class="sidebar-widget wow fadeInUp">
              <h3 class="section-title">shop by</h3>
              <div class="widget-header">
                <h4 class="widget-title">Category</h4>
              </div>
              <div class="sidebar-widget-body">
                <div class="accordion">
                  <div class="accordion-group">
                    <div class="accordion-heading"> <a href="#collapseOne" data-toggle="collapse" class="accordion-toggle collapsed"> Camera </a> </div>
                    <!-- /.accordion-heading -->
                    <div class="accordion-body collapse" id="collapseOne" style="height: 0px;">
                      <div class="accordion-inner">
                        <ul>
                          <li><a href="#">gaming</a></li>
                          <li><a href="#">office</a></li>
                          <li><a href="#">kids</a></li>
                          <li><a href="#">for women</a></li>
                        </ul>
                      </div>
                      <!-- /.accordion-inner --> 
                    </div>
                    <!-- /.accordion-body --> 
                  </div>
                  <!-- /.accordion-group -->
                  
                  <div class="accordion-group">
                    <div class="accordion-heading"> <a href="#collapseTwo" data-toggle="collapse" class="accordion-toggle collapsed"> Desktops </a> </div>
                    <!-- /.accordion-heading -->
                    <div class="accordion-body collapse" id="collapseTwo" style="height: 0px;">
                      <div class="accordion-inner">
                        <ul>
                          <li><a href="#">gaming</a></li>
                          <li><a href="#">office</a></li>
                          <li><a href="#">kids</a></li>
                          <li><a href="#">for women</a></li>
                        </ul>
                      </div>
                      <!-- /.accordion-inner --> 
                    </div>
                    <!-- /.accordion-body --> 
                  </div>
                  <!-- /.accordion-group -->
                  
                  <div class="accordion-group">
                    <div class="accordion-heading"> <a href="#collapseThree" data-toggle="collapse" class="accordion-toggle collapsed"> Pants </a> </div>
                    <!-- /.accordion-heading -->
                    <div class="accordion-body collapse" id="collapseThree" style="height: 0px;">
                      <div class="accordion-inner">
                        <ul>
                          <li><a href="#">gaming</a></li>
                          <li><a href="#">office</a></li>
                          <li><a href="#">kids</a></li>
                          <li><a href="#">for women</a></li>
                        </ul>
                      </div>
                      <!-- /.accordion-inner --> 
                    </div>
                    <!-- /.accordion-body --> 
                  </div>
                  <!-- /.accordion-group -->
                  
                  <div class="accordion-group">
                    <div class="accordion-heading"> <a href="#collapseFour" data-toggle="collapse" class="accordion-toggle collapsed"> Bags </a> </div>
                    <!-- /.accordion-heading -->
                    <div class="accordion-body collapse" id="collapseFour" style="height: 0px;">
                      <div class="accordion-inner">
                        <ul>
                          <li><a href="#">gaming</a></li>
                          <li><a href="#">office</a></li>
                          <li><a href="#">kids</a></li>
                          <li><a href="#">for women</a></li>
                        </ul>
                      </div>
                      <!-- /.accordion-inner --> 
                    </div>
                    <!-- /.accordion-body --> 
                  </div>
                  <!-- /.accordion-group -->
                  
                  <div class="accordion-group">
                    <div class="accordion-heading"> <a href="#collapseFive" data-toggle="collapse" class="accordion-toggle collapsed"> Hats </a> </div>
                    <!-- /.accordion-heading -->
                    <div class="accordion-body collapse" id="collapseFive" style="height: 0px;">
                      <div class="accordion-inner">
                        <ul>
                          <li><a href="#">gaming</a></li>
                          <li><a href="#">office</a></li>
                          <li><a href="#">kids</a></li>
                          <li><a href="#">for women</a></li>
                        </ul>
                      </div>
                      <!-- /.accordion-inner --> 
                    </div>
                    <!-- /.accordion-body --> 
                  </div>
                  <!-- /.accordion-group -->
                  
                  <div class="accordion-group">
                    <div class="accordion-heading"> <a href="#collapseSix" data-toggle="collapse" class="accordion-toggle collapsed"> Accessories </a> </div>
                    <!-- /.accordion-heading -->
                    <div class="accordion-body collapse" id="collapseSix" style="height: 0px;">
                      <div class="accordion-inner">
                        <ul>
                          <li><a href="#">gaming</a></li>
                          <li><a href="#">office</a></li>
                          <li><a href="#">kids</a></li>
                          <li><a href="#">for women</a></li>
                        </ul>
                      </div>
                      <!-- /.accordion-inner --> 
                    </div>
                    <!-- /.accordion-body --> 
                  </div>
                  <!-- /.accordion-group --> 
                  
                </div>
                <!-- /.accordion --> 
              </div>
              <!-- /.sidebar-widget-body --> 
            </div>
            <!-- /.sidebar-widget --> 
            <!-- ============================================== SIDEBAR CATEGORY : END ============================================== --> 
            
            <!-- ============================================== PRICE SILDER============================================== -->
            <div class="sidebar-widget wow fadeInUp">
              <div class="widget-header">
                <h4 class="widget-title">Price Slider</h4>
              </div>
              <div class="sidebar-widget-body m-t-10">
                <div class="price-range-holder"> <span class="min-max"> <span class="pull-left">$200.00</span> <span class="pull-right">$800.00</span> </span>
                  <input type="text" id="amount" style="border:0; color:#666666; font-weight:bold;text-align:center;">
                  <input type="text" class="price-slider" value="" >
                </div>
                <!-- /.price-range-holder --> 
                <a href="#" class="lnk btn btn-primary">Show Now</a> </div>
              <!-- /.sidebar-widget-body --> 
            </div>
            <!-- /.sidebar-widget --> 
            <!-- ============================================== COMPARE============================================== -->
            <div class="sidebar-widget wow fadeInUp outer-top-vs">
              <h3 class="section-title">Compare products</h3>
              <div class="sidebar-widget-body">
                <div class="compare-report">
                  <p>You have no <span>item(s)</span> to compare</p>
                </div>
                <!-- /.compare-report --> 
              </div>
              <!-- /.sidebar-widget-body --> 
            </div>
            <!-- /.sidebar-widget --> 
            <!-- ============================================== COMPARE: END ============================================== --> 
            <!-- ============================================== PRODUCT TAGS ============================================== -->
            <div class="sidebar-widget product-tag wow fadeInUp outer-top-vs">
              <h3 class="section-title">Product tags</h3>
              <div class="sidebar-widget-body outer-top-xs">
                <div class="tag-list"> <a class="item" title="Phone" href="category.html">Phone</a> <a class="item active" title="Vest" href="category.html">Vest</a> <a class="item" title="Smartphone" href="category.html">Smartphone</a> <a class="item" title="Furniture" href="category.html">Furniture</a> <a class="item" title="T-shirt" href="category.html">T-shirt</a> <a class="item" title="Sweatpants" href="category.html">Sweatpants</a> <a class="item" title="Sneaker" href="category.html">Sneaker</a> <a class="item" title="Toys" href="category.html">Toys</a> <a class="item" title="Rose" href="category.html">Rose</a> </div>
                <!-- /.tag-list --> 
              </div>
              <!-- /.sidebar-widget-body --> 
            </div>
            <!-- /.sidebar-widget --> 
          
            <div class="home-banner"> <img src="assets/images/banners/LHS-banner.jpg" alt="Image"> </div>
          </div>
          <!-- /.sidebar-filter --> 
        </div>
        <!-- /.sidebar-module-container --> 
      </div>
      <!-- /.sidebar -->
      <div class='col-md-9'> 
        <!-- ========================================== SECTION – HERO ========================================= -->

        
     
        <div class="clearfix filters-container m-t-10">
          <div class="row">
            <!-- /.col -->
            <div class="col col-sm-12 col-md-8">
              <div class="col col-sm-3 col-md-6 no-padding">
                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                  <div class="fld inline">
                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> Position <span class="caret"></span> </button>
                      <ul role="menu" class="dropdown-menu">
                        <li role="presentation"><a href="#">position</a></li>
                        <li role="presentation"><a href="#">Price:Lowest first</a></li>
                        <li role="presentation"><a href="#">Price:HIghest first</a></li>
                        <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.fld --> 
                </div>
                <!-- /.lbl-cnt --> 
              </div>
              <!-- /.col -->
              <div class="col col-sm-3 col-md-6 no-padding">
                <div class="lbl-cnt"> <span class="lbl">Show</span>
                  <div class="fld inline">
                    <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                      <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> SELECT <span class="caret"></span> </button>
                      <ul role="menu" class="dropdown-menu">
                          <li role="presentation"><a href="category.php?category=<?php echo $categoryId;?>&&page=<?php echo $page?>&&per_page=12" onchange="window.location=this.href">12</a></li>
                          <li role="presentation"><a href="category.php?category=<?php echo $categoryId;?>&&page=<?php echo $page?>&&per_page=24" onchange="window.location=this.href">24</a></li>
                          <li role="presentation"><a href="category.php?category=<?php echo $categoryId;?>&&page=<?php echo $page?>&&per_page=36" onchange="window.location=this.href">36</a></li>
                      </ul>
                    </div>
                  </div>
                  <!-- /.fld --> 
                </div>
                <!-- /.lbl-cnt --> 
              </div>
              <!-- /.col --> 
            </div>
            <!-- /.col -->
            <div class="col col-sm-6 col-md-4 text-right">
              <div class="pagination-container">
                <ul class="list-inline list-unstyled">
                    <?php $b = $page - 1;
                      if($page != 1){ ?>
                          <li class="prev"><a href="category.php?page=<?php echo $b;?>"><i class="fa fa-angle-left"></i></a></li>
                    <?php } ?>

                    <?php $a = $page + 1;
                        if($page != $total_pages){ ?>
                          <li class="next"><a href="category.php?page=<?php echo $a;?>"><i class="fa fa-angle-right"></i></a></li>
                    <?php } ?>                                        
                </ul>
                <!-- /.list-inline --> 
              </div>
              <!-- /.pagination-container --> </div>
            <!-- /.col --> 
          </div>
          <!-- /.row --> 
        </div>
        <div class="search-result-container ">
          <div id="myTabContent" class="tab-content category-list">
            <div class="tab-pane active " id="grid-container">
              <div class="category-product">
                <div class="row">

                  <?php foreach($getWishlistedProducts as $rowProducts){?>
                      <div class="col-sm-6 col-md-4 wow fadeInUp">
                        <div class="products">
                          <div class="product">
                            <div class="product-image">
                                <div class="image"> <a href="detail.php?sku=<?php echo $rowProducts['sku'];?>&&page=<?php echo $page;?>&&per_page=<?php echo $products_per_page;?>"><img  src="assets/images/products/p5.jpg" alt="">   </a> 
                                </div>
                            </div>

                            <div class="product-info text-left">
                              <h3 class="name"><a href="detail.php?sku=<?php echo $rowProducts['sku'];?>&&page=<?php echo $page;?>&&per_page=<?php echo $products_per_page;?>"><?php echo $rowProducts['name'];?></a></h3>
                              <div class="description"> <?php echo getStoreName($rowProducts['merchant_id']);?> </div>
                              <div class="product-price"> <span class="price" id="<?php echo $rowProducts['sku']?>" onload="return(formatPrice(this));"> <?php echo $rowProducts['wholesale_price'];?> / <?php echo $rowProducts['unit'];?> </span> <span class="price-before-discount">$ 800</span> </div>
                            </div>
                            
                            <div class="cart clearfix animate-effect">
                              <div class="action">
                                <ul class="list-unstyled">
                                  <li class="add-cart-button btn-group">
                                    <button class="btn btn-primary icon" data-toggle="dropdown" type="button"> <i class="fa fa-shopping-cart"></i> </button>
                                    <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                  </li>
                                  <li class="lnk wishlist"> <a class="add-to-cart" href="utils/wishlist/remove.php?id=<?php echo $rowProducts['id'];?>&&return=<?php echo $_SERVER['REQUEST_URI'];?>" title="Wishlist"> <i class="icon fa fa-trash"></i> </a> </li>
                                  <li class="lnk"> <a class="add-to-cart" href="detail.php?sku=<?php echo $rowProducts['sku'];?>&&page=<?php echo $page;?>&&per_page=<?php echo $products_per_page;?>" title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                                </ul>
                              </div>
                              <!-- /.action --> 
                            </div>
                          </div>  
                        </div>
                      </div>                        
                  <?php } ?>

                </div>
              </div>
            </div>

            <!-- /.tab-pane #list-container --> 
          </div>
          <!-- /.tab-content -->
          <div class="clearfix filters-container">
            <div class="text-right">
              <div class="pagination-container">
                <ul class="list-inline list-unstyled">
                    <?php $b = $page - 1;
                      if($page != 1){ ?>
                          <li class="prev"><a href="category.php?category=<?php echo $categoryId;?>&&page=<?php echo $b;?>"><i class="fa fa-angle-left"></i></a></li>
                    <?php } ?>

                    <?php $a = $page + 1;
                        if($page != $total_pages){ ?>
                          <li class="next"><a href="category.php?category=<?php echo $categoryId;?>&&page=<?php echo $a;?>"><i class="fa fa-angle-right"></i></a></li>
                    <?php } ?>                                        
                </ul>
                <!-- /.list-inline --> 
              </div>
              <!-- /.pagination-container --> </div>
            <!-- /.text-right --> 
            
          </div>
          <!-- /.filters-container --> 
          
        </div>
        <!-- /.search-result-container --> 
        
      </div>
      <!-- /.col --> 
    </div>
    <!-- /.row --> 
    <?php include("includes/footer.php");?>