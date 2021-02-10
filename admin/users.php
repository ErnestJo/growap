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
    if(!has_permission('admin')){
    login_error_redirect_admin();
}
include 'includes/navigation.php';
include 'includes/dashboard.php';

if (isset($_GET['delete'])) {
        $delete_id = clean($_GET['delete']);
        $db->query("DELETE FROM users WHERE id = '$delete_id'");
        $_SESSION['success_flash'] = 'User has been deleted';
       header('Location:users.php');
    }

$sqlusers = $db->query("SELECT * FROM users  WHERE id <>  '$userid' ORDER BY fullname");
$sqlclient = $db->query("SELECT * FROM customer ORDER BY fullname");
?>


        <div class="col-md-9 body">
            <h3>Users <i class="ti-eye"></i></h3>
            <div class="col-md-10 col-md-offset-1" id="users">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active">
                        <a data-toggle="tab" href="#staffs">STAFFS</a>
                        </li>
                        <li>
                        <a data-toggle="tab" href="#clients">CLIENTS</a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div id="staffs" class="tab-pane fade in active">
                            <table class="table table-condensed">
                                <tr class="bg-danger">
                                    <th class="text-center">STAFF NAME</th>
                                    <th class="text-center">EMAIL</th>
                                    <th class="text-center">DELETE</th>
                                    <th class="text-center">PASSWORD</th>
                                </tr>
                                <?php while ($user = mysqli_fetch_assoc ($sqlusers)) : ?>
                                <tr>
                                    <td class="text-center"><?=$user['fullname'];?></td>
                                    <td class="text-center"><?=$user['email'];?></td>
                                    <td class="text-center"><a href="users.php?delete=<?= $user['id'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
                                    <td class="text-center"><a href="changepass.php?user=<?= $user['id'];?>" class="btn btn-sm btn-danger"><i class="fa fa-pencil"></i></a></td>
                                </tr>
                            <?php endwhile ;?>
                                
                            </table>
                        </div>
                        <div id="clients" class="tab-pane fade">
                            <table class="table table-condensed">
                                
                                <tr class="bg-danger">
                                    <th class="text-center">CLIENT NAME</th>
                                    <th class="text-center">EMAIL</th>
                                    <th class="text-center">MOBILE NUMBER</th>
                                </tr>
                                <?php while ($client = mysqli_fetch_assoc($sqlclient)) :?>
                                <tr>
                                    <td class="text-center"><?= $client['fullname'];?></td>
                                    <td class="text-center"><?=$client['email'];?></td>
                                    <td class="text-center">(0)<?=$client['phone'];?></td>
                                </tr>
                            <?php endwhile ;?>
                            </table>    
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
