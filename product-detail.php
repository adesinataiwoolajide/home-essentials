<?php 
	include("connection/connection.php");
	$product_number = $_GET['product_number'];
	$pagetitle = "Product Details";
	include("includes/header.php");
	$ragzProduct = $productDetails->getProductsDet($product_number);
    $ragzProductDetails = $productDetails->getProductsDetails($product_number);
    $category_id = $ragzProductDetails['category_id'];
    $cateDetails = $productsCate->getCategoryDetailsId($category_id);
    $category_name = $cateDetails['category_name'];
    $manufacturer_id = $ragzProduct['manufacturer_id'];
    $manuDetails = $productDetails->getRagzManufacturerDetails($manufacturer_id);
    $manufacturer_name = $manuDetails['manufacturer_name'];
    $totalItems =  count($productDetails->getAllProductsCategoryList($category_id));
    $itemsPerPage = 30;
    $page = isset($_GET['page']) ? ($_GET['page']) : 1;
    $start = $page > 1 ? ($page * $itemsPerPage) - $itemsPerPage : 0;
    $totalPages = ceil($totalItems / $itemsPerPage);
    $seeProdcut = $productDetails->getCategoryProductsDeta($category_id, $start, $itemsPerPage); ?>
<div class="breadcrumb">
	<div class="container">
		<div class="breadcrumb-inner">
			<ul class="list-inline list-unstyled">
				<li><a href="./">Home</a></li>
				<li><a href="product-detail.php?product_number=<?php echo $ragzProduct['product_number'] ?>"> Details</a></li>
				<li class='active'><?php echo $ragzProduct['product_name'] ?></li>
			</ul>
		</div><!-- /.breadcrumb-inner -->
	</div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row single-product'>
			<div class='col-md-3 sidebar'>
				<div class="sidebar-module-container">
					<div class="home-banner outer-top-n">
						<img src="assets/images/banners/LHS-banner.jpg" alt="Image" style="width: 265; height: 262px">
					</div>		
   
					<div class="sidebar-widget hot-deals wow fadeInUp outer-top-vs">
						<h3 class="section-title">hot deals</h3>
						<div class="owl-carousel sidebar-carousel custom-carousel owl-theme outer-top-xs"><?php
		
							foreach($productDetails->getAllTheProductsSideBar() as $sideProduct){
					            $product_number = $sideProduct['product_number'];
					            $ragzzProduct = $productDetails->getProductsDet($product_number);
					            $ragzzProductDetails = $productDetails->getProductsDetails($product_number);
					            $type_id = $ragzzProduct['type_id'];
					            $typeDe = $productsCate->getTypeDetailsId($type_id);
					            $category_id = $typeDe['category_id'];
					            $cateDetails = $productsCate->getCategoryDetailsId($category_id);
					            $category_name = $cateDetails['category_name'];
					            $manufacturer_id = $ragzzProduct['manufacturer_id'];
					            $gettingMan = $db->prepare("SELECT * FROM manufacturer WHERE manufacturer_id=:manufacturer_id");
					            $arr = array(':manufacturer_id'=>$manufacturer_id);
					            $gettingMan->execute($arr); 
					            $sku = $product_number; ?>
					            <div class="item">
					                <div class="products">
					                    <div class="hot-deal-wrapper">
					                        <div class="image"> 
					                            <img src="<?php echo "images/product/large-image/".$ragzzProduct['product_image'] ?>" ">
					                        </div>
					                    </div>
					                    <!-- /.hot-deal-wrapper -->
					                    <div class="product-info text-left m-t-20">
					                        <h3 class="name">
					                            <a href="product-detail.php?product_number=<?php echo $ragzzProduct['product_number'] ?>">
					                                <?php echo $ragzzProduct['product_name']; ?>
					                                
					                            </a>
					                        </h3>
					                        <div class="rating rateit-small">
					                            
					                        </div>
					                        <div class="description">
					                            <?php while($see = $gettingMan->fetch()){ echo $see['manufacturer_name']; } ?>
					                        </div>
					                        <div class="product-price"> 
					                            <span class="price" style="color: green"> <?php 
					                                $num2= (20/100)*$ragzzProductDetails['product_price'];
					                                $adding = $num2 + $ragzzProductDetails['product_price'];
					                                number_format($ragzzProductDetails['product_price']); ?> 
					                                 &#8358;<?php echo number_format($adding) ?> 
					                            </span> 
					                            <span class="price-before-discount" style="color: red"><?php
					                                $num3= (40/100)*$ragzzProductDetails['product_price'];
					                                $adding2 = $num3 + $ragzzProductDetails['product_price'];
					                                number_format($ragzzProductDetails['product_price']); ?> 
					                                 &#8358;<?php echo number_format($adding2) ?>
					                            </span> 
					                        </div>
					                        <!-- /.product-price -->  
					                    </div><!-- /.product-info -->
					                
					                     <div class="col-md-12" align="center"> 
					                        <form action="handlers/cart/addToCart.php" method="get">
					                            <input type="hidden" name="sizes" value="<?php echo $ragzzProduct['product_size'] ?>">
					                            <input type="hidden" name="product_price" value="<?php echo $adding ?>">
					                            <input type="hidden" name="product_number" value="<?php echo $ragzzProduct['product_number']; ?>">
					                             <input type="hidden" name="name" value="<?php echo $ragzzProduct['product_name']; ?>">
					                            <input type="hidden" name="quantity" value="<?php echo 1 ?>">
					                            <input type="hidden" name="return" value="<?php $_SERVER['REQUEST_URI'] ?>">
					                            <a data-toggle="tooltip" class="btn btn-danger" href="handlers/registration/addit.php?product_number=<?php echo $ragzzProduct['product_number']?>&&action=<?php echo 'Wishlist' ?>" title="Wishlist"> <i class="icon fa fa-heart"></i>  </a> 

					                            <button data-toggle="tooltip" class="btn btn-primary icon" type="submit" title="Add Cart"> <i class="fa fa-shopping-cart"></i>  </button>

					                            <a data-toggle="tooltip" class="btn btn-danger" href="handlers/registration/addit.php?product_number=<?php echo $ragzzProduct['product_number']?>&&action=<?php echo 'Wishlist' ?>" title="Compare"> <i class="icon fa fa-signal"></i>  </a> 
					                        </form> 
					                    </div>
					                    <!-- /.cart --> 
					                </div>
					            </div><?php 
					        } ?>
					    </div>
					</div>
				</div>
			</div><!-- /.sidebar -->
			<div class='col-md-9'>
	            <div class="detail-block">
					<div class="row  wow fadeInUp">
					    <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
						    <div class="product-item-holder size-big single-product-gallery small-gallery">
						    	
						        <div id="owl-single-product"><?php
						        	$image = "images/product/large-image/".$ragzProduct['product_image'];
						        	$thumb = "images/product/small-image/".$ragzProductDetails['product_thumbnail'];
						        	 ?>
						            <div class="single-product-gallery-item" id="slide1" align="center">
						                <a data-lightbox="image-1" data-title="Gallery" href="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" width="200" height="350px" >
						                    <img class="img-responsive" alt="" src="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" width="200" height="350px" data-echo="<?php echo "images/product/large-image/".$ragzProduct['product_image'] ?>" width="200" height="350px" align="center">
						                </a>
						            </div><!-- /.single-product-gallery-item -->

						            <div class="single-product-gallery-item" id="slide2" align="center">
						                <a data-lightbox="image-1" data-title="Gallery" href="<?php echo $thumb ?>" width="100" height="150px" >
						                    <img class="img-responsive" alt="" src="<?php echo $thumb ?>" width="200" height="350px" data-echo="<?php echo $thumb ?>" width="200" height="350px" align="center">
						                </a>
						            </div><!-- /.single-product-gallery-item -->
						        </div><!-- /.single-product-slider -->

						        <div class="single-product-gallery-thumbs gallery-thumbs">

						            <div id="owl-single-product-thumbnails">
						                <div class="item">
						                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide1">
						                        <img class="img-responsive" width="85" alt="" src="<?php echo $image; ?>" data-echo="<?php echo $image; ?>" />
						                    </a>
						                </div>

						                <div class="item">
						                    <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="2" href="#slide2">
						                        <img class="img-responsive" width="100" alt="" src="<?php echo $thumb; ?>" data-echo="<?php echo $thumb; ?>"/>
						                    </a>
						                </div>
						                
						                 <div class="item">
						                    <a class="horizontal-thumb active" data-target="#owl-single-product" data-slide="1" href="#slide1">
						                        <img class="img-responsive" width="85" alt="" src="<?php echo $image; ?>" data-echo="<?php echo $image; ?>" />
						                    </a>
						                </div>

						                <div class="item">
						                    <a class="horizontal-thumb" data-target="#owl-single-product" data-slide="2" href="#slide2">
						                        <img class="img-responsive" width="100" alt="" src="<?php echo $thumb; ?>" data-echo="<?php echo $thumb; ?>"/>
						                    </a>
						                </div>
						            </div><!-- /#owl-single-product-thumbnails -->   

						        </div><!-- /.gallery-thumbs -->

    						</div><!-- /.single-product-gallery -->
						</div><!-- /.gallery-holder -->        			
						<div class='col-sm-6 col-md-7 product-info-block'>
							<div class="product-info">
								<h1 class="name"><?php echo $name= $ragzProduct['product_name'] ?></h1>
								
								<div class="rating-reviews m-t-20">
									<div class="row">
										<div class="col-sm-3">
											<div class="rating rateit-small"></div>
										</div>
										<div class="col-sm-8">
											<div class="reviews">
												<a href="#" class="lnk">(13 Reviews)</a>
											</div>
										</div>
									</div><!-- /.row -->		
								</div><!-- /.rating-reviews -->

								<div class="stock-container info-container m-t-10">
									<div class="row">
										<div class="col-sm-9">
											<div class="stock-box">
												<span class="label">Availability: 
													<strong><?php 
														$qty = $ragzProductDetails['quantity'];
														if($qty>0){ ?>
															In Stock <i class="fa fa-check-square-o" style="color: green"></i><?php
														}else{ ?>
															Out of Stock <i class="fa fa-bell-slash-o" style="color: red"></i><?php
														}?>	
													 </strong>
												</span>
											</div>	<br>
										</div><br>
										<div class="col-sm-9">
											<div class="stock-box">
												<span class="value">Quantity: <strong><?php echo $qty = $ragzProductDetails['quantity'] ?></strong></span>
											</div>	
										</div>
										<div class="col-sm-9">
											<?php $sizeArray = explode(",", $ragzProductDetails['product_size']);
                                            if(count($sizeArray)){ 
                                                if($sizeArray != "Null"){ ?>
                                                    <p>Sizes</p>
                                                    
                                                        <?php foreach($sizeArray as $size){?>
                                                           <li>
                                                           		<a class="item" title="<?php echo $size ?>" href="category.html"><?php echo $size; ?></a> 
                                                           </li> 
                                                        <?php }
                                                }else{ ?>
                                                    <p>Size: NULL </p>
                                                    <input type="text" name="product_size" value="<?php echo "NULL" ?>"><?php
                                                } 
                                            } ?>

										</div>
									</div><!-- /.row -->	
								</div><!-- /.stock-container -->

								<div class="description-container m-t-20">
									
								</div><!-- /.description-container -->

								<div class="price-container info-container m-t-20">
									<div class="row">
										
										<div class="col-sm-6">
											<div class="price-box">
												<span class="price" style="color: green"><?php 
                                                    $num = (5/100)*$ragzProductDetails['product_price'] + $ragzProductDetails['product_price'];
                                                    $num2= (20/100)*$ragzProductDetails['product_price'];
                                                    $adding = $num2 + $ragzProductDetails['product_price'];
                                                    number_format($ragzProductDetails['product_price']); ?> 
                                                     &#8358;<?php echo number_format($adding) ?></span>
												<span class="price-strike" style="color: red">
													<?php 
													$num3= (40/100)*$ragzProductDetails['product_price'];
													$adding2 = $num3 + $ragzProductDetails['product_price'];
                                                    ?> 
                                                     &#8358;<?php echo number_format($adding2) ?>
                                                     	
                                                </span>
											</div>
										</div>
									</div><!-- /.row -->
								</div><!-- /.price-container -->
								<div class="quantity-container info-container">
									<div class="row">
										 <form action="handlers/cart/addToCart.php" method="get">
											<div class="col-sm-12">
												<a data-toggle="tooltip" class="btn btn-danger" href="handlers/registration/addit.php?product_number=<?php echo $product_number?>&&action=<?php echo 'Wishlist' ?>" title="Wishlist"> <i class="icon fa fa-heart"></i> WISHLIST </a> 

	                                                <input type="hidden" name="sizes" value="<?php echo $ragzProductDetails['product_size'] ?>">
	                                                <input type="hidden" name="product_price" value="<?php echo $adding ?>">
	                                                <input type="hidden" name="product_number" value="<?php echo $product_number; ?>">
	                                                 <input type="hidden" name="name" value="<?php echo $ragzProduct['product_name']; ?>">
	                                                <input type="hidden" name="quantity" value="<?php echo 1 ?>">
	                                                <input type="hidden" name="return" value="<?php $_SERVER['REQUEST_URI'] ?>">

	                                                <button data-toggle="tooltip" class="btn btn-primary icon" type="submit" title="Add Cart"> <i class="fa fa-shopping-cart"></i> CART </button>

	                                            	 <!-- <button data-name="<?php echo $name ?>" data-quantity="1" data-id="<?php echo $featureProduct['product_number'] ?>" data-price="<?php echo $adding ?>"  class="btn btn-danger cartbutton">Add To Cart
                                					</button> -->
												
												<a data-toggle="tooltip" class="btn btn-danger" href="handlers/registration/addit.php?product_number=<?php echo $product_number?>&&action=<?php echo 'Wishlist' ?>" title="Compare"> <i class="icon fa fa-signal"></i> COMPARE </a> 
											</div>
										</form>	
									</div><!-- /.row -->
								</div><!-- /.quantity-container -->
							</div><!-- /.product-info -->
						</div><!-- /.col-sm-7 -->
					</div><!-- /.row -->
                </div>

				
				<div class="product-tabs inner-bottom-xs  wow fadeInUp">
					<div class="row">
						<div class="col-sm-3">
							<ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
								<li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
								<li><a data-toggle="tab" href="#tags">TAGS</a></li>
							</ul><!-- /.nav-tabs #product-tabs -->
						</div>
						<div class="col-sm-9">

							<div class="tab-content">
								
								<div id="description" class="tab-pane in active">
									<div class="product-tab">
										<p class="text"><?php echo $ragzProductDetails['product_description'] ?></p>
									</div>	
								</div><!-- /.tab-pane -->

								

								<div id="tags" class="tab-pane">
									<div class="product-tag">
										
										<h3 class="title">Product Tags</h3>
										<h5 class="title"><strong><?php echo 1; ?></strong></h5>
										
									</div><!-- /.product-tab -->
								</div><!-- /.tab-pane -->

							</div><!-- /.tab-content -->
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.product-tabs -->

				<section class="section featured-product wow fadeInUp">
		            <h3 class="section-title">Other Products In <?php echo $category_name ?> Categories</h3>
		                <div class="col col-sm-6 col-md-12 text-right">
		                    <div class="pagination-container">
	                            <ul class="list-inline list-unstyled">
	                                <?php 
	                                if($totalItems > 11){ ?>
	                                    <ul class="list-inline list-unstyled">
	                                        <?php $b = $page - 1;
	                                          if($page != 1){ ?>
	                                              <li class="prev"><a href="<p>Showing <?php echo $itemsPerPage ?> of <?php echo $totalItems ?> item(s)</p>"><i class="fa fa-angle-left"></i></a></li>
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
			                        <div class="row">
			                            <?php
		                                foreach($seeProdcut as $featureProduct){ 
						                    $product_number = $featureProduct['product_number'];
						                    $ragzszProduct = $productDetails->getProductsDet($product_number);
						                    $ragzszProductDetails = $productDetails->getProductsDetails($product_number);
						                    $manufacturer_id = $ragzszProduct['manufacturer_id'];
						                    $gettingMa = $db->prepare("SELECT * FROM manufacturer WHERE manufacturer_id=:manufacturer_id");
						                    $arr = array(':manufacturer_id'=>$manufacturer_id);
						                    $gettingMa->execute($arr); ?>
		                                    
		                                    <div class="col-sm-6 col-md-3 wow fadeInUp">
		                                        <div class="products">
		                                            <div class="product">
		                                                <div class="product-image">
		                                                    <div class="image"> 
		                                                        <a href="product-detail.php?product_number=<?php echo $ragzszProduct['product_number']; ?>">
		                                                        	<img src="<?php echo "images/product/large-image/".$ragzszProduct['product_image'] ?>" width="100" height="150px" alt="">
		                                                        </a> ;
		                                                    </div>
		                                                    <!-- /.image -->                          
		                                                    <div class="tag new"><span>new</span>
		                                                    </div>
		                                                </div>
		                                                <!-- /.product-image -->
		                        
		                                                <div class="product-info text-left">
		                                                    <h3 class="name"><a href="product-detail.php?product_number=<?php echo $ragzszProduct['product_number']; ?>"><?php echo $ragzszProduct['product_name']; ?></a></h3>
		                                                    <div class="rating rateit-small">
		                                                        
		                                                    </div>
		                                                    <div class="description">
									                            <?php while($see = $gettingMa->fetch()){ echo $see['manufacturer_name']; } ?>
									                        </div>
		                                                    <div class="product-price"> 
		                                                        <span class="price"><?php 
		                                                            $num = (5/100)*$ragzszProductDetails['product_price'] + $ragzzProductDetails['product_price'];
		                                                            $num2= (20/100)*$ragzszProductDetails['product_price'];
		                                                            $addsing = $num2 + $ragzszProductDetails['product_price'];
		                                                            number_format($ragzszProductDetails['product_price']); ?> 
		                                                             &#8358;<?php echo number_format($addsing) ?> </span> <span class="price-before-discount">discount</span> 
		                                                        </div>
		                                                  <!-- /.product-price --> 
		                                                </div>
		                                                <!-- /.product-info -->
		                                                <div class="cart clearfix animate-effect">
		                                                    <div class="action">
		                                                        <ul class="list-unstyled">
		                                                        	
		                                                           <li class="lnk wishlist"> 
		                                                                <a data-toggle="tooltip" class="add-to-cart" href="handlers/registration/addit.php?product_number=<?php echo $ragzszProduct['product_number']?>&&action=<?php echo 'Wishlist' ?>" class="paction add-wishlist" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> 
		                                                            </li>
		                                                            <li class="add-cart-button btn-group">
		                                                            	<form action="handlers/cart/addToCart.php" method="get">
				                                                        	<input type="hidden" name="sizes" value="<?php echo $ragzszProduct['product_size'] ?>">
				                                                            <input type="hidden" name="product_price" value="<?php echo $addsing ?>">
				                                                            <input type="hidden" name="product_number" value="<?php echo $ragzszProduct['product_number']; ?>">
				                                                             <input type="hidden" name="name" value="<?php echo $ragzszProduct['product_name']; ?>">
				                                                            <input type="hidden" name="quantity" value="<?php echo 1 ?>">
				                                                            <input type="hidden" name="return" value="<?php $_SERVER['REQUEST_URI'] ?>">
				                                                            <button data-toggle="tooltip" class="btn btn-primary icon" type="submit" title="Add Cart"> <i class="fa fa-shopping-cart"></i> </button>

			                                                        	</form>
		                                                                
		                                                               <!-- <button data-name="<?php echo $name ?>" data-quantity="1" data-id="<?php echo $product_number ?>" data-price="<?php echo $adding ?>"  class="btn btn-danger cartbutton"><i class="fa fa-shopping-cart"></i>Add To Cart
		                                								</button> -->
		                                                            </li>           
		                                                            <li class="lnk"> 
		                                                                <a data-toggle="tooltip" class="add-to-cart" href="handlers/registration/addit.php?product_number=<?php echo $ragzszProduct['product_number']?>&&action=<?php echo 'Compare' ?>" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> 
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

		</div><!-- /.col -->
		<div class="clearfix"></div>
	</div><!-- /.row -->
<?php include("includes/footer.php");?>