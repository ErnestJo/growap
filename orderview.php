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



if(isset($_GET['order']) && $_GET['order'] !=''){
  $uid = $_GET['order'];

  $sql = $db->query("SELECT * FROM cart WHERE orderid = '$id'");
                            $req = mysqli_fetch_assoc($sql);
                        $qts = "UPDATE cart SET userread='1' WHERE orderid = '$uid'";

                    $db->query($qts);


$sql = $db->query ("SELECT SUM(price * quantities) AS grandtotal
    FROM cart WHERE orderid = '$uid'  ");
$sql1 = $db->query ("SELECT * FROM product,customer,cart 
    WHERE product.pid = cart.pid AND customer.id = cart.uid AND cart.orderid = '$uid' AND cart.uid = '$user_id'
    ORDER BY cart.carttime DESC ");

$sql2 = $db->query ("SELECT * FROM product,customer,cart 
    WHERE product.pid = cart.pid AND customer.id = cart.uid AND cart.orderid = '$uid' AND cart.uid = '$user_id'
    ORDER BY cart.carttime DESC ");


$user = mysqli_fetch_assoc($sql);
$order = mysqli_fetch_assoc($sql2);

?>
        <div class="col-md-9 body">
            <h4>Orders ID:<?=$uid;?> <a class="pull-right">TOTAL: <?=$user['grandtotal'];?></a></h4>
            <div class="table-data">
                <p><b>Supermarket Contacts:</b> 0718 248525</p>
                <p><b>Order Status:</b> <?php if ($order['confirm'] == 1) {
                    echo 'CONFIRMED';
                }else{
                        echo 'PENDING';
                }?></p>
                <p><b>Delivery:</b>
                    <?php
                        if ($order['deliver'] == 1) {
                            
                            echo 'YES';
                        }else

                        {

                            echo 'NO';

                        }
                    ?>
                 </p>
                <table class="table table-bordered table-responsive table-condensed">
                    <tr class="bg-danger">
                        <th>ITEM</th>
                        <th class="text-center">QUANTITY</th>
                        <th class="text-center">UNIT_PRICE</th>
                        <th class="text-center">SUB_TOTAL</th>
                    </tr>
                    <?php while ($carti = mysqli_fetch_assoc($sql1)) : 

                        $subtotal = $carti['price'] * $carti['quantities'];

                        ?>
                    <tr>
                        <td>
                            <div class="media">
                                <div class="media-left">
                                    <img src="<?=$carti['images'];?>" class="media-object">            
                                </div>
                                <div class="media-body">
                                   <?=$carti['name'];?>
                                </div>
                            </div>
                            
                        </td>
                        <td class="text-center quantity">
                            <h5><?=$carti['quantities'];?></h5>
                        </td>
                        <td class="text-center price"><?=$carti['price'];?></td>
                        <td class="text-center price"><?=$subtotal;?></td>  
                    </tr>
                <?php endwhile ;?>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; } ?>