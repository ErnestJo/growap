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

<style type="text/css">
    .badge-new{
        z-index: 9000000;
        top: -200px;
        color: white;
        padding: 15px;
        position: relative;
        font-size: 20px;
        background: #a00000;
        box-shadow: 0px 0px 5px #333;
    }
    .body .media{
        padding: 5px;
        margin-top: 10px; 
        background-color: whitesmoke;
        box-shadow: 0px 0px 10px #aaa;
    }
    .prod-img{
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
</style>

<body>
<?php
require_once '../funcs/function.php';
include '../includes/config.php'; 
if(!is_loggedin()){
    login_error_redirect();
}

$bestproducts = $db->query("SELECT *, sum(cart.quantities) AS count FROM product,cart WHERE cart.pid = product.pid AND cart.confirm = '1' AND cart.deliver = '1' GROUP BY cart.pid ORDER BY count DESC LIMIT 3");


include 'includes/navigation.php';
include 'includes/dashboard.php';
?>
        <div class="col-md-9 body">
            <h3>Home</h3>
            <div class="row">
                <h1>Top Products</h1>
                <?php $c = 1;?>
                <?php while($prod = mysqli_fetch_assoc($bestproducts)):

                    $sales = $prod['price'] * $prod['count'];

                    ?>



                <div class="col-md-4">
                    <div class="media">
                        <img src="<?=$prod['images'];?>" class="prod-img">
                        <b class="badge-new"><?php 
                            echo $c.' <i class="fa fa-shirtsinbulk"></i>';
                            $c++;
                        ?></b>
                        <p>Name : <?=$prod['name'];?>
                            
                            <?php 
                                if ($prod['detail'] != '') {
                                    echo '/'.$prod['detail'];
                                }
                                else{

                                    echo '';
                                }

                            ?>
                        </p>
                        <p>Category  <?=$prod['category'];?></p>
                        <p>Price : <?=$prod['price'];?> Tshs</p>
                        <p>Quantity Bought :<?=$prod['count'];?></p>
                        <p>Sales :<?=$sales;?> Tshs </p>
                        <a href="addproduct.php?edit=<?=$prod['pid'];?>" class="btn btn-block btn-info">UPDATE</a>
                    </div>
                </div>
                <?php endwhile ;?>
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
