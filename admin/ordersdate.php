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
            <h3>Special Orders <i class="ti-gift"></i></h3>
            
            <hr>
            <div class="row">
                <div class="col-md-9">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active">
                        <a data-toggle="tab" href="#ship">SHIPPING ORDERS</a>
                        </li>
                        <li>
                        <a data-toggle="tab" href="#hand">HANDPICK UP ORDERS</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="ship" class="tab-pane fade in active">
                            <table class="table table-condensed">
                                <tr class="bg-primary">
                                    <th class="text-center">CUSTOMER NAME</th>
                                    <th class="text-center">PHONE NUMBER</th>
                                    <th class="text-center">ORDER DATE</th>
                                    <th class="text-center">ORDER STATUS</th>
                                    <th class="text-center">DELIVERED</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                                <tr>
                                    <td class="text-center">Ernest Joseph</td>
                                    <td class="text-center">0710663944</td>
                                    <td class="text-center">18-Nov-2018</td>
                                    <td class="text-center">PENDING</td>
                                    <td class="text-center">
                                        <form class="form-group-sm">
                                            <select class="form-control">
                                                <option>NO</option>
                                                <option>YES</option>
                                            </select>
                                        </form>
                                        
                                    </td>
                                    <td class="text-center">
                                        <a  href="order_view.html" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a> | 
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i></button> |
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button> 
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">Bukuru Henry</td>
                                    <td class="text-center">0718248525</td>
                                    <td class="text-center">12-FEB-2018</td>
                                    <td class="text-center">CONFIRMED</td>
                                    <td class="text-center">
                                        <form class="form-group-sm">
                                            <select class="form-control">
                                                <option>NO</option>
                                                <option>YES</option>
                                            </select>
                                        </form>
                                        
                                    </td>
                                    <td class="text-center">
                                        <a href="order_view.html" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a> | 
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i></button> |
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button> 
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div id="hand" class="tab-pane fade">
                            <table class="table table-condensed">
                                <tr class="bg-primary">
                                    <th class="text-center">CUSTOMER NAME</th>
                                    <th class="text-center">PHONE NUMBER</th>
                                    <th class="text-center">ORDER DATE</th>
                                    <th class="text-center">ORDER STATUS</th>
                                    <th class="text-center">DELIVERED</th>
                                    <th class="text-center">ACTION</th>
                                </tr>
                                <tr>
                                <td class="text-center">Ernest Joseph</td>
                                    <td class="text-center">0710663944</td>
                                    <td class="text-center">18-Nov-2018</td>
                                    <td class="text-center">PENDING</td>
                                    <td class="text-center">
                                        <form class="form-group-sm">
                                            <select class="form-control">
                                                <option>NO</option>
                                                <option>YES</option>
                                            </select>
                                        </form>
                                        
                                    </td>
                                    <td class="text-center">
                                        <a  href="order_view.html" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a> | 
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i></button> |
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button> 
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">Bukuru Henry</td>
                                    <td class="text-center">0718248525</td>
                                    <td class="text-center">29-Aug-2124</td>
                                    <td class="text-center">PENDING</td>
                                    <td class="text-center">
                                        <form class="form-group-sm">
                                            <select class="form-control">
                                                <option>NO</option>
                                                <option>YES</option>
                                            </select>
                                        </form>
                                        
                                    </td>
                                    <td class="text-center">
                                        <a href="order_view.html" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a> | 
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-refresh"></i></button> |
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button> 
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 filters">
                    <h4>Filter Area <i class="ti--filter"></i></h4>
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
</script>

<script src="plugin/js/menu_slide.js"></script>


</body>

</html>
