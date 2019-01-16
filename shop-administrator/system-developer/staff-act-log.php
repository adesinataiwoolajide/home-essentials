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
                <div class="panel-footer col-md-12">                                 
                    <a href="edit-staff-details.php?staff_number=<?php echo $details['staff_number']; ?>?>" class="btn btn-success pull-right">VIEW MORE ACTIVITIES</a>
                </div>
            </div>                                  
    		<?php
        } ?> 
    </div>         
</div>