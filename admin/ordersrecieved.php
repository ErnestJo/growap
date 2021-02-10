<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SOKONI| Home</title>


    <link href="../plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugin/animations/animate.css" rel="stylesheet">

    <link href="../plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../plugin/themify/themify-icons.css" rel="stylesheet">

    <link href="../plugin/pages/common.css" rel="stylesheet">
    <link href="../plugin/pages/admin_common.css" rel="stylesheet">

</head>

<body>
<?php
require_once '../funcs/function.php';
include '../includes/config.php'; 
if(!is_loggedin()){
    login_error_redirect();
}
include 'includes/navigation.php';
include 'includes/dashboard.php';

$sql = $db->query ("SELECT * FROM product,customer,cart 
    WHERE product.pid = cart.pid 
    AND customer.id = cart.uid
    AND cart.confirm = 0 AND cart.orderid <> 0 
    GROUP BY cart.orderid
    ORDER BY cart.id DESC ");

$sqlc = $db->query ("SELECT * FROM product,customer,cart 
    WHERE product.pid = cart.pid 
    AND customer.id = cart.uid
    AND cart.confirm = 1 AND cart.orderid <> 0 
    GROUP BY cart.orderid
    ORDER BY cart.id DESC ");

$sqld = $db->query ("SELECT * FROM product,customer,cart 
    WHERE product.pid = cart.pid 
    AND customer.id = cart.uid
    AND cart.confirm = 1 AND cart.deliver = 1 AND cart.orderid <> 0 
    GROUP BY cart.orderid
    ORDER BY cart.id DESC ");
?>
        <div class="col-md-9 body">
            <h3>Recieved Orders <i class="ti-support"></i></h3>
            <hr>
            <div class="row">
                <div class="col-md-9">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active">
                        <a data-toggle="tab" href="#ship"><i class="ti-support"></i> RECIEVED ORDERS</a>
                        </li>
                        <li>
                        <a data-toggle="tab" href="#hand"><i class="ti-receipt"></i> CONFIRMED ORDERS</a>
                        </li>
                        <li>
                        <a data-toggle="tab" href="#rejected"><i class="ti-gift"></i> DELIVERED ORDERS</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="ship" class="tab-pane fade in active">
                            <table class="table table-condensed">
                                <tr class="bg-primary">
                                    <th class="text-center">CUSTOMER NAME</th>
                                    <th class="text-center">PHONE NUMBER</th>
                                    <th class="text-center">LOCATION</th>
                                    <th class="text-center">ORDER STATUS</th>
                                    <th class="text-center">ORDER NUMBER</th>
                                    <th class="text-center">DELIVERED</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                                <?php while ( $cart = mysqli_fetch_assoc($sql)): ?>
                                <tr>
                                    <td class="text-center"><?=ucwords($cart['fullname']);?></td>
                                    <td class="text-center">(+255) <?=$cart['phone'];?></td>
                                    <td class="text-center">KIMARA</td>
                                    <td class="text-center">
                                        <?php

                                        if($cart['confirm'] == 0){

                                            echo 'PENDING';
                                    }
                                    ?>

                                    </td>
                                    <td class="text-center"><?=$cart['orderid'];?></td>
                                    <td class="text-center">NO</td>
                                    <td class="text-center">
                                        <a  href="orderview.php?order=<?= $cart['orderid'];?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                        
                                    </td>
                                </tr>
                                <?php endwhile ;?>
                            </table>
                        </div>
                        <div id="hand" class="tab-pane fade">
                            <table class="table table-condensed">
                                <tr class="bg-primary">
                                    <th class="text-center">CUSTOMER NAME</th>
                                    <th class="text-center">PHONE NUMBER</th>
                                    <th class="text-center">ORDER ID</th>
                                    <th class="text-center">ORDER STATUS</th>
                                    <th class="text-center">DELIVERED</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                                <?php while ( $cart = mysqli_fetch_assoc($sqlc)): ?>
                                <tr>
                                    <td class="text-center"><?=ucwords($cart['fullname']);?></td>
                                    <td class="text-center">(+255) <?=$cart['phone'];?></td>
                                    <td class="text-center"><?=$cart['orderid'];?></td>
                                    <td class="text-center">
                                        <?php

                                        if($cart['confirm'] == 1){

                                            echo 'CONFIRMED';
                                    }
                                    ?>

                                    </td><td class="text-center">
                                        <!-- <form class="form-group-sm">
                                            <select class="form-control">
                                                <option>NO</option>
                                                <a href="ordersrecieved.php"><option onclick="confirmorder(<?=$cart['orderid'];?>);" >YES</option></a>
                                            </select>
                                        </form> -->

                                        <?php

                                        
                                        $deliver = $cart['deliver'];
                                        if($deliver == 0){

                                            echo '<button class="btn btn-sm btn-success"><i class="fa fa-check" onclick="confirmorder'.'('.$cart['orderid'].')'.'"></i></button>';
                                        }
                                        else{
                                                echo "YES";

                                        }

                                        ?>
                                        
                                    </td>
                                    <td class="text-center">
                                        <a  href="orderview.php?order=<?= $cart['orderid'];?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                        
                                    </td>
                                </tr>

                            <?php endwhile ;?>
                                
                            </table>
                        </div>
                        <div id="rejected" class="tab-pane fade">
                            <table class="table table-condensed">
                                <tr class="bg-primary">
                                    <th class="text-center">CUSTOMER NAME</th>
                                    <th class="text-center">PHONE NUMBER</th>
                                    <th class="text-center">ORDER ID</th>
                                    <!-- <th class="text-center">ORDER STATUS</th> -->
                                    <th class="text-center">DELIVERED DATE</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                                <?php while ( $cart = mysqli_fetch_assoc($sqld)): ?>
                                <tr>
                                    <td class="text-center"><?=ucwords($cart['fullname']);?></td>
                                    <td class="text-center">(+255) <?=$cart['phone'];?></td>
                                    <td class="text-center"><?=$cart['orderid'];?></td>
                                    <td class="text-center"><?=$cart['carttime'];?>
                                        <!-- <form class="form-group-sm">
                                            <a href="" onclick="confirmorder(<?=$uid['orderid'];?>);">
                                            <select class="form-control">
                                                <option>NO</option>
                                                <option >YES</option>
                                            </select>
                                        </a>
                                        </form> -->
                                        
                                    </td>
                                    <td class="text-center">
                                        <a  href="orderview.php?order=<?= $cart['orderid'];?>" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                        
                                    </td>
                                </tr>
                            <?php endwhile ;?>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 filters">
                    <h4>Filter Area <i class="ti-filter"></i></h4>
                    <form>
                        <div class="form-group">
                            <label class="text-uppercase text-info">ORDER STATUS</label>
                           <select class="form-control">
                                <option>-- SELECT --</option>
                                <option>PENDING</option>
                                <option>CONFIRMED</option>
                            </select>
                            
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary">FILTER</button>  
                        </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
</div>
<!-- JAVASCRIPT SECTIONS -->
<script src="../plugin/bootstrap/js/jquery-3.2.1.js"></script>
<script src="../plugin/bootstrap/js/bootstrap.min.js"></script>
<script src="../plugin/bootstrap/js/wow.min.js"></script>
<script>
    new WOW().init();


    function confirmorder(orderid){
                var orderid = orderid;
                $.ajax({
                  url:'confirmorder.php',
                  type:'POST',
                  data: {orderid:orderid},
                  success: function(){window.location.reload();},
                  error: function(){alert( "Something Went Wrong");},
                });
              }
</script>

<script src="plugin/js/menu_slide.js"></script>


</body>

</html>
