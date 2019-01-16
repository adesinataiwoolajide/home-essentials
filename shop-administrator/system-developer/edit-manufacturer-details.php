<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    require '../../libs_dev/products/products_class.php';
    $productsCate = new ragzNationProductsCategory($db);
    $manufacturer_name = $_GET['manufacturer_name'];
    $manufacturer_id = $_GET['manufacturer_id'];
    $manuDetails = $productsCate->getTypeManuId($manufacturer_id);
?>
<ul class="breadcrumb">
    <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>  
    <li><a href="edit-manufacturer-details.php?manufacturer_name=<?php echo $manufacturer_name ?>&&manufacturer_id=<?php echo $manufacturer_id ?>"><i class="fa fa-pencil"></i> Add Products Manufacturer</a></li>                    
    <li><a href="add-products-manufacturer.php"><i class="fa fa-plus"></i> Add Products Manufacturer</a></li>  
    <li><a href="view-all-products-manufacturers.php"><i class="fa fa-list"></i> View All Manufacturers</p></a></li>  
    <li class="active">Products Manufacturer</li>   
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
            <form action="update-product_manufacturer-details.php" method="post" class="form-horizontal" enctype="multipart/form-data">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <h3 class="panel-title"><strong>Update Products</strong>   Manufacturer Details</h3>
	                    
	                </div>
	                <div class="panel-body">
	                    <h3><p style="color: green" align="center">Please fill the below form to update products Manufacturer Details</p></h3>
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
			        <div class="col-md-2" align="right">
                            <div class="panel-body profile" style="background: url('<?php echo "../../manufacturer-logo/".$manuDetails['manufacturer_logo'] ?>') center center no-repeat;">
                                <div class="profile-image">
                                    <img src="<?php echo "../../manufacturer-logo/".$manuDetails['manufacturer_logo'] ?>" alt="<?php echo $manufacturer_name; ?>" style="width: 50px; height: 50px;"/>
                                </div>
                                                           
                            </div>   
                        </div>
	                <div class="panel-body form-group-separated">    
	                    <div class="form-group">
	                        <label class="col-md-2 col-xs-12 control-label">MANUFACTURER NAME</label>
	                        <div class="col-md-9 col-xs-12">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-cogs"></span></span>
	                                <input type="text" class="form-control" name="manufacturer_name" placeholder="Please Enter The Manufacturer Name" value="<?php echo $manufacturer_name ?>" required minlength="2" />
	                            </div>                                            
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>
	                    </div>
	                </div>
	                <div class="panel-body form-group-separated">    
	                    <div class="form-group">
	                        <label class="col-md-2 col-xs-12 control-label">CHANGE MANUFACTURER LOGO</label>
	                        <div class="col-md-9 col-xs-12">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-gallery"></span></span>
	                                <input type="file" class="form-control" name="image" placeholder="Please Enter The MANUFACTURER Name" required minlength=""  />
	                            </div>                                            
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>
	                    </div>
	                </div>
	                <input type="hidden" name="manufacturer_id" value="<?php echo $manufacturer_id ?>">
	                <input type="hidden" name="prev_manufacturer_name" value="<?php echo $manufacturer_name ?>">
	                <input type="hidden" name="return" value="<?php echo $_SERVER['return']; ?>">
	                <div class="panel-footer">                                 
	                    <button class="btn btn-success pull-right" name="adding_manufacturer">UPDATE THE MANUFACTURER DETAILS</button>
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