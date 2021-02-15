<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>>SOKONI| Signup</title>


    <link href="plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugin/animations/animate.css" rel="stylesheet">

    <link href="plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugin/themify/themify-icons.css" rel="stylesheet">

    <link href="plugin/pages/common.css" rel="stylesheet">
    <link href="plugin/pages/.css" rel="stylesheet">

    <style type="text/css">
        @font-face{
            src:url(plugin/font/ran.otf);
            font-family: ran;
        }
        #register{
            padding: 50px;
            padding-top: 5px;
            margin-top: 60px;
           
        }
        #register .col-md-8{
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0px 0px 10px #aaa;
        }
        #register form{
            padding-top: 25px;
            padding-bottom: 25px;
        }
        #register h5{
            color: #ff4343;
        }
        #register h3{
            color: #a00000;
        }
        #ran-num{
            font-family: ran;
        }
        #register input{
            border:none;
            border-radius:0;
            box-shadow: none;
            border-bottom: 1px solid #a00000;
        }
        #register .btn-info,#register .btn-success{
            border:none;
            text-shadow: 0px 0px 1px #222;
        }
        #register .btn-info{
            background-color: #2a9dbe;
        }
        #register .btn-info:hover{
            background-color: #278fad;
        }
    </style>

</head>
<?php 
include'funcs/function.php';
include'includes/config.php';
include'includes/navigation.php';


$fullname = ((isset($_POST['fullname']))?clean($_POST['fullname']):'');
$location = ((isset($_POST['location']))?clean($_POST['location']):'');
$email = ((isset($_POST['email']))?clean($_POST['email']):'');
$dob = ((isset($_POST['dob']))?clean($_POST['dob']):'');
$gender = ((isset($_POST['gender']))?clean($_POST['gender']):'');
$phone = ((isset($_POST['phone']))?clean($_POST['phone']):'');
$password = ((isset($_POST['password']))?clean($_POST['password']):'');
$cpassword = ((isset($_POST['cpassword']))?clean($_POST['cpassword']):'');
$robot = ((isset($_POST['robot']))?clean($_POST['robot']):'');
$verify = ((isset($_POST['verify']))?clean($_POST['verify']):'');


$random = rand(10000,1000000);



$sql = $db->query("SELECT * FROM customer WHERE email = '$email'");
$check = mysqli_num_rows($sql);

// form validation
if($_POST){
    
    $errors = array();
    $fields = array('fullname','email','dob','gender','password','cpassword','phone');
    foreach ($fields as $required) {
        if($_POST[$required] == ''){
              $errors[] = 'All fields are required.';
              break;
          }
    }

    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
         $errors[]='Please check the  Email you entered';
    }
    elseif ($check== 1) {
         $errors[]='Email you entered is Already registerd, Please Try with A diffrent Email Adress';
    }

    elseif ($verify != $robot) {
         $errors[]='Check Verifications code and write them correctly...';
    }

    elseif ($password != $cpassword) {
         $errors[]='The password and confirm password fields do not match';
    }
    else{
        $hashed = password_hash($cpassword, PASSWORD_DEFAULT);
        $db->query("INSERT INTO customer (fullname,email,dob,password,gender,phone,location)
         VALUES('$fullname','$email','$dob','$hashed','$gender','$phone','$location')");
        $_SESSION['success'] = 'You are Successfull Registered, Login and Start To Order ';
       echo "<script>window.location.replace('login.php');</script>";
    }
  
}


?>



<div class="container-fluid" id="register">
    
    <div class="col-md-8 col-md-offset-2">
        <h3 class="text-center">REGISTER TO GROWAP</h3>
        <h5 class="text-center">GET A FREE ACCOUNT</h5>
            <hr>
            <div>
                <?php if(!empty($errors)){echo show_errors($errors);};?>
            </div>
        <form class="form-horizontal" action="signup.php" method="post">
            <div class="form-group">
                <label class="control-label col-sm-4" for="fullname">Full Name  <b class="text-danger">*</b></label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" required name="fullname" placeholder="Full Name" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="email">Phone Number  <b class="text-danger">*</b></label>
                <div class="col-sm-6">
                    <input type="numbber" class="form-control" required name="phone" placeholder="(+255) 000 000 000">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="dob">Email  <b class="text-danger">*</b></label>
                <div class="col-sm-6">
                <input type="email" class="form-control" required name="email" placeholder="username@example.com" >
                <input type="hidden" name="verify" value="<?=$random;?>">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="dob">Location  <b class="text-danger">*</b></label>
                <div class="col-sm-6">
                <input type="text" class="form-control" required name="location" placeholder="Place/Region" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="dob">Date of birth  <b class="text-danger">*</b></label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" name="dob">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="email">Gender  <b class="text-danger">*</b></label>
                <div class="col-sm-6">
                    <div class="radio">
                        <label><input type="radio" value="Male" required name="gender" >Male</label>
                        <label><input type="radio" value="Female" required name="gender" >Female</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="email">Password  <b class="text-danger">*</b></label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" required name="password" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="email">Confirm Password  <b class="text-danger">*</b></label>
                <div class="col-sm-6">
                    <input type="password" class="form-control" required name="cpassword" placeholder="Confirm Password" >
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4">Verifications Number</label> 
                <div class="col-sm-6">
                    <h4 id="ran-num"><?=$random;?></h4>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="email">Verify You Are Not Robot <b class="text-danger">*</b></label>
                <div class="col-sm-6">
                    <input type="name" class="form-control" required name="robot" placeholder="Verify To Sign UP" >
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-6">
                    <input type="Submit" class="form-control btn btn-info" value="Submit">
                </div>
            </div>
        
        </form>
    </div>
</div>
<?php include 'includes/footer.php'; ?>