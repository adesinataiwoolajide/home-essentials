<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
?>
<ul class="breadcrumb">
    <li><a href="./"><i class="fa fa-dashboard"></i> Home</a></li>                    
    <li><a href="add-products-category.php"><i class="fa fa-plus"></i> Add Products Category</a></li>  
    <li><a href="view-all-products-categories.php"><i class="fa fa-list"></i> View All Cagories</p></a></li>  
    <li class="active">Products Category</li>   
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
            <form action="process-add-products-category.php" method="post" class="form-horizontal" enctype="multipart/form-data">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <h3 class="panel-title"><strong>Add A </strong> New Products Category</h3>
	                    
	                </div>
	                <div class="panel-body">
	                    <h3><p style="color: green" align="center">Please fill the below form to add a new products category</p></h3>
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
	                        <label class="col-md-2 col-xs-12 control-label">CATEGORY NAME</label>
	                        <div class="col-md-9 col-xs-12">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-building"></span></span>
	                                <input type="text" class="form-control" name="category_name" placeholder="Please Enter The Category Name" required minlength="2" />
	                            </div>                                            
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>
	                    </div>
	                </div>
	                <div class="panel-footer">                                 
	                    <button class="btn btn-success pull-right" name="adding-category">ADD A NEW PRODUCTS CATEGORY</button>
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