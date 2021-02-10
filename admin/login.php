<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SOKONI| Login</title>


    <link href="../plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugin/animations/animate.css" rel="stylesheet">

    <link href="../plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../plugin/themify/themify-icons.css" rel="stylesheet">

    <link href="../plugin/pages/common.css" rel="stylesheet">
    <link href="../plugin/pages/index.css" rel="stylesheet">

    <style type="text/css">
        body{
            background-image: url(imgs/stationeryads.jpg)!important;
        }
        #login{
            padding: 50px;
            padding-top: 50px;
            margin-top: 100px;
            background-color: white;
            box-shadow: 0px 0px 10px #aaa;
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
include'../funcs/function.php';
include'../includes/config.php';
//include'includes/navigation.php';

  //login form validation
   $email = ((isset($_POST['email']))?clean($_POST['email']):'');
  $password = ((isset($_POST['password']))?clean($_POST['password']):'');
  $sql = $db->query("SELECT * FROM users  WHERE email = '$email'");
  $user = mysqli_fetch_assoc($sql);

  //login form validation
  if($_POST){
    $errors = array();
    if(empty($email)||empty($password)){
      $errors[]='You must enter both Email and Password';
    }
    elseif (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $error[]='Please check the  Email you entered';
    }
    elseif (mysqli_num_rows($sql)<1) {
      $errors[]='The  Email you entered does not exit in our system';
    }
    elseif (!password_verify($password,$user['password'])) {
      $errors[]= 'The password you entered is incorrect,please try again';
    }
    else {
      // login the users
      $user_id = $user['id'];
      login($user_id);
    }
  }


?>


    <div class="col-md-4 col-md-offset-4">
        <div class="container-fluid" id="login">
        <h3 class="text-center">LOGIN TO SOKONI  DASHBOARD</h3>
        
        <div><?php if(!empty($errors)){echo show_errors($errors);};?></div>

            <hr>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="text" name="email" class="form-control" required placeholder="E-mail">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" required placeholder="Password">
            </div>
            <div class="form-group">
                <input type="submit" name="login" value="LOGIN"  class="btn btn-block btn-success">
            </div>
        </form>
    </div>
</div>


<!-- JAVASCRIPT SECTIONS -->
<script src="../plugin/bootstrap/js/jquery-3.2.1.js"></script>
<script src="../plugin/bootstrap/js/bootstrap.min.js"></script>
<script src="../plugin/bootstrap/js/wow.min.js"></script>
<script>
    new WOW().init();
</script>

<script src="../plugin/js/menu_slide.js"></script>


</body>

</html>
