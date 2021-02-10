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
<style type="text/css">
    #note p{
        padding: 10px;
        margin-left: 20px;
        margin-right: 20px;
        margin-bottom: 5px;
        background-color: #ccc;
        transition: linear background-color 0.3s;
    }
    #note p:hover{
        background-color: #eee;
        box-shadow: 0px 0px 10px #999;
    }
    #note{
        color: #333;
        padding-left: 20px;
        margin-left: 20px;
        text-decoration: none;

    }
</style>
<?php
require_once 'funcs/function.php';
require_once 'includes/config.php';
include 'includes/navigation.php';
include 'includes/dashboard.php';

$sql = $db->query("SELECT * FROM requests WHERE userid = '$user_id' ORDER BY id DESC ");
$sql1 = $db->query("SELECT * FROM cart WHERE orderid <> 0  AND uid = '$user_id' GROUP BY orderid ORDER BY carttime ");
?>
        <div class="col-md-9 body">
            <h4>Notification <i class="ti-hand-point-up"></i></h4>

            <?php while ($notification = mysqli_fetch_assoc($sql)) :?>
            <a href="request.php?req_id=<?= $notification['id'];?>" id="note"><p>
                <i class="ti-comment-alt"></i>
                <?php

                if($notification['userread'] == 0 && $notification['confirm'] == 1){

                    $product = $notification['product'];
                    $message = 'Congratulation !! Your Request For '.' '.$product.' '.'Has Been Confirmed We Will Call You For The Delivery';

                    echo $message;
                }

                if($notification['userread'] == 0 && $notification['confirm'] == 2){

                    $product = $notification['product'];
                    $message = 'Sorry !! Your Request For '.' '.$product.' '.'Has Been Rejected, Enjoy our Services';

                    echo $message;
                }
                

                ?>
             </p>
         </a>
         <?php endwhile ;?>
        </div>
        

            <?php while ($order = mysqli_fetch_assoc($sql1)) :?>
            <a href="orderview.php?order=<?= $order['orderid'];?>"><p><?php

                if($order['userread'] == 0 && $order['confirm'] == 1){

                    $product = $order['orderid'];
                    $message = 'Congratulation !! Your Order For Order Number '.' '.$product.' '.'Has Been Confirmed We Will Call You For The Delivery';

                    echo $message;
                }
                

                ?>
             </p>
         </a>
         <?php endwhile ;?>
        
    </div>
</div>
<?php include 'includes/footer.php'; ?>

