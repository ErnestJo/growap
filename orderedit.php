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
    <link href="plugin/pages/user_cart.css" rel="stylesheet">

    

</head>
<?php
require_once 'funcs/function.php';
require_once 'includes/config.php';
include 'includes/navigation.php';
include 'includes/dashboard.php';
?>
        <div class="col-md-9 body">
            <h4>Edited Order <a type="submit" class=" btn btn-info btn-sm pull-right">BACK</a></h4>
            <div class="row edit_body">
                <div class="col-md-8">
                    <table class="table table-bordered table-responsive table-condensed">
                        <tr class="bg-danger">
                            <th class="text-center">ITEM</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">PRICE</th>
                            <th class="text-center">SUBTOTAL</th>
                        </tr>
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="media-left">
                                        <img src="imgs/prod/toi.jpg" class="media-object">            
                                    </div>
                                    <div class="media-body">
                                        OMO - 1 Kg
                                        <br>                    
                                        <a>Remove</a>
                                    </div>
                                </div>
                                
                            </td>
                            <td class="text-center quantity">
                                <h5>
                                    <a class="text-danger"><i class="ti-arrow-circle-left"></i></a>
                                    1
                                    <a class="text-success"><i class="ti-arrow-circle-right"></i></a>
                                </h5>
                            </td>
                            <td class="text-center price">2000</td>
                            <td class="text-center price">10000</td>  
                        </tr>
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="media-left">
                                        <img src="imgs/prod/oil.jpg" class="media-object">            
                                    </div>
                                    <div class="media-body">
                                        Coconut Oil
                                        <br>
                                        <a>Remove</a>
                                    </div>
                                </div>
                                
                            </td>
                            <td class="text-center quantity">
                                <h5>
                                    <a class="text-danger" ><i class="ti-arrow-circle-left"></i></a>
                                    1
                                    <a class="text-success" ><i class="ti-arrow-circle-right"></i></a>
                                </h5>
                            </td>
                            <td class="text-center price">1500</td>
                            <td class="text-center price">3000</td>  
                        </tr>
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="media-left">
                                        <img src="imgs/prod/meat.jpg" class="media-object">            
                                    </div>
                                    <div class="media-body">
                                        Beef Meat -2 Kg
                                        <br>
                                        <a>Remove</a>
                                    </div>
                                </div>
                                
                            </td>
                            <td class="text-center quantity">
                                <h5>
                                    <a class="text-danger"><i class="ti-arrow-circle-left"></i></a>
                                    1
                                    <a class="text-success"><i class="ti-arrow-circle-right"></i></a>
                                </h5>
                            </td>
                            <td class="text-center price">15000</td>
                            <td class="text-center price">15000</td>  
                        </tr>
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="media-left">
                                        <img src="imgs/prod/chocolate.jpg" class="media-object">            
                                    </div>
                                    <div class="media-body">
                                        Sneakers Chocolate
                                        <br>
                                        <a>Remove</a>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center quantity">
                                    <h5>
                                        <a class="text-danger"><i class="ti-arrow-circle-left"></i></a>
                                        1
                                    <a class="text-success"><i class="ti-arrow-circle-right"></i></a>
                                </h5>
                            </td>
                            <td class="text-center price">1500</td>
                            <td class="text-center price">15000</td>  
                        </tr>
                    </table>                    
                </div>
                <div class="col-md-4">
                    <h4 class="text-info">Change Contact Information</h4>
                    <form>
                        <div class="form-group">
                            <label>FULL NAME</label>
                            <input type="text" name="" class="form-control" placeholder="FULL NAME">
                        </div>
                        <div class="form-group">
                            <label>PHONE NUMBER</label>
                            <input type="number" name="" class="form-control" placeholder="+255 700 000 000">
                        </div>
                        <div class="form-group">
                            <label>ADDRESS</label>
                            <input type="text" name="" class="form-control" placeholder="Mbezi/ Dar-es-Salaam">
                        </div>
                    </form>
                    <hr>
                    <h5 class="text-right"><small>TOTAL:</small><b>Tshs.43000</b></h5>
                    <hr>
                    <button type="submit" class="btn btn-info pull-right">RESEND ORDER REQUEST</button>
                </div>       
           </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>
