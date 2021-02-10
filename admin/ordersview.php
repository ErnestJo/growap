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


?>
        <div class="col-md-9 body">
            <h3>
                Ernest Joseph's Order Item(s) 
                <a href="order_recieved.html" class="pull-right btn btn-sm btn-info">BACK</a>
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <dl class="col-md-6">
                        <dt>CUSTOMER NAME</dt>
                            <dd>Ernest Joseph</dd>
                        <dt>LOCATION</dt>
                            <dd>Kimara</dd>
                        <dt>PHONE NUMBER</dt>
                            <dd>0710663944</dd>
                    </dl>
                    <dl class="col-md-6">
                        <dt>EMAIL</dt>
                            <dd>Ernestjoju@gmail.com</dd>
                        <dt>ORDER ID</dt>
                            <dd>1232785</dd>
                        <dt>PRICE</dt>
                        <dd>43000/=Tshs</dd>

                    </dl>
                    <table class="table table-responsive table-condensed">
                        <tr class="bg-primary">
                            <th class="text-center">PRODUCT(S)</th>
                            <th class="text-center">NAME / DESCRIPTION</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">AMOUNT PER (ITEM)</th>
                            <th class="text-center">AMOUNT (FOR ALL)</th>
                        </tr>
                        <tr>
                            <td><img src="../imgs/prod/toi.jpg" class="img-responsive center-block"></td>
                            <td class="text-center">OMO - 1 Kg</td>
                            <td class="text-center">5</td>
                            <td class="text-center">2000</td>
                            <td class="text-center">10000</td>  
                        </tr>
                        <tr>
                            <td><img src="../imgs/prod/oil.jpg" class="img-responsive center-block"></td>
                            <td class="text-center">Coconut Oil</td>
                            <td class="text-center">2</td>
                            <td class="text-center">1500</td>
                            <td class="text-center">3000</td>  
                        </tr>
                        <tr>
                            <td><img src="../imgs/prod/meat.jpg" class="img-responsive center-block"></td>
                            <td class="text-center">Beef Meat - 2 Kg</td>
                            <td class="text-center">1</td>
                            <td class="text-center">15000</td>
                            <td class="text-center">15000</td>  
                        </tr>
                        <tr>
                            <td><img src="../imgs/prod/chocolate.jpg" class="img-responsive center-block"></td>
                            <td class="text-center">Sneakers Chocolate</td>
                            <td class="text-center">10</td>
                            <td class="text-center">1500</td>
                            <td class="text-center">15000</td>  
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-info pull-right">SEND AN ORDER CONFIRMATION</button>
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
</script>

<script src="plugin/js/menu_slide.js"></script>


</body>

</html>
