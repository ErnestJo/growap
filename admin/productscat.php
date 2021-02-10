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
    <link href="../plugin/pages/admin_product.css" rel="stylesheet">

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

if(isset($_GET['category']) && $_GET['category']!=''){
 $cat = $_GET['category']; 

$sql1 = $db->query("SELECT * FROM product GROUP BY category");


if(isset($_GET['del']) && $_GET['del']!=''){
    $del_id = (int)$_GET['del'];
    $db->query("DELETE FROM product WHERE pid = '$del_id'");
    //header('Location: products.php');
}




$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
                $limit = 24;

                $startpoint = ($page * $limit) - $limit;
                $statement = "product WHERE category = '$cat' ORDER BY pid DESC"; //you have to pass your query over here
                $sql = $db->query("SELECT * FROM {$statement} LIMIT {$startpoint} , {$limit} ");
?>
        <div class="col-md-9 body">
            <h3>
               Our Products <i class="ti-tag"></i> 
                <a href="addproduct.php" class="pull-right btn btn-sm btn-info">Add Products</a>
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-3 filters">
                    <h4 class="text-uppercase text-info"><b>Categoeries</b></h4>
                    <ul>
                        <?php 
                            while($cat = mysqli_fetch_assoc ($sql1) ): ?>        
                    
                        <li><a href="productscat.php?category=<?=$cat['category'];?>"><?=$cat['category'];?></a></li>

                    <?php endwhile;?>
                         
                    </ul>
                </div>
                <div class="col-md-9 products">
                    <?php while ( $products = mysqli_fetch_assoc ($sql)):
                    
                     ?>
                    <div class="col-md-3">
                        <div class="card">
                          <img src="<?=$products['images'];?>" alt="Avatar" style="width:100%">
                          <div class="card_box">
                            <p class="text-center"><?=$products['name'];?></p> 
                            <p class="text-center">Available:<?=$products['quantity'];?></p> 
                            <p class="text-center"><?=$products['price'];?> Tshs</p> 
                            <p class="text-center"><a href="addproduct.php?edit=<?=$products['pid'];?>" class="btn btn-block btn-sm btn-primary">EDIT</a></p>
                            <p class="text-center"><a href="products.php?del=<?=$products['pid'];?>" class="btn btn-block btn-sm btn-info">DELETE</a></p>
                          </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                   
                </div>
            </div>
            <center>
                  <?php 

                echo pagination($statement,$limit,$page);

                ?>
              </center>
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
<?php };?>
