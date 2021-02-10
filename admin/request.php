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
    <link href="../plugin/pages/admin_request.css" rel="stylesheet">

</head>

<body>
<?php
require_once '../funcs/function.php';
include '../includes/config.php'; 
if(!is_loggedin()){
    login_error_redirect();
}
include 'includes/navigation.php';
include 'includes/dashboard.php';

$sqlall = $db->query("SELECT * FROM requests ORDER BY id DESC");
$sqlunread = $db->query("SELECT * FROM requests WHERE readi = 0 ORDER BY id DESC");
$sqlread = $db->query("SELECT * FROM requests WHERE readi = 1 ORDER BY id DESC");
?>
        <div class="col-md-9 body">
            <div class="row">
                <div class="col-md-4" id="msg-select">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active">
                        <a data-toggle="tab" href="#all">ALL</a>
                        </li>
                        <li>
                        <a data-toggle="tab" href="#read">READ</a>
                        </li>
                        <li>
                        <a data-toggle="tab" href="#unread">UNREAD</a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div id="all" class="tab-pane fade in active">
                            <?php while($requests = mysqli_fetch_assoc($sqlall)) : ?>
                            <div class="msg">
                                <a href="request.php?req_id=<?= $requests['id'];?>">
                                    <h5><strong><?=ucwords($requests['user']);?></strong><a class="pull-right"><i class="fa f"></i></a></h5>
                                    <p><?= $requests['product'];?><b class="pull-right"><?php 
                                    if($requests['readi'] == 0){
                                        echo'UNREAD';
                                    }elseif ($requests['confirm'] == 0 && $requests['readi'] == 1){
                                        echo 'PENDING';


                                    }
                                    elseif ($requests['confirm'] == 1) {

                                            echo 'CONFIRMED';
                                        
                                    }

                                    elseif ($requests['confirm'] == 2) {
                                                
                                            echo 'REJECTED';
                                    

                                    }                                    
                                    ?>
                                        
                                    </b></p>
                                    <small><?=$requests['datesent'];?></small>
                                </a>
                            </div>
                        <?php endwhile ;?>
                        </div>
                        <div id="read" class="tab-pane fade">  
                        <?php while($requests = mysqli_fetch_assoc($sqlread)) : ?>
                            <div class="msg">
                                <a href="request.php?req_id=<?= $requests['id'];?>">
                                    <h5><strong><?=ucwords($requests['user']);?></strong><a class="pull-right"><i class="fa f"></i></a></h5>
                                    <p><?= $requests['product'];?><b class="pull-right"><?php if($requests['readi'] == 0){echo'UNREAD';}else{echo '';};?></b></p>
                                    <small><?=$requests['datesent'];?></small>
                                </a>
                            </div>
                        <?php endwhile ;?>  
                        </div>
                        <div id="unread" class="tab-pane fade">
                        <?php while($requests = mysqli_fetch_assoc($sqlunread)) : ?>
                            <div class="msg">
                                <a href="request.php?req_id=<?= $requests['id'];?>">
                                    <h5><strong><?=ucwords($requests['user']);?></strong><a class="pull-right"><i class="fa f"></i></a></h5>
                                    <p><?= $requests['product'];?><b class="pull-right"><?php if($requests['readi'] == 0){echo'UNREAD';}else{echo '';};?></b></p>
                                    <small><?=$requests['datesent'];?></small>
                                </a>
                            </div>
                        <?php endwhile ;?>    
                        </div>
                    </div>
                </div>

                    <?php if(isset($_GET['req_id']) && $_GET['req_id']!='') { 
                            $id =  $_GET['req_id'];
                            $sql = $db->query("SELECT * FROM requests WHERE id = '$id'");
                            $req = mysqli_fetch_assoc($sql);
                        $qts = "UPDATE requests SET readi='1' WHERE id = '$id'";

                    $db->query($qts);

                    ?>

                <div class="col-md-8" id="msg-body">
                    <h3>REQUEST INFORMATION <i class="ti-comment-alt"></i></h3>

                    <div class="msg">
                        <h4> <b class="text-danger">Email </b>: <?=$req['email'];?></h4>
                        <hr>
                        <h4> <b class="text-danger">Product Name & Quantity </b>: <?=$req['product'];?></h4>
                        <p> <b class="text-danger">Details </b>:<?=$req['details'];?></p>

                        <?php
                            $confirm = $req['confirm'];

                            if ($confirm == 0) {

                                                     

                                echo '<a href="request.php?req_id='.$req['id'].'" class="btn btn-sm btn-info" onclick="confirm('.$req['id'].');">Confirm Request</a>


                                 <a href="request.php?req_id='.$req['id'].'" class="btn btn-sm btn-danger" onclick="reject('.$req['id'].');">Reject Request</a>';
                                
                            }
                            else{

                                echo '';
                            }

                        ?>

                        
                        
                        <hr>
                        <h5>Phone number: <?=$req['phone'];?></h5>
                        <small><?=$req['datesent'];?></small>
                    </div>
                    
                </div>
                <?Php } ?>
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
        //Confirm Req
              function confirm(id){
                var id = id;
                $.ajax({
                  url:'confirm.php',
                  type:'POST',
                  data: {id:id},
                  success: function(){window.location.reload();},
                  error: function(){alert( "Something Went Wrong");},
                });
              }

//Reject Requests
               function reject(id){
                var id = id;
                $.ajax({
                  url:'reject.php',
                  type:'POST',
                  data: {id:id},
                  success: function(){window.location.reload();},
                  error: function(){alert( "Something Went Wrong");},
                });
              }
</script>

<script src="plugin/js/menu_slide.js"></script>


</body>

</html>
