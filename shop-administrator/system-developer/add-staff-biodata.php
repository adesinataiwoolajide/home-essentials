<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    
?>
<ul class="breadcrumb">
    <li><a href="./">Home</a></li>                    
    <li><a href="add-staff-biodata.php"><i class="fa fa-plus"></i> Add Staff</a></li>  
    <li><a href="view-all-staff.php"><i class="fa fa-list"></i> View All Staffs</p></a></li>  
    <li class="active">Adding Staff Biodata</li>   
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
            <form action="process-staff-biodata.php" method="post" class="form-horizontal" enctype="multipart/form-data">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    <h3 class="panel-title"><strong>Add A </strong> New Staff</h3>
	                    
	                </div>
	                <div class="panel-body">
	                    <p>Please fill the below form to Add a Staff Details</p>
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
	                		<label class="col-md-1 col-xs-6 control-label">STAFF PASSPORT</label>
	                        <div class="col-md-5 col-xs-6">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-image"></span></span>
	                                <input type="file" class="form-control file" name="image" placeholder="" required />
	                            </div>                                           
	                                                                   
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>
	                        <label class="col-md-1 col-xs-6 control-label">STAFF NAME</label>
	                        <div class="col-md-5 col-xs-6">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-user"></span></span>
	                                <input type="text" class="form-control" name="name" placeholder="Surname Firstname and Other Names" required minlength="5" />
	                            </div>                                            
	                                                                   
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>
	                        
	                    </div>
	                	<div class="form-group col-md-12">
	                		
	                        <label class="col-md-1 col-xs-6 control-label">STAFF SEX</label>
	                        <div class="col-md-5 col-xs-6">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-smile-o"></span></span>
	                                <select class="form-control " name="sex" required>
                                        <option value="">-- Select The Staff Sex From The List --
                                        </option>
                                        <option value=""></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
	                            </div>                                            
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>  

	                        <label class="col-md-1 col-xs-6 control-label">STATE OF ORIGIN</label>
	                        <div class="col-md-5 col-xs-6">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-smile-o"></span></span>
	                                <select class="form-control " name="state_origin" required>
                                        <option value="">-- Select The Staff Sex From The List --
                                        </option>
                                        <option value=""></option>
                                        
                                    	<option value="Abuja FCT">Abuja FCT</option>
							            <option value="Abia State">Abia State</option>
							              <option value="Adamawa State">Adamawa</option>
							              <option value="Akwa Ibom State">Akwa Ibom</option>
							              <option value="Anambra State">Anambra</option>
							              <option value="Bauchi State">Bauchi</option>
							              <option value="Bayelsa State">Bayelsa</option>
							              <option value="Benue State">Benue</option>
							              <option value="Borno State">Borno</option>
							              <option value="Cross River State">Cross River</option>
							              <option value="Delta State">Delta</option>
							              <option value="Ebonyi State">Ebonyi</option>
							              <option value="Edo State">Edo</option>
							              <option value="Ekiti State">Ekiti</option>
							              <option value="Enugu State">Enugu</option>
							              <option value="Gombe State">Gombe</option>
							              <option value="Imo State">Imo</option>
							              <option value="Jigawa State">Jigawa</option>
							              <option value="Kaduna State">Kaduna</option>
							              <option value="Kano State">Kano</option>
							              <option value="Katsina State">Katsina</option>
							              <option value="Kebbi State">Kebbi</option>
							              <option value="Kogi State">Kogi</option>
							              <option value="Kwara State">Kwara</option>
							              <option value="LagosState">Lagos</option>
							              <option value="Nassarawa State">Nassarawa</option>
							              <option value="Niger State">Niger</option>
							              <option value="Ogun State">Ogun</option>
							              <option value="Ondo State">Ondo</option>
							              <option value="Osun State">Osun</option>
							              <option value="Oyo State">Oyo</option>
							              <option value="Plateau State">Plateau</option>
							              <option value="Rivers State">Rivers</option>
							              <option value="Sokoto State">Sokoto</option>
							              <option value="Taraba State">Taraba</option>
							              <option value="Yobe State">Yobe</option>
							              <option value="Zamfara State">Zamfara</option>
							     		<option value="Outside Nigeria">Outside Nigeria</option>
                                    </select>
	                            </div>                                            
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>  
	                        
	                    </div>

	                    <div class="form-group col-md-12">
	                    	<label class="col-md-1 col-xs-6 control-label">STAFF EMAIL</label>
	                        <div class="col-md-5 col-xs-6">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-calendar-o"></span></span>
	                                <input type="email" class="form-control email" name="staff_email" placeholder="Please Enter the Staff Email" required />
	                            </div>                                            
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>
	                        <label class="col-md-1 col-xs-6 control-label">DATE OF BIRTH</label>
	                        <div class="col-md-5 col-xs-6">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-calendar-o"></span></span>
	                                <input type="text" class="form-control datepicker" name="birth" placeholder="Date of Birth" required />
	                            </div>                                           
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>  
	                    </div>
	                	
	                    <div class="form-group col-md-12">

	                    	<label class="col-md-1 col-xs-6 control-label">STAFF RELIGION</label>
	                        <div class="col-md-5 col-xs-6">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-image"></span></span>
	                                <select class="form-control " name="religion" required>
                                        <option value="">-- Select The Staff Religion From The List --
                                        </option>
                                        <option value=""></option>
                                        <option value="Christanity">Christanity</option>
                                        <option value="Islam">Islam</option>
                                        <option value="Others">Others</option>
                                    </select>
	                            </div>                                            
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>
	                    	
	                        
	                        <label class="col-md-1 col-xs-6 control-label">EMPLOYMENT YEAR</label>
	                        <div class="col-md-5 col-xs-6">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-calendar-o"></span></span><?php
                               	 	$early = 2000;
	                                $current = date("Y");
                                    print '<select class ="form-control" required name ="year_employ">';?>
                                    <option value="">-- Please Select The Year of Employment --</option>
                                    <option value=""></option><?php
                                    foreach(range($current, $early) as $i){
                                        print'<option value=" '.$i.'"'.($i === $current ? 'selected="selected"' : '').'>'.$i.'</option>';
                                    }
                                    print '</select>';?> 
	                                
	                            </div>                                            
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>
	                    </div>

	                    <div class="form-group col-md-12">
		                    <label class="col-md-1 col-xs-6 control-label">STAFF PHONE</label>
	                        <div class="col-md-5 col-xs-6">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-smile-o"></span></span>
	                                <input type="number" class="form-control" name="phone" placeholder="Please enter the Staff Phone Number" required minlength="10" />
	                            </div>                                            
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>  

		                   	<label class="col-md-1 col-xs-6 control-label">STAFF QUALIFICATION</label>
	                        <div class="col-md-5 col-xs-6">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-bar-chart-o"></span></span>
	                                <select multiple class="form-control " name="qualification[]" required>
	                                    <option value="">-- Select The Staff Quatification From The List  --</option>
	                                    <option value=""></option><?php
	                                    $clas = $db->prepare("SELECT * FROM staff_qualification ORDER BY qualification_name ASC");
	                                    $clas->execute();
	                                    while($seeClass = $clas->fetch()){ ?>
	                                    	
	                                    	<option value="<?php echo $seeClass['qualification_id']; ?>"><?php echo $seeClass['qualification_name']; ?>
	                                    	</option><?php
	                                    } ?>
	                                </select>
	                            </div>                                            
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>
	                    </div>
	                    <div class="form-group col-md-12">
	                        <label class="col-md-1 col-xs-6 control-label">STAFF TYPE</label>
	                        <div class="col-md-5 col-xs-6">
	                                                          
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-bars"></span></span>
	                                <select class="form-control " name="type" required>
	                                	<option value="">-- Please Select the Staff Category --</option>
	                                	<option value=""></option><?php
                                        $clas = $db->prepare("SELECT * FROM staff_type ORDER BY type_name ASC");
	                                    $clas->execute();
	                                    while($seeTClass = $clas->fetch()){ ?>
	                                    	
	                                    	<option value="<?php echo $seeTClass['type_id']; ?>"><?php echo $seeTClass['type_name']; ?>
	                                    	</option><?php
	                                    } ?>
                                    </select>
	                            </div>                                            
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>
	                    	<label class="col-md-1 col-xs-6 control-label">MARITAL STATUS</label>
	                        <div class="col-md-5 col-xs-6">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-crosshairs"></span></span>
	                                <select class="form-control " name="status" required>
                                        <option value="">-- Select The Staff Sex From The List --
                                        </option>
                                        <option value=""></option>
                                        <option value="Single">Single</option>
                                        <option value="Engaged">Engaged</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Widowed">Widowed</option>
                                    </select>
	                            </div>                                            
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>
	                    </div>

	                    <div class="form-group col-md-12">
	                        <label class="col-md-1 col-xs-6 control-label">STAFF ADDRESS</label>
	                        <div class="col-md-5 col-xs-6">                                            
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-calendar-o"></span></span>
	                                <textarea class="form-control textarea" cols="4" name="address" placeholder="Enter The Staff Residential Address" required ></textarea>
	                            </div>                                            
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>
	                    
	                    	<label class="col-md-1 col-xs-6 control-label">NEXT OF KIN</label>
	                        <div class="col-md-5 col-xs-6">              
	                            <div class="input-group">
	                                <span class="input-group-addon"><span class="fa fa-calendar-o"></span></span>
	                                <textarea class="form-control textarea" cols="3" name="kin_details" placeholder="Enter The Staff Next of Kin Details, e.g. Full Name, Phone Number and Address" required ></textarea>
	                            </div>                                        
	                            <span class="help-block" style="color: red;">This is field is Required.</span>
	                        </div>
	                    </div>
	                </div>

	                <div class="panel-footer col-md-12">                                 
	                    <button class="btn btn-success pull-right" name="adding_details">ADD THE STAFF DETAILS</button>
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