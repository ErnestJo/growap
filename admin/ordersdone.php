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
    AND customer.id = cart.uid AND cart.uid = '$user_id'
    AND cart.confirm = 1 AND cart.orderid <> 0 
    GROUP BY cart.orderid
    ORDER BY cart.id DESC ");

?>
        <div class="col-md-9 body">
            <h3>Delivered Orders <i class="ti-receipt"></i></h3>
            <hr>
            <div class="row">
                <div class="col-md-9">
                    <table class="table table-condensed">
                        <tr class="bg-primary">
                            <th class="text-center">ORDER ID</th>
                        <th class="text-center">ORDER PRICE</th>
                        <th class="text-center">ORDER STATUS</th>
                        <th class="text-center">SUPERMARKET PHONE</th>
                        
                        <th class="text-center">ACTION</th>
                    </tr>
                    <?php while ( $cart = mysqli_fetch_assoc($sql)): ?>
                    <tr>
                        <td class="text-center"><?=$cart['orderid'];?></td>
                        <td class="text-center">12000</td>
                        <td class="text-center">PENDING</td>
                        <td class="text-center"><?=$cart['orderid'];?></td>
                       
                        <td class="text-center">
                            <a  href="orderedit.php" class="btn btn-sm btn-info"><i class="ti-pencil-alt"></i></a> |
                            <a  href="orderview.php?order=<?= $cart['orderid'];?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a> | 
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button> 
                        </td>
                    </tr>
                <?php endwhile ;?>
                    </table>
                </div>
                <div class="col-md-3 filters">
                    <h4>Filter Area <i class="ti-filter"></i></h4>
                    <form>
                        <div class="form-group">
                            <label>Filter by</label>
                            <input type="text" name="" class="form-control" placeholder="Filter by which column name...">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="" class="form-control btn btn-primary" value="FILTER">
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
</script>

<script src="plugin/js/menu_slide.js"></script>


</body>

</html>
