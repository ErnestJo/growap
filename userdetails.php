<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>>SOKONI | Personal Info</title>


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
include 'includes/config.php';
include 'includes/navigation.php';
include 'includes/dashboard.php';


$fullname = ((isset($_POST['fullname']))?clean($_POST['fullname']):'');
$email = ((isset($_POST['email']))?clean($_POST['email']):'');
$dob = ((isset($_POST['dob']))?clean($_POST['dob']):'');
$phone = ((isset($_POST['phone']))?clean($_POST['phone']):'');
$location = ((isset($_POST['location']))?clean($_POST['location']):'');




// form validation
if($_POST){
    $errors = array();

    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
         $errors[]='Please check the  Email you entered';
    }
   
    
    else{

        $db->query("UPDATE customer SET fullname = '$fullname', email = '$email', dob = '$dob', phone = '$phone', location = '$location' WHERE id = '$user_id' ");
         
    }
  
}

 $sql = $db->query("SELECT * FROM customer WHERE id = '$user_id'");
$req = mysqli_fetch_assoc($sql);

?>
        <div class="col-md-9 body">
            <h4>Personal Information <i class="ti-id-badge"></i></h4>
                <div class="table-data-v col-md-10 col-md-offset-1">
             <h3 class="text-center text-info">MY DETAILS</h3>
                    <hr>
                    <table class="table table-condensed table-responsive">
                        <tr>
                            <th>FullName</th>
                            <td><?php echo $req['fullname'];?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $req['email'];?></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td><?php echo $req['phone'];?></td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td><?php echo $req['location'];?></td>
                        </tr>
                        <tr>
                            <th>Birth Date</th>
                            <td><?php echo $req['dob'];?></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td><?php echo $req['gender'];?></td>
                        </tr>
                    </table>   
                </div>   
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>