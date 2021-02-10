<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SOKONI| Settings</title>


    <link href="../plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugin/animations/animate.css" rel="stylesheet">

    <link href="../plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../plugin/themify/themify-icons.css" rel="stylesheet">

    <link href="../plugin/pages/common.css" rel="stylesheet">
    <link href="../plugin/pages/admin_common.css" rel="stylesheet">

    <style type="text/css">

        .body{
            padding-left: 0px;
            padding-right: 0px;
        }
        .body h3{
            color: #fff;
            padding: 10px;
            margin-top:0;
            margin-bottom:0;
            cursor: pointer; 
            background-color: #a00000;
            border-radius: 3px 3px 0 0;
            border-bottom: 3px solid silver;
        }
        .body #details{
            padding: 20px;
            padding-bottom: 130px;
            box-shadow: 0px 0px 10px #ccc;
        }
        
        .text-danger{
            color: #a00000;
        }
        .bg-danger{
            color: #fff;
            background-color: #a00000;
        }
        .btn-danger{
            color: #fff;
            border:none;
            background-color: #a00000;
        }
        #dash .body{
            height: 95vh;
            overflow: hidden;
        }

        #add-user{
            padding: 20px;
            box-shadow: 0px 0px 10px #bbb;
        }
        #staffs,#clients{
            height: 88vh;
            overflow: auto!important;
        }
    </style>
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
            <div class="row">
                <div class="col-md-8">
                    <h3>PERSONAL INFOMATION</h3>
                    <div id="details">
                        <h4>Full Name: <small>Ernest Joseph</small></h4>
                        <h4>Email Address: <small>ernestjoju@gmail.com</small></h4>
                        <h4>Phone Number: <small>+255 710 663944</small></h4>
                    </div>
                </div>
                <div class="col-md-4" id="add-user">
                    <h4 class="text-center text-danger">CHANGE PASSWORD</h4>
                    <hr>
                    <form>
                        <div class="form-group form-group-sm">
                            <label>Old Password</label>
                            <input type="password" name="" class="form-control" placeholder="******">
                        </div>
                        <div class="form-group form-group-sm">
                            <label>Confirm Password</label>
                            <input type="password" name="" class="form-control" placeholder="******">
                        </div>
                        <div class="form-group form-group-sm">
                            <input type="submit" name="" class="btn btn-sm btn-block btn-primary" value="SUBMIT">
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
