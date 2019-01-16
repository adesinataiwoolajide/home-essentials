<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    require '../../libs_dev/products/products_class.php';
    $productsCate = new ragzNationProductsCategory($db);
    $type_name = $_GET['type_name'];
    $type_id = $_GET['type_id'];

    $typeDetails =$productsCate->getTypeDetailsId($type_id);
    $category_id = $typeDetails['category_id'];
    $deed = $productsCate->getCategoryDetailsId($category_id);
    $category_name = $deed['category_name'];
?>
<ul class="breadcrumb">
    <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>   
    <li><a href="edit-products-category.php?type_name=<?php echo $type_name ?>&&type_id=<?php echo $type_id ?>"><i class="fa fa-pencil"></i> Edit Products Type</a></li>                   
    <li><a href="add-products-category.php"><i class="fa fa-plus"></i> Add Products Type</a></li>  
    <li><a href="view-all-products-types.php"><i class="fa fa-list"></i> View All Types</p></a></li>  
    <li class="active">Products Types</li>   
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
            <form action="update-products-type.php" method="post" class="form-horizontal" enctype="multipart/form-data">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <h3 class="panel-title"><strong>Update The </strong>  Products Types</h3>
	                    
	                </div>
	                <div class="panel-body">
	                    <h3><p style="color: green" align="center">Please fill the below form to update the products type</p></h3>
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
	                    <div class="form-group">
	                        
	                        <label class="col-md-1 col-xs-6 control-label">TYPE NAME</label>
	                        <div class="col-md-5 col-xs-6">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-building"></span></span>
	                                <input type="text" class="form-control" name="type_name" placeholder="Please Enter The Type Name" required minlength="2" value="<?php echo $type_name ?>"  />
	                            </div>                                            
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>
	                       <label class="col-md-1 col-xs-6 control-label">PRODUCT CATEGORY</label>
	                        <div class="col-md-5 col-xs-6">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-bars"></span></span>
	                                <select class="form-control " name="category_id" required><?php
	                                	$cate = $typeDetails['category_id'];
	                                	$deed = $productsCate->getCategoryDetailsId($category_id) ?>
                                        <option value="<?php echo $cate ?>"><?php echo $deed['category_name'] ?>
                                        </option>
                                        <option value=""></option>
                                        <?php
                                        $del = $db->prepare("SELECT * FROM products_category ORDER BY category_name ASC");
                                        $del->execute();
                                        while($nov = $del->fetch()){ ?>
                                            <option value="<?php echo $nov['category_id']; ?>"><?php echo $nov['category_name']; ?></option>
                                            <?php
                                        } ?>
                                    </select>
	                            </div>                                                 
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>  
	                    </div>

	                </div>
	                <input type="hidden" name="type_id" value="<?php echo $type_id ?>">
	                <input type="hidden" name="prev_type_name" value="<?php echo $type_name ?>">
	                <input type="hidden" name="return" value="<?php echo $_SERVER['REQUEST_URI'] ?>">
	                <div class="panel-footer">                                 
	                    <button class="btn btn-success pull-right" name="update-type">UPDATE THE PRODUCTS TYPE</button>
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