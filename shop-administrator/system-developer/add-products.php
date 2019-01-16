<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
?>
<ul class="breadcrumb">
    <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>                    
    <li><a href="add-products.php"><i class="fa fa-plus"></i> Add Products</a></li>  
    <li><a href="view-all-products.php"><i class="fa fa-list"></i> View All Product</p></a></li>  
    <li><a href="unpublish-products.php"><i class="fa fa-list"></i> Un-Publish Product</p></a></li> 
    <li><a href="publish-products-for-sale.php"><i class="fa fa-list"></i> Publish Product</p></a></li>    
    <li><a href="published-products.php"><i class="fa fa-cloud"></i> Published Product</p></a></li>  
    <li class="active">Adding Products</li>   
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
            <form action="process-add-product.php" method="post" class="form-horizontal" enctype="multipart/form-data">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <h3 class="panel-title"><strong>Add A </strong> New Products</h3>
	                    
	                </div>
	                <div class="panel-body">
	                    <h3><p style="color: green" align="center">Please fill the below form to add a new product</p></h3>
	                </div>
	                <?php
			        if((isset($_SESSION['success'])) OR ((isset($_SESSION['error'])) === true)){ ?>
			            <div class="alert alert-info" align="center">
			                <button class="close" data-dismiss="alert">
			                    <i class="ace-icon fa fa-times"></i>
			                </button>
			             <?php include("../includes/feed-back.php"); ?>
			            </div><?php 
			        }  ?> 
	                <div class="panel-body form-group-separated">    
	                    <div class="form-group col-md-12">
	                		<label class="col-md-1 col-xs-6 control-label">PRODUCT IMAGE</label>
	                        <div class="col-md-5 col-xs-6">

	                        	<div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-image"></span></span>
	                                <input type="file" class="form-control file" name="image"  required />
	                            </div>                                            
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>
	                        <label class="col-md-1 col-xs-6 control-label">PRODUCT NAME</label>
	                        <div class="col-md-5 col-xs-6">
	                        	<div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
	                                <input type="text" class="form-control" name="product_name" placeholder="Enter The Product Name" required minlength="3" />
	                            </div>                                             
	                                                                       
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>  
	                        
	                    </div>
	                    <div class="form-group col-md-12">
	                    	<label class="col-md-1 col-xs-6 control-label">PRODUCT MANUFAC<br>TURER</label>
	                        <div class="col-md-5 col-xs-6">                                                                       
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-bars"></span></span>
	                                <select class="form-control" name="manufacturer_id" required>
                                        <option value="">-- Please Select the Product Manufacturer --</option>
                                        <option value=""></option>
                                        <?php
                                        $manu = $db->prepare("SELECT * FROM manufacturer ORDER BY manufacturer_name ASC");
                                        $manu->execute();
                                        while($see_manu = $manu->fetch()){ ?>
                                            <option value="<?php echo $see_manu['manufacturer_id']; ?>"><?php echo $see_manu['manufacturer_name']; ?></option>
                                            <?php
                                        } ?>
                                    </select>
	                            </div>                                            
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>                                            
	                         
	                        <label class="col-md-1 col-xs-6 control-label">PRODUCT TYPES</label>
	                        <div class="col-md-5 col-xs-6">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-bars"></span></span>
	                               	<select class="form-control " name="type_id" required>
                                        <option value="">-- Select The Product Types From The List --
                                        </option>
                                        <option value=""></option>
                                        <?php
                                        $del = $db->prepare("SELECT * FROM product_type ORDER BY type_name ASC");
                                        $del->execute();
                                        while($nov = $del->fetch()){ ?>
                                            <option value="<?php echo $nov['type_id']; ?>"><?php echo $nov['type_name']; ?></option>
                                            <?php
                                        } ?>
                                    </select>
	                            </div>                                                 
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>  
	                    </div>
	                </div>
	                <div class="panel-footer">                                 
	                    <button class="btn btn-success pull-right" name="adding-product">ADD A NEW PRODUCT</button>
	                </div>
	            </div>
            </form>
        </div>
    </div>             
</div>        
        
<?php
    include("../log-out-modal.php");
	include("../footer.php");
?>
