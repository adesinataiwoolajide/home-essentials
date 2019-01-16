<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    $email = $_SESSION['user_name'];
   
?>
<ul class="breadcrumb">
    <li><a href="./">Home</a></li>                    
    <li><a href="my-activities.php">My Activities</a></li>
    <li class="active">Activities</li>   
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
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $_SESSION['name']; ?> Activities </h3>
                        <?php include("../table-modal.php"); ?>
                    </div>
                    <div class="panel-body"><?php
                        $detail = $db->prepare("SELECT * FROM activity WHERE user_details=:email ORDER BY act_id DESC"); 
                        $arrDet = array(':email'=>$email);
                        $detail->execute($arrDet); 
                        if($detail->rowCount()==0){ ?>
                            <p style="color: red;" align="center"><h3 align="center">No Recent Activities. </h3></p><?php
                        }else{ ?>
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
                                    while($row = $detail->fetch()){ ?>
                                        <tr>
                                            
                                            <td><?php echo $y; ?></td>
                                            <td><?php echo $row['action']; ?></td>
                                            <td><?php echo $row['user_details']; ?></td>
                                            <td><?php echo $row['time_added']; ?></td>
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

<?php
    include("../log-out-modal.php");
    include("../table-footer.php");
?>
