<?php
require_once'../includes/config.php';

require_once'../funcs/function.php';

$sqlrequest = $db->query("SELECT readi,count(user) AS count FROM requests WHERE readi = 0");
$request = mysqli_fetch_assoc($sqlrequest);

$sql = $db->query("SELECT confirm,count(orderid) AS count FROM cart WHERE orderid <> 0 AND confirm = 0 GROUP BY orderid");
$order = mysqli_fetch_assoc($sql);
?>
<div class="container-fluid" id="dash">
    <div class="row">
        <div class="col-md-3" id="menu">
            <div class="side_menu">
                <ul>
                    <h4 class="text-center">
                        ADMIN DASHBOARD <i class="fa fa-dashboard"></i>
                    </h4>
                    <li><a href="index.php" class=""> <i class="ti-home"></i> Home </a></li>
                    <li class="drop">

                        <a href="ordersrecieved.php"><i class="ti-shopping-cart"></i> Orders <span class="badge"><?php if($order['count'] > 0){echo 'new';};?></span></a>
                        <!-- <ul class="dropmenu droptatu">
                            <li class="blue"><a href="ordersrecieved.php"> <i class="ti-support"></i> Recieved</a></li>
                            <li class="green"><a href="ordersdone.php"> <i class="ti-receipt"></i> Delivered</a></li>
                            <li class="yellow"><a href="ordersdate.php"> <i class="ti-gift"></i> Special</a></li>
                        </ul> -->
                    </li>
                    <li class="drop">
                        <a><i class="ti-tag"></i> Products</a>
                        <ul class="dropmenu dropmbili">
                            <li class="blue"><a href="addproduct.php"> <i class="ti-archive"></i> Add Product</a></li>
                            <li class="green"><a href="products.php"> <i class="ti-layout-grid3"></i> View Products</a></li>                            
                        </ul>
                    </li>
                    <li><a href="categories.php" class=""> <i class="ti-layers-alt"></i> Categories </a></li>
                    <li><a href="adverts.php" class=""> <i class="ti-image"></i> Adverts </a></li>
                    <li><a href="request.php"> <i class="ti-comment-alt"></i> Request 

                        <span class="badge">
                            <?php if($request['readi'] == 0)
                                    {
                                        echo $request['count'];

                                    }

                                    else
                                        {' ';};?>
                                        
                                    </span></a></li>
                    <?php if(has_permission('admin')):?>
                    <li class="drop">
                        <a><i class="ti-user"></i> Users</a>
                        <ul class="dropmenu dropmbili">
                            <li class="blue"><a href="adduser.php"> <i class="ti-face-smile"></i> Add User</a></li>
                            <li class="green"><a href="users.php"> <i class="ti-eye"></i> View Users</a></li>
                        </ul>
                    </li>
                <?php endif;?>
                    <li class="drop">
                        <a><i class="ti-settings"></i> Settings </a>
                        <ul class="dropmenu dropmbili">
                            <li class="blue"><a href="mydetails.php"> <i class="ti-id-badge"></i> My details</a></li>
                            <li class="green"><a href="changepassword.php"> <i class="ti-key"></i> Change password</a></li>
                        </ul>
                    </li>
               
                    <li><a href="logout.php"> <i class="ti-power-off"></i> Logout </a></li>
                </ul>
                <ul>
                    <address class="text-center">&copy; Copyright SOKONI 2019</address>
                </ul>
            </div>
        </div>