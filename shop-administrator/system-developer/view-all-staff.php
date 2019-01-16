<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    include("../../libs_dev/staffs/staff_class.php");
    $staff_details = new ragzNationStaffDetails($db);
    $email = $_SESSION['user_name'];
   
?>
<ul class="breadcrumb">
    <li><a href="./">Home</a></li>     
    <li><a href="view-all-staff"><i class="fa fa-list"></i> View All Staff</p></a></li>                 
    <li><a href="add-staff-biodata.php"><i class="fa fa-plus"></i> Add Staff</a></li>
    <li class="active">View all Ragz Staff Details</li>   
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
                    $detail = $db->prepare("SELECT * FROM staff ORDER BY staff_number DESC"); 
                    $detail->execute(); 
                    if($detail->rowCount()==0){ ?>
                        <h3 align="center"><p style="color: red;" align="center">The Staff List is Empty, Please Click On Add Staff To Add Staff To The Staff List </p></h3><?php
                    }else{ ?>
                        <div class="panel-heading">
                            <h3 class="panel-title">List of All Ragz Staff</h3>
                            <?php include("../table-modal.php"); ?>
                        </div>
                        <table id="customers2" class="table datatable">
                            
                            <thead align="center">
                                <tr>
                                    <th>S/N</th>
                                    <th>Staff Passport</th>
                                    <th>Staff Name</th>
                                    <th>Staff Number</th> 
                                    <th>Phone Number</th>
                                    <th>E-Mail</th>
                                    <th>Operation</th>
                                </tr>
                            </thead>
                            <tfoot align="center">
                                <tr>
                                    <th>S/N</th>
                                    <th>Staff Passport</th>
                                    <th>Staff Name</th>
                                    <th>Staff Number</th> 
                                    <th>Phone Number</th>
                                    <th>E-Mail</th>
                                    <th>Operation</th>
                                </tr>
                            </tfoot>

                            <tbody><?php
                                $y =1;
                                while($row = $detail->fetch()){
                                    $staff_number = $row['staff_number'];
                                    $staff_name = $row['staff_name'];
                                    $staff_email = $row['staff_email']; ?>
                                    <tr>
                                        
                                        <td><?php echo $y; ?></td>
                                        <td><img src="<?php echo "staff-passport/".$row['passport'] ?>" style="width: 50px; height: 50px;"></td>
                                        <td><?php echo $row['staff_name']; ?></td>
                                        <td><?php echo $row['staff_number']; ?></td>
                                        <td><?php echo $row['staff_phone']; ?></td>
                                        <td><?php echo $row['staff_email']; ?></td>
                                        <td>
                                            <a href="staff_details.php?staff_number=<?php echo $staff_number?>&&staff_email=<?php echo $staff_email ?>" class="btn btn-success"><i class="fa fa-cogs"></i></a>
                                            <a href="edit-staff-details.php?staff_number=<?php echo $staff_number ?>&&staff_email=<?php echo $staff_email ?>" class="btn btn-warning" onclick="return(confirmToEdit());"><i class="fa fa-pencil"></i></a>
                                            <a href="delete-staff-details.php?staff_number=<?php echo $staff_number ?>&&staff_email=<?php echo $staff_email ?>" class="btn btn-danger" onclick="return(confirmToDelete());"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr><?php
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
        return confirm("Click Okay to Delete Staff Details and Cancel to Stop");
    }
</script>

<script>
    function confirmToEdit(){
        return confirm("Click okay to Edit Staff and Cancel to Stop");
    }
</script>    
<script>
    function confirmToPrint(){
        return confirm("Click okay to Print Staff Details and Cancel to Stop");
    }
</script> 
<?php
    include("../log-out-modal.php");
    include("../table-footer.php");
?>
