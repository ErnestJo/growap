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
include '../funcs/function.php';
include '../includes/config.php';
if(!is_loggedin()){
        login_error_redirect();
    }
    if(!has_permission('admin')){
    login_error_redirect_admin();
}
include 'includes/navigation.php';
include 'includes/dashboard.php';

$fullname = ((isset($_POST['fullname']))? clean($_POST['fullname']):'');
    $email = ((isset($_POST['email']))? clean($_POST['email']): '');
    $password = ((isset($_POST['password']))? clean($_POST['password']):'');
    $cpassword = ((isset($_POST['cpassword']))? clean($_POST['cpassword']):''); 
    $permission = ((isset($_POST['permission']))? clean($_POST['permission']):'');

    $errors = array();

    if($_POST){
        $checkemail = $db-> query ("SELECT * FROM users WHERE email = '$email'");
        $exist = mysqli_num_rows($checkemail);

        if ($exist != 0) {
            $errors[]= 'There is a user already using this email address';
        }

        elseif(strlen($password) < 6 ){
            $errors[] = 'Password must at least have 6 characters';
        }
        elseif($password != $cpassword){
            $errors[] = 'Password Does\'t match with confirm password';
        }
        else {
            $hashed = password_hash($password,PASSWORD_DEFAULT);
            $userinsert = "INSERT INTO users (`fullname`,`email`,`password`,`permission`) VALUES ('$fullname','$email','$hashed','$permission')";
            $db->query($userinsert);
            $_SESSIOddN['success'] = 'User Has Been Successfull Added';
           echo "<script>window.location.replace('users.php');</script>";
        }
    
}

?>
        <div class="col-md-9 body">
            <h3>Add User <i class="ti-face-smile"></i></h3>
            <div class="row">
                <div class="col-md-4 col-md-offset-4" id="add-user">
                    <h4 class="text-center text-danger">ADD STAFF HERE</h4>
                    <hr>
                    <form action="adduser.php" method="post" enctype="multipart/form-data">
                    <div class="form-group form-group-sm">
                        <label>Full Name</label>
                        <input type="text" name="fullname" class="form-control" placeholder="Fullname">
                    </div>
                    <div class="form-group form-group-sm">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="username@email.com">
                    </div>
                    <div class="form-group form-group-sm">
                        <label>Permission</label>
                        <select class="form-control" name="permission">
                            <option value="admin,editor">Admin</option>
                            <option value="editor">Editor</option>
                        </select>
                    </div>
                    <div class="form-group form-group-sm">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="******">
                    </div>
                    <div class="form-group form-group-sm">
                        <label>Confirm Password</label>
                        <input type="password" name="cpassword" class="form-control" placeholder="******">
                    </div>
                    <div class="form-group form-group-sm">
                        <input type="submit" class="btn btn-sm btn-block btn-primary" value="ADD USER">
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
