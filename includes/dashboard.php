<?php
require_once 'funcs/function.php';
require_once 'includes/config.php';

 
$sql2 = $db -> query("SELECT COUNT(orderid) AS count FROM cart WHERE uid = '$user_id' AND orderid <> 0 AND confirm = 1 AND userread = 0 AND deliver = 0 ");
$sql1 = $db -> query("SELECT COUNT(orderid) AS count FROM cart WHERE uid = '$user_id' AND orderid <> 0 AND confirm = 1 AND userread = 0 AND deliver <> 0");
$not = mysqli_fetch_assoc ($sql2);
$notdel = mysqli_fetch_assoc ($sql1);


?>
<div class="container" id="orders_section">
    <div class="row">
        <div class="col-md-3 menu">
            <ul>
                <h4 class="text-center">Menu</h4>
                <li class=""><a href="dashboard.php"><i class="ti-hand-point-up"></i> Notification</a></li>
                <li class="drop">
                    <a><i class="ti-shopping-cart"></i> Orders
                     <?php 

                            if ($not['count'] > 0  || $notdel['count'] > 0)  {
                                

                                echo ' <span class="badge">new</span></a>';
                            }
                            else{

                                echo ' ';
                            }

                        ?></a>
                    <ul class="dropmenu1">
                        <li class="blue"><a href="ordersreceived.php"> <i class="ti-support"></i> Sent<?php 

                            if ($not['count'] > 0)  {
                                

                                echo ' <span class="badge">new</span></a>';
                            }
                            else{

                                echo ' ';
                            }

                        ?></a></li>
                        <li class="green"><a href="ordersdone.php"> <i class="ti-receipt"></i> Delivered <?php 

                            if ($notdel['count'] > 0)  {
                                

                                echo '<span class="badge">new</span></a>';
                            }
                            else{

                                echo ' ';
                            }

                        ?></a></li>
                    </ul>
                </li>
                <li class=""><a href="request.php"><i class="ti-comment-alt"></i> My Request</a></li>
                <li class="drop">
                    <a><i class="ti-user"></i> Personal Information</a>
                    <ul class="dropmenu">
                        <li class="blue"><a href="userdetails.php"> <i class="ti-id-badge"></i> View Details</a></li>
                        <li class="green"><a href="changedetails.php"> <i class="ti-pencil-alt"></i> Change Details</a></li>
                        <li class="yellow"><a href="changepassword.php"><i class="ti-key"></i>Change Password</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>