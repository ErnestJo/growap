<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SOKONI | Personal Info</title>


    <link href="plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugin/animations/animate.css" rel="stylesheet">

    <link href="plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugin/themify/themify-icons.css" rel="stylesheet">

    <link href="plugin/pages/common.css" rel="stylesheet">
    <link href="plugin/pages/user_common.css" rel="stylesheet">
    <link href="plugin/pages/user_chg_pass.css" rel="stylesheet">

</head>


<?php
require_once 'funcs/function.php';
require_once 'includes/config.php';
include 'includes/navigation.php';
include 'includes/dashboard.php';

$hashed = $userlog['password'];
$old_password = ((isset($_POST['old_password']))?clean($_POST['old_password']):'');
$old_password = trim($old_password);
$password = ((isset($_POST['password']))?clean($_POST['password']):'');
$password = trim($password);
$confirm = ((isset($_POST['confirm']))?clean($_POST['confirm']):'');
$confirm = trim($confirm);
$new_hashed = password_hash($password,PASSWORD_DEFAULT);

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
                    $db->query("UPDATE customer SET password = '$new_hashed' WHERE id = '$user_id'");
                    $_SESSION['success'] = 'Your password has been changed succesifully';
                    echo "<script>window.location.replace('userdetails.php');</script>";
                }
        }       
?>
        <div class="col-md-9 body">
            <div><?php if(!empty($errors)){echo show_errors($errors);};?></div>
            <h4>Change Password <i class="ti-key"></i></h4>
            <div class="col-md-6 col-md-offset-3" id="chg_pass">
            <h3 class="text-center text-danger">CHANGE PASSWORD</h3>
            <hr>
            <form action="changepassword.php" method="post">
                <div class="form-group">
                    <input type="password" placeholder="Old Password" name="old_password" id="old_password" class="form-control" >
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="New Password" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" name="confirm" placeholder="Confirm Password" id="confirm" class="form-control" value="<?=$confirm ;?>">
                </div>
                <div class="form-group">
                    <input type="submit" value="Submit" class="btn btn-block btn-primary">
                </div>
            </form>
                </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>

