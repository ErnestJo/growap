<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SOKONI| Login</title>


    <link href="plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugin/animations/animate.css" rel="stylesheet">

    <link href="plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugin/themify/themify-icons.css" rel="stylesheet">

    <link href="plugin/pages/common.css" rel="stylesheet">
    <link href="plugin/pages/index.css" rel="stylesheet">

    <style type="text/css">
        #login{
            padding: 50px;
            padding-top: 5px;
            margin-top: 60px;
        }
        #login .col-md-4{
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0px 0px 10px #aaa;
        }
        #login form{
            padding-top: 25px;
            padding-bottom: 25px;
        }
        #login h5{
            color: #ff4343;
        }
        #login h3{
            color: #a00000;
        }
        #login input{
            border:none;
            border-radius:0;
            box-shadow: none;
            border-bottom: 1px solid #a00000;
        }
        #login .btn-info,#login .btn-success{
            border:none;
            text-shadow: 0px 0px 1px #222;
        }
        #login .btn-info{
            background-color: #2a9dbe;
        }
        #login .btn-info:hover{
            background-color: #278fad;
        }


    </style>

</head>
<?php 
//include 'includes/config.php';
include'funcs/function.php';
include'includes/config.php';
//include'includes/navigation.php';

  //login form validation
  if($_POST){
  $errors = array();
  $email = ((isset($_POST['email']))?clean($_POST['email']):'');
  $password = ((isset($_POST['password']))?clean($_POST['password']):'');
  $sql = $db->query("SELECT * FROM customer WHERE email = '$email'");
  $sql_admin = $db->query("SELECT * FROM users WHERE email = '$email'");
  $user = mysqli_fetch_assoc($sql);
  $user_admin = mysqli_fetch_assoc($sql_admin);
  $pass = $user_admin['password'];
  echo mysqli_num_rows($sql_admin);


    if(empty($email)||empty($password)){
      $errors[]='You must enter both Email and Password';
    }
    elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error[]='Please check the  Email you entered';
    }
    else{
        if(mysqli_num_rows($sql_admin) >0){
            var_dump($user_admin);
            if(!password_verify($password,$pass)) {
            $errors[]= 'The password you entered is incorrect,please try again';
            }else{
            //login admin
            $_SESSION['admin'] = $user_admin['id'];
            header('Location: admin/index.php');
            }
        }
        if(mysqli_num_rows($sql) >0){
            if(!password_verify($password,$user['password'])) {
            $errors[]= 'The password you entered is incorrect,please try again';
            }else{
           // login the users
              $user_id = $user['id'];
            $_SESSION['customer'] = $user_id;
            header('Location: index.php'); 
         }
        }
    }
  }


?>

<div class="container-fluid">
    <div class="row" id="login">
    <div class="col-md-4 col-md-offset-4">
        <div class="container-fluid" id="login">
        <h3 class="text-center">LOGIN TO GROWAP</h3>
        <h5 class="text-center">MAKE ORDERS NOW</h5>
            <hr>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="text" name="email" class="form-control" required placeholder="E-mail or Username">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" required placeholder="Password">
            </div>
            <div class="form-group">
                <input type="submit" name="login" value="LOGIN"  class="btn btn-block btn-success">
            </div>
            <div class="form-group">
                <a href="signup.php" class="btn btn-block btn-info">REGISTER</a>
            </div>
            <!-- <div class="form-group">
                <a href="" class="">Forgot password?.</a>
            </div> -->
            <div><?php if(!empty($errors)){echo show_errors($errors);};?></div>
        </form>
    </div>
    </div>
</div>

<div class="container" id="footer">
    <div class="row" id="footer">
        <div class="col-md-6 col-md-offset-3">
            <center>
            <p>
                CONTACT US:
                <a href=""><i class="fa fa-facebook"></i> </a>
                <a href=""><i class="fa fa-twitter"></i> </a>
                <a href=""><i class="fa fa-instagram"></i> </a>
                | <i class="fa fa-phone"></i> +255 700 000 000 |
                <i class="fa fa-desktop"></i> Growap@gmail.com |
                <i class="fa fa-university"></i> CoICT - UDSM
            </p>
            <p>&copy; Copyright GROWAP 2021</p>
            </center>
        </div>
    </div>
</div>
<div class="container" id="brand">
    <div class="row">
        <div class="col-md-12 text-center">
        <a href="" target="_blank" id="me">Website by GROCERIES WEB APPLICATION GROUP</a>
        </div>
    </div>    
</div>
<!-- JAVASCRIPT SECTIONS -->
<script src="plugin/bootstrap/js/jquery-3.2.1.js"></script>
<script src="plugin/bootstrap/js/bootstrap.min.js"></script>
<script src="plugin/bootstrap/js/wow.min.js"></script>
<script>
    new WOW().init();
</script>

<script src="plugin/js/menu_slide.js"></script>


</body>

</html>

