<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SOKONI | Orders</title>


    <link href="plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugin/animations/animate.css" rel="stylesheet">

    <link href="plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugin/themify/themify-icons.css" rel="stylesheet">

    <link href="plugin/pages/common.css" rel="stylesheet">
    <link href="plugin/pages/user_common.css" rel="stylesheet">
    <link href="plugin/pages/user_order.css" rel="stylesheet">

    
</head>
<?php
require_once 'funcs/function.php';
require_once 'includes/config.php';
include 'includes/navigation.php';
include 'includes/dashboard.php';


if (isset($_GET['delete'])) {
        $delete_id = clean($_GET['delete']);
        $db->query("DELETE FROM cart WHERE orderid = '$delete_id'");
        $_SESSION['success_flash'] = 'Order has been deleted';
        header('Location: ordersreceived.php');
    }

$sql = $db->query ("SELECT *, SUM(cart.price * cart.quantities) AS grandtotal FROM product,customer,cart 
    WHERE product.pid = cart.pid 
    AND customer.id = cart.uid AND cart.uid = '$user_id'
    AND cart.deliver = 0 AND cart.orderid <> 0 
    GROUP BY cart.orderid
    ORDER BY cart.deliver ASC ");




?>
        <div class="col-md-9 body">
        <h4>Pending Orders <i class="ti-support"></i></h4>
            <div class="table-data">
                <table class="table table-condensed">
                    <tr class="bg-danger">
                        <th class="text-center">ORDER ID</th>
                        <th class="text-center">ORDER PRICE</th>
                        <th class="text-center">ORDER STATUS</th>
                        <th class="text-center">SUPERMARKET PHONE</th>
                        <!-- <th class="text-center">DELIVERY TYPE</th>
                        <th class="text-center">DELIVERED</th> -->
                        <th class="text-center">ACTION</th>
                    </tr>
                    <?php while ( $cart = mysqli_fetch_assoc($sql)): ?>
                    <tr>
                        <td class="text-center"><?=$cart['orderid'];?></td>
                        <td class="text-center"><?=$cart['grandtotal'];?></td>
                        <td class="text-center">
                            <?php 

                            if ($cart['confirm'] == 1) {
                                
                                echo 'CONFIRMED';
                            }
                            else{

                                echo 'PENDING';

                            }

                            ?>
                        </td>
                        <td class="text-center">0718248525</td>
                        <!-- <td class="text-center">HANDPICKUP</td>
                        <td class="text-center">NO</td> -->
                        <td class="text-center">
                            <a  href="orderview.php?order=<?= $cart['orderid'];?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a> | 
                            <a href="ordersreceived.php?delete=<?= $cart['orderid'];?>" class="btn btn-sm btn-danger" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> 
                        </td>
                    </tr>
                <?php endwhile ;?>
                    
                </table>
            </div>
            
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>