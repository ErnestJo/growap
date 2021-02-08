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
$hashed = $userdata['password'];
$old_password = ((isset($_POST['old_password']))?clean($_POST['old_password']):'');
$old_password = trim($old_password);
$password = ((isset($_POST['password']))?clean($_POST['password']):'');
$password = trim($password);
$confirm = ((isset($_POST['confirm']))?clean($_POST['confirm']):'');
$confirm = trim($confirm);
$new_hashed = password_hash($password,PASSWORD_DEFAULT);
$user_id = $userdata['id'];
$errors  = array();

        if ($_POST) {
            //form validation
            if (empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])) {
                $errors[] = 'You must fill all fields';
            }
                elseif (!Password_verify($old_password,$hashed)) {
                    $errors[] = 'Incorrect Old password!. Please try again';
                }
            //check if password is more than 6 characters
                elseif (strlen($password) < 6) {
                    $errors[] = 'Password too short, must be atleast 6 characters';
                }

            // check if new password matches confirm
                elseif ($password != $confirm) {
                    $errors[] = 'New Password and Confirm New password fields do not match!';
                }
                else{
                    //change password
                    $db->query("UPDATE users SET password = '$new_hashed' WHERE id = '$user_id'");
                    $_SESSION['success'] = 'Your password has been changed succesifully';
                    header('Location: index.php');
                }
        }
?>
        <div class="col-md-9 body">
            <div><?php if(!empty($errors)){echo show_errors($errors);};?></div>
            <h3>Change Password <i class="ti-key"></i></h3>
            <div class="col-md-4 col-md-offset-4" id="chg_pass">
                    <h4 class="text-center text-danger">CHANGE PASSWORD</h4>
                    <hr>
                    <form action="changepassword.php" method="post">
        <div class="form-group">
            <input type="password" placeholder="Old Password" name="old_password" id="old_password" class="form-control" value="<?=$old_password;?>">
        </div>
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
