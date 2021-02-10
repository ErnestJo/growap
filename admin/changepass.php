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
    <link href="../plugin/pages/index.css" rel="stylesheet">

</head>

<body>
<?php
include 'includes/navigation.php';
include 'includes/dashboard.php';


if(!is_loggedin()){
        login_error_redirect();
    }

if(isset($_GET['user']) && $_GET['user'] !=''){
  $id = $_GET['user'];


    

$password = ((isset($_POST['password']))?clean($_POST['password']):'');
$password = trim($password);
$confirm = ((isset($_POST['confirm']))?clean($_POST['confirm']):'');
$confirm = trim($confirm);
$new_hashed = password_hash($password,PASSWORD_DEFAULT);
$errors  = array();

        if ($_POST) {
            //form validation
            
            //check if password is more than 6 characters
                if (strlen($password) < 6) {
                    $errors[] = 'Password too short, must be atleast 6 characters';
                }

            // check if new password matches confirm
                elseif ($password != $confirm) {
                    $errors[] = 'New Password and Confirm New password fields do not match!';
                }
                else{
                    //change password
                    $db->query("UPDATE users SET password = '$new_hashed' WHERE id = '$id'");
                    $_SESSION['success'] = 'Password has been changed succesifully';
                   echo "<script>window.location.replace('users.php');</script>";
                
                }
        }
?>
        <div class="col-md-9 body">
            <div><?php if(!empty($errors)){echo show_errors($errors);};?></div>
            <h3>Change Password <i class="ti-key"></i></h3>
            <div class="col-md-4 col-md-offset-4" id="chg_pass">
                    <h4 class="text-center text-danger">CHANGE PASSWORD</h4>
                    <hr>
                    <form action="changepass.php?user=<?= $id;?>" method="post">
        
        <div class="form-group">
            <input type="password" name="password" placeholder="New Password" id="password" class="form-control" value="<?=$password ;?>">
        </div>
        <div class="form-group">
            <input type="password" name="confirm" placeholder="Confirm Password" id="confirm" class="form-control" value="<?=$confirm ;?>">
        </div>
        <div class="form-group">
        <a href="index.php" class="btn btn-danger">Cancel</a>
            <input type="submit" value="Submit" class="btn btn-primary">
        </div>
    </form>
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
<?php } ;?>