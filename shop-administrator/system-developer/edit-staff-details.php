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
    $users = $staff_email;
    $loginDetails = $register->gettingUserDetails($users);
    $user_id = $loginDetails['user_id'];

?>
<ul class="breadcrumb">
    <li><a href="./">Home</a></li>  
    <li><a href="edit-staff-details.php?staff_number=<?php echo $staff_number?>&&staff_email=<?php echo $staff_email ?>">Edit  <?php echo $staff_name ?> Details</p></a></li> 
    <li><a href="staff_details.php?staff_number=<?php echo $staff_number?>&&staff_email=<?php echo $staff_email ?>"><?php echo $staff_name ?> Details</p></a></li>   
    <li><a href="staff-activities-log.php?staff_number=<?php echo $staff_number?>&&staff_email=<?php echo $staff_email ?>"><i class="fa fa-list"></i>View <?php echo $staff_name ?> Activity Log</p></a>
    </li>              
    <li><a href="add-staff-biodata.php">Add Staff</a></li>  
    <li><a href="view-all-staff.php">View All Staffs</p></a></li>  
    <li class="active">Edit <?php echo $staff_name ?>  Biodata Details</li>   
</ul>
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
            <form action="process-update-staff-details.php" method="post" class="form-horizontal" enctype="multipart/form-data">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong>Staff Biodata </strong> Update Form</h3>
                        
                    </div>
                    <div class="panel-body">
                        <p align="center">Please fill the below form to update <?php echo $staff_name ?> Details</p>
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
                        <div class="col-md-2" align="right">
                            <div class="panel-body profile" style="background: url('<?php echo "staff-passport/". $myDetails['passport']; ?>') center center no-repeat;">
                                <div class="profile-image">
                                    <img src="<?php echo "staff-passport/". $myDetails['passport']; ?>" alt="<?php echo $staff_number; ?>" style="width: 50px; height: 50px;"/>
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
                        </div>
                        <div class="form-group col-md-12">
                            <label class="col-md-1 col-xs-6 control-label">CHANGE PASSPORT</label>
                            <div class="col-md-5 col-xs-6">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-image"></span></span>
                                    <input type="file" class="form-control file" name="image" placeholder="" />
                                </div>                                           
                                                                       
                                <span class="help-block" style="color: red;">This is field is Required.</span>
                            </div>
                            <label class="col-md-1 col-xs-6 control-label">STAFF NAME</label>
                            <div class="col-md-5 col-xs-6">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                    <input type="text" class="form-control" name="name" placeholder="Surname Firstname and Other Names" required minlength="5" value="<?php echo $staff_name ?>" />
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
                                        <option value="<?php echo  $details['sex'] ?>"><?php echo  $details['sex'] ?>
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
                                        <option value="<?php echo  $details['state_origin'] ?>"><?php echo  $details['state_origin'] ?>
                                        </option>
                                        <option value=""></option>
                                        <option></option>
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
                                    <input type="email" class="form-control email" name="staffemail" placeholder="Please Enter the Staff Email" required readonly value="<?php echo  $staff_email ?>" />
                                </div>                                            
                                <span class="help-block" style="color: red;">This is field is Required.</span>
                            </div>
                            <label class="col-md-1 col-xs-6 control-label">DATE OF BIRTH</label>
                            <div class="col-md-5 col-xs-6">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-calendar-o"></span></span>
                                    <input type="text" class="form-control datepicker" name="birth" placeholder="Date of Birth" required value="<?php echo  $details['date_birth'] ?>" />
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
                                        <option value="<?php echo  $details['religion'] ?>"><?php echo  $details['religion'] ?>
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
                                    <option value="<?php echo  $details['year_employ'] ?>"><?php echo  $details['year_employ'] ?></option>
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
                                    <input type="number" class="form-control" name="phone" placeholder="Please enter the Staff Phone Number" required minlength="10" value="<?php echo  $details['staff_phone'] ?>" />
                                </div>                                            
                                <span class="help-block" style="color: red;">This is field is Required.</span>
                            </div>  

                            <label class="col-md-1 col-xs-6 control-label">STAFF QUALIFICATION</label>
                            <div class="col-md-5 col-xs-6">                                            
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-bar-chart-o"></span></span>
                                    <select class="form-control " name="qualification_id[]" multiple required>
                                            <?php 
                                            $qual = $details['qualification_id'];
                                            $split = explode(",", $qual);
                                            foreach($split as $new){  
                                                $selecting = $db->prepare("SELECT * FROM staff_qualification WHERE qualification_id=:new");
                                                $ars = array(':new'=>$new);
                                                $selecting->execute($ars);
                                                while($reall = $selecting->fetch()){ ?>
                                                    <option value="<?php echo $reall['qualification_id'] ?>"><?php echo $reall['qualification_name']; ?></option><?php
                                                }
                                            } ?>    
                                            
                                            <option value=""></option><?php
                                            $qualification = $db->prepare("SELECT * FROM staff_qualification ORDER BY qualification_name ASC");
                                            $qualification->execute(); 
                                            while($rope = $qualification->fetch()){ ?>
                                                <option value="<?php echo $rope['qualification_id']; ?>"><?php echo $rope['qualification_name']; ?></option><?php
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
                                        <?php $type_id = $details['type_id'];
                                            $seeType = $staffDetails->getStaffType($type_id);
                                            $type_name = $seeType['type_name'] ?>
                                        <option value="<?php echo $type_id ?>"><?php echo $type_name ?></option>
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
                                        <option value="<?php echo $details['marital_status'] ?>"><?php echo $details['marital_status'] ?>
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
                                    <textarea class="form-control textarea" cols="4" name="address" placeholder="Enter The Staff Residential Address" required ><?php echo $details['address'] ?></textarea>
                                </div>                                            
                                <span class="help-block" style="color: red;">This is field is Required.</span>
                            </div>
                        
                            <label class="col-md-1 col-xs-6 control-label">NEXT OF KIN</label>
                            <div class="col-md-5 col-xs-6">              
                                <div class="input-group">
                                    <span class="input-group-addon"><span class="fa fa-calendar-o"></span></span>
                                    <textarea class="form-control textarea" cols="3" name="kin_details" placeholder="Enter The Staff Next of Kin Details, e.g. Full Name, Phone Number and Address" required ><?php echo $details['kin_details'] ?></textarea>
                                </div>                                        
                                <span class="help-block" style="color: red;">This is field is Required.</span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="return" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
                    <input type="hidden" name="staff_number" value="<?php echo $details['staff_number']; ?>">
                    <input type="hidden" name="user_id" value="<?php echo $user_id ?>">
                    <input type="hidden" name="staff_email" value="<?php echo $staff_email ?>">

                    <div class="panel-footer col-md-12">                                 
                        <button class="btn btn-success pull-right" name="adding_details">UPDATE THE STAFF DETAILS</button>
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