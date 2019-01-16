<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    include("../../libs_dev/staffs/staff_class.php");
    $staffDetails = new ragzNationStaffDetails($db);
    $email = $_SESSION['user_name'];
    $staff_email = $_GET['staff_email'];
    $staff_number = $_GET['staff_number'];
    $myDetails = $staffDetails->gettingStafftDetails($staff_number);
    $staff_name = $myDetails['staff_name'];
    $details = $myDetails;
   
?>
<ul class="breadcrumb">
    <li><a href="./">Home</a></li>     
    <li><a href="staff-activities-log.php?staff_number=<?php echo $staff_number?>&&staff_email=<?php echo $staff_email ?>"><i class="fa fa-list"></i>View <?php echo $staff_name ?> Activity Log</p></a>
    </li>
    
    <li><a href="staff_details.php?staff_number=<?php echo $staff_number?>&&staff_email=<?php echo $staff_email ?>" class=""><i class="fa fa-user"></i> <?php echo $staff_name ?> Details</a>
    </li>               
    <li><a href="site-history.php"><i class="fa fa-plus"></i> All Staff Activity Log</a></li>
    <li class="active">View All <?php echo $staff_name ?> Activity Log</li>   
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
    <div class="panel panel-default"><?php
        
        $de=$db->prepare("SELECT * FROM activity WHERE user_details=:staff_email ORDER BY act_id DESC LIMIT 0,10"); 
        $dev = array(':staff_email'=>$staff_email);
        $de->execute($dev); 
        if($de->rowCount()==0){ ?>
            <h3 align=""><p style="color: red;" align="center">No Recent Activities Found for <?php echo $details['staff_name']; ?>. </p></h3><?php
        }else{ ?>
        	<div class="panel-heading">
            <h3 class="panel-title"><?php echo $details['staff_name']; ?> Activities Log</h3>
                <?php include("../table-modal.php"); ?>
            </div>
            <div class="panel-body">
                <table id="customers2" class="table datatable">
                    <thead align="center">
                        <tr>
                            <th>S/N</th>
                            <th>Action</th>
                            <th>Staff Details</th> 
                            <th>Action Time</th> 
                        </tr>
                    </thead>
                    <tfoot align="center">
                        <tr>
                            <th>S/N</th>
                            <th>Action</th>
                            <th>Staff Details</th> 
                            <th>Action Time</th> 
                        </tr>
                    </tfoot>
                    <tbody><?php
                        $y =1;
                        while($row = $de->fetch()){ ?>
                            <tr>
                                <td><?php echo $y; ?></td>
                                <td><?php echo $row['action']; ?></td>
                                <td><?php echo $row['user_details']; ?></td>
                                <td><?php echo $row['time_added']; ?></td>
                            </tr><?php
                            $y++;
                        } ?> 
                    </tbody>
                </table>
            </div>                                  
    		<?php
        } ?> 
    </div>         
</div>
        </div>    
</div>        

<?php
    include("../log-out-modal.php");
    include("../table-footer.php");
?>
