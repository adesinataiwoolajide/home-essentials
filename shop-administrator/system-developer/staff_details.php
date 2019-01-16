<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    include("../../libs_dev/staffs/staff_class.php");
    $staffDetails = new ragzNationStaffDetails($db);
    $staff_email = $_GET['staff_email'];
    $staff_number = $_GET['staff_number'];
    $myDetails = $staffDetails->gettingStafftDetails($staff_number);
    $staff_name = $myDetails['staff_name'];
    $details = $myDetails;

?>
<ul class="breadcrumb">
    <li><a href="./">Home</a></li>  
    <li><a href="staff_details.php?staff_number=<?php echo $staff_number?>&&staff_email=<?php echo $staff_email ?>"><?php echo $staff_name ?> Details</p></a></li>  
    <li><a href="edit-staff-details.php?staff_number=<?php echo $staff_number?>&&staff_email=<?php echo $staff_email ?>">Edit  <?php echo $staff_name ?> Details</p></a></li>                
    <li><a href="add-staff-biodata.php">Add Staff</a></li>  
    <li><a href="view-all-staff.php">View All Staffs</p></a></li>  
    <li class="active">View<?php echo $staff_name ?>  Biodata Details</li>   
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
        <div class="col-md-3">
            
            <div class="panel panel-default">
                <div class="panel-body profile" style="background: url('<?php echo "staff-passport/". $myDetails['passport']; ?>') center center no-repeat;">
                    <div class="profile-image">
                        <img src="<?php echo "staff-passport/". $myDetails['passport']; ?>" alt="<?php echo $staff_number; ?>" style="width: 100px; height: 100px;"/>
                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name" style="color: black">
                        	<?php echo $details['staff_name']; ?>
                        </div>
                        <div class="profile-data-title" style="color: black;">
                        	<?php echo $staff_number; ?>	
                        </div>
                    </div>                                 
                </div>                                
                <div class="panel-body">                                    
                    <div class="row" align="center">
                        STAFF PANEL
                    </div>
                </div>
                <div class="panel-body list-group border-bottom">
                	<a href="staff_details.php?staff_number=<?php echo $staff_number?>&&staff_email=<?php echo $staff_email ?>" class="list-group-item active"><span class="fa fa-user"></span> Staff Details</a>
                	<a href="edit-staff-details.php?staff_number=<?php echo $staff_number?>&&staff_name=<?php echo $staff_name ?>" class="list-group-item "><span class="fa fa-pencil"></span> Edit Staff Details</a>           
                    
                    <a href="message-staff.php?staff_number=<?php echo $staff_number?>&&staff_email=<?php echo $staff_email ?>" class="list-group-item"><span class="fa fa-envelope"></span>Message</a>
                    <a href="staff-activities-log.php?staff_number=<?php echo $staff_number?>&&staff_email=<?php echo $staff_email ?>" class="list-group-item"><span class="fa fa-cloud"></span> Activity Log</a>
                </div>
                
            </div>                            
            
        </div>
        
        <div class="row">
        	<div class="col-md-9"> 
	            <div class="panel panel-default">
	                <table id="customers2" class="table datatable">
	                                                        
	                    <div class="panel-body">
	                    	<table class="table table-responsive">
	                    		
	                    		<tbody>
	                    			<tr>
	                    				<td>Staff Name</td>
	                    				<td><?php echo $details['staff_name']; ?></td>
	                    			</tr>
	                    		</tbody>
	                    		
	                    		
	                    		<tbody>
	                    			<tr>
	                    				<td>Staff Number</td>
	                    				<td><?php echo $details['staff_number'] ?></td>
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Staff Sex</td>
	                    				<td><?php echo $details['sex']; ?></td>
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Staff Phone</td>
	                    				<td><?php echo $details['staff_phone']; ?></td>
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Staff E-Mail</td>
	                    				<td><?php
	                    					echo $staff_email = $details['staff_email']; ?>
                                           
			                            </td>
	                    			</tr>
	                    		</tbody>
	                    		
	                    		<tbody>
	                    			<tr>
	                    				<td>Date of Birth</td>
	                    				<td><?php echo $details['date_birth']; ?></td>
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Staff Type</td>
	                    				<td><?php $type_id = $details['type_id'];
	                    					$seeType = $staffDetails->getStaffType($type_id);
	                    					echo $type_name = $seeType['type_name'] ?>
	                    				</td>
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Date of Employment</td>
	                    				<td><?php echo $details['year_employ']; ?></td>	
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>State of Origin</td>
	                    				<td><?php echo $details['state_origin']; ?></td>	
	                    			</tr>
	                    		</tbody>

	                    		<tbody>
	                    			<tr>
	                    				<td>Address</td>
	                    				<td><?php echo $details['address']; ?></td>	
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Marital Status</td>
	                    				<td><?php echo $details['marital_status']; ?></td>	
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Staff Qualification</td>
	                    				<td><?php
	                    					$ema = $details['qualification_id'];
											$split = explode(",", $ema);
											foreach($split as $new){
												$qualif = $db->prepare("SELECT * FROM staff_qualification WHERE qualification_id=:new");
												$arr = array(':new'=>$new);
												$qualif->execute($arr);
												while($bring = $qualif->fetch()){
													echo $bring['qualification_name']. ", ";
												}
											} ?></td>	
	                    			</tr>
	                    		</tbody>
	                    		<tbody>
	                    			<tr>
	                    				<td>Next of Kin Details</td>
	                    				<td><?php echo $details['kin_details']; ?></td>	
	                    			</tr>
	                    		</tbody>

	                    		<tbody>
	                    			<tr>
	                    				<td>Religion</td>
	                    				<td><?php echo $details['religion']; ?></td>	
	                    			</tr>
	                    		</tbody>
	                    	</table>                       
	                        <div class="panel-footer col-md-12">                                 
			                    <a href="edit-staff-details.php?staff_number=<?php echo $details['staff_number']; ?>&&staff_email=<?php echo $staff_email;?>" class="btn btn-success pull-right">EDIT STAFF DETAILS</a>
			                </div>
	                    </div>
	                </table>                                    
	            </div>
	        </div>
        </div>
        <?php include 'staff-act-log.php'; ?>
	</div>
<?php
    include("../log-out-modal.php");
	include("../table-footer.php");
?>

