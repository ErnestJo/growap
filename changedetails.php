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
    <link href="plugin/pages/user_details.css" rel="stylesheet">

</head>
<?php
require_once 'funcs/function.php';
require_once 'includes/config.php';
include 'includes/navigation.php';
include 'includes/dashboard.php';

$sql1 = $db->query("SELECT * FROM customer WHERE id = '$user_id'");

$check = mysqli_fetch_assoc($sql1);

?>
        <div class="col-md-9 body">
            <h4>Change Information <i class="ti-pencil-alt"></i></h4>
                <div class="row">
                   <div class="table-data-c">
                    <h3 class="text-center text-info">UPDATE DETAILS</h3>
                    <hr>
                        <form action="userdetails.php" method="post">
                            <div class="form-group form-group-sm">
                                <label>Full Name</label>
                                <input type="name" name="fullname" Value="<?=$check['fullname'];?>" class="form-control" placeholder="Your FullName">
                            </div>
                             <div class="form-group form-group-sm">
                                <label>Email</label>
                                <input type="Email" name="email" value="<?=$check['email'];?>" class="form-control" placeholder="Your Email">
                            </div>
                            <div class="form-group form-group-sm">
                                <label>Phone Number</label>
                                <input type="text" name="phone" value="<?=$check['phone'];?>" class="form-control" placeholder="Phone Number">
                            </div>
                            <div class="form-group form-group-sm">
                                <label>Date of Birth</label>
                                <input type="date" name="dob" value="<?=$check['dob'];?>" class="form-control" placeholder="Birth date">
                            </div>
                            <div class="form-group form-group-sm">
                                <label>Location</label>
                                <input type="text" name="location" value="<?=$check['location'];?>" class="form-control" placeholder="Location">
                            </div>
                            <div class="form-group form-group-sm">
                                <input type="submit" class="btn btn-sm btn-block btn-success">
                            </div>
                        </form>
                    </div> 
                </div>   
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>

