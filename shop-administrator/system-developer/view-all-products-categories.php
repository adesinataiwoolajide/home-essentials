<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    $email = $_SESSION['user_name'];
   
?>
<ul class="breadcrumb">
    <li><a href="./"> <i class="fa fa-dashboard"></i> Home</a></li>     
    <li><a href="view-all-products-categories.php"> <i class="fa fa-list"></i> View All Cagories</p></a></li>                
    <li><a href="add-products-category.php"><i class="fa fa-plus"></i> Add Products Category</a></li>   
    <li class="active">Products Categories</li>   
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
    <div class="panel panel-default">
        
    </div>
        
        <div class="row">
            <div class="col-md-12"> 
                <div class="panel panel-default">
                    
                    <div class="panel-body"><?php
                        $detail = $db->prepare("SELECT * FROM products_category ORDER BY category_name ASC"); 
                        $arrDet = array(':email'=>$email);
                        $detail->execute($arrDet); 
                        if($detail->rowCount()==0){ ?>
                            <h4 align="center"><p style="color: red;" align="center">The Products Category List is Empty, Please Click On Add Category To Add The Products Category </p></h4><?php
                        }else{ ?>
                            <div class="panel-heading">
                                <h3 class="panel-title">Products Category List </h3>
                                <?php include("../table-modal.php"); ?>
                            </div>
                            <table id="customers2" class="table datatable">
                                <thead align="center">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Category Name</th>
                                        <th>Time Added</th> 
                                        <th>Operations</th>
                                    </tr>
                                </thead>
                                <tfoot align="center">
                                    <tr>
                                        <th>S/N</th>
                                        <th>Category Name</th>
                                        <th>Time Added</th> 
                                        <th>Operations</th>
                                    </tr>
                                </tfoot>

                                <tbody><?php
                                    $y =1;
                                    while($row = $detail->fetch()){ 
                                        $category_name = $row['category_name']; 
                                        $category_id=$row['category_id']; ?>
                                        <tr>
                                            <td><?php echo $y; ?></td>
                                            <td><?php echo $row['category_name']; ?></td>
                                            <td><?php echo $row['time_added']; ?></td>
                                            <td>
                                                <a href="edit-products-category.php?category_name=<?php echo $category_name ?>&&category_id=<?php echo $category_id ?>" onclick="confirmToEdit();" class="btn btn-warning btn-clean"><i class="fa fa-pencil"></i>Edit</a>
                                                <a  href="delete-products-category.php?category_name=<?php echo $category_name ?>&&category_id=<?php echo $category_id ?>" class="btn btn-danger btn-clean"  onClick="confirmToDelete();"><i class="fa fa-trash-o"></i>Delete</a>
                                                
                                            </td>

                                        </tr>
                                        <?php
                                        $y++;
                                    } ?> 
                                </tbody>
                            </table><?php
                        
                        } ?>    
                    </div>
                </div>
            </div>
        </div>    
</div>  
<script>
    function confirmToDelete(){
        return confirm("Click Okay to Delete Products Category Details and Cancel to Stop");
    }
</script>

<script>
    function confirmToEdit(){
        return confirm("Click okay to Edit Products Category and Cancel to Stop");
    }
</script>    
<script>
    function confirmToPrint(){
        return confirm("Click okay to Print Products Category Receipt and Cancel to Stop");
    }
</script>    
<?php
    include("../log-out-modal.php");
    include("../table-footer.php");
?>
