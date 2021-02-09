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


if(isset($_GET['order']) && $_GET['order'] !=''){
  $order = $_GET['order'];

  $sql2= $db->query ("SELECT SUM(price * quantities) AS grandtotal
    FROM cart WHERE orderid = '$order'  ");

  $sql1 = $db->query ("SELECT * FROM product,customer,cart 
    WHERE product.pid = cart.pid AND customer.id = cart.uid AND cart.orderid = '$order'
    ORDER BY cart.carttime DESC ");
  $sql = $db->query ("SELECT * FROM product,customer,cart 
    WHERE product.pid = cart.pid AND customer.id = cart.uid AND cart.orderid = '$order'
    ORDER BY cart.carttime DESC ");

  $sql3 = $db->query ("SELECT * FROM cart WHERE orderid = '$order' ");

        $uid = mysqli_fetch_assoc($sql1);

        $grandtotal = mysqli_fetch_assoc($sql2);
        $deliver = mysqli_fetch_assoc($sql3);

?>
        <div class="col-md-9 body">
            <h3>
                <?=ucwords($uid['fullname']);?>'s Order Item(s) 
                <div class="pull-right"><?=$grandtotal['grandtotal'];?> Tshs</div>
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <dl class="col-md-6">
                        <dt>CUSTOMER NAME</dt>
                            <dd><?=ucwords($uid['fullname']);?></dd>
                        <dt>LOCATION</dt>
                            <dd><?=$uid['location'];?></dd>
                        <dt>PHONE NUMBER</dt>
                            <dd><?=$uid['phone'];?></dd>
                    </dl>
                    <dl class="col-md-6">
                        <dt>EMAIL</dt>
                            <dd><?=ucwords($uid['email']);?></dd>
                        <dt>ORDER ID</dt>
                            <dd><?=$uid['orderid'];?></dd>

                        <?php
                            if ($uid['deliver'] == 1) {
                                echo '<dt>Delivery Time</dt>'.''.'<dd>'.$uid['carttime'].'</dd>';
                            }
                        ?>
     

                    </dl>
                    <table class="table table-responsive table-condensed">
                        <tr class="bg-primary">
                            <th class="text-center">PRODUCT(S)</th>
                            <th class="text-center">NAME / DESCRIPTION</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">AMOUNT PER (ITEM)</th>
                            <th class="text-center">AMOUNT (FOR ALL)</th>
                        </tr>
                        <?php while ( $items = mysqli_fetch_assoc($sql)) :

                            $subtotal = $items['price'] * $items['quantities'];

                            ?>
                        <tr>
                            <td><img src="<?=$items['images'];?>" class="img-responsive center-block"></td>
                            <td class="text-center"><?=$items['name'];?></td>
                            <td class="text-center"><?=$items['quantities'];?></td>
                            <td class="text-center"><?=$items['price'];?></td>
                            <td class="text-center"><?=$subtotal;?></td>  
                        </tr>
                        <?php endwhile ;?>
                    </table>
                    
                        <?php

                        $uid = $uid['confirm'] ;
                        $del = $deliver['deliver'] ;

                        if ($uid == 0) {

                            

                           echo '<button type="submit" onclick="confirmorder'.'('.$order.')'.'" class="btn btn-info pull-right">CONFIRM OREDER</button>' ;
                        }
                        else if ($uid == 1 && $del == 0) {
                            
                                echo '<button type="submit" onclick="confirmorder'.'('.$order.')'.'" class="btn btn-info pull-right">ITEMS DELIVERED</button>' ;

                        }
                        else {

                            echo '';

                            

                        }

                        ?>
                    
                    </button>
                    <div class="col-md-12">
                        <hr>
                    </div>
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
<?php } ;?>