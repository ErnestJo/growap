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
    <link href="../plugin/pages/admin_settings.css" rel="stylesheet">

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
                    <h3>PERSONAL INFOMATION <i class="ti-id-badge"></i></h3>
            <div class="row">
                <div class="col-md-12">
                    <div id="details">
                        <h4>Full Name: <small>not yet</small></h4>
                        <h4>Email Address: <small>not yet</small></h4>
                        <h4>Phone Number: <small>not yet</small></h4>
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
