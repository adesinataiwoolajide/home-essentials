<?php
    session_start();
    include("../header.php");
    include("../side-bar.php");
    require '../../libs_dev/products/products_class.php';
    $productsCate = new ragzNationProductsCategory($db);
    $productDetails = new ragzNationProducts($db);
    $email = $_SESSION['user_name'];
   
?>
<ul class="breadcrumb">
    <li><a href="./">Home</a></li>     
    <li><a href="customer-orders.php"><i class="fa fa-shopping-cart"></i> Customer Order</p></a></li>                 
    
    <li class="active">View all Orders</li>   
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

               // if($productDetails->checkingProductOrders(){ 
               //  }else{ 

                    ?>
                    <div class="panel-heading">
                        <h3 class="panel-title">List of All New Orders</h3>
                        <?php include("../table-modal.php"); ?>
                    </div>
                    <div class="panel-body">
                         <table id="customers2" class="table datatable">
                            <thead align="center">
                                <tr>
                                    <th>S/N</th>
                                    <th>Customer ID</th>
                                    <th>Order ID</th>
                                    <td>Sub Total</td>
                                    <td>Shipping Fee</td>
                                    <td>Total</td>
                                    <td>Payment Status</td>
                                    <td>Operations</td>
                                </tr>
                            </thead>
                            <tbody><?php 
                                $y=1;
                                foreach($productDetails->gettingAllProductOrdered() as $orders){ ?>
                                    <tr>
                                        <td><?php echo $y ?></td>
                                        <td><?php echo $orders['customer_id'] ?></td>
                                        <td><?php echo $order_id = $orders['order_id'] ?></td>
                                        <td>&#8358;<?php echo number_format($orders['subtotal']) ?></td>
                                        <td>&#8358;<?php echo number_format($orders['shipping_charge']) ?></td>
                                        <td>&#8358;<?php echo number_format($orders['amount']) ?></td>
                                        
                                        <td><?php 
                                            $status = $orders['paid_status'];
                                            if($status ==1 ){ ?>
                                                <p style="color: green" align="center">Paid</p><?php
                                            }else{ ?>
                                                <p style="color: red" align="center">Pending</p><?php
                                            } ?>    
                                        </td>
                                        <td><a href="order-details.php>order_id=<?php echo $order_id ?>">More Details</a></td>
                                    </tr><?php $y++;
                                } ?>
                            </tbody>
                        </table> 
                    </div>
            </div>
        </div>
    </div>    
</div>        

<?php
    include("../log-out-modal.php");
    include("../table-footer.php");
?>
