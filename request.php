<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SOKONI| Orders</title>


    <link href="plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugin/animations/animate.css" rel="stylesheet">

    <link href="plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugin/themify/themify-icons.css" rel="stylesheet">

    <link href="plugin/pages/common.css" rel="stylesheet">
    <link href="plugin/pages/user_common.css" rel="stylesheet">
    <link href="plugin/pages/user_request.css" rel="stylesheet">

    

</head>
<?php 
require_once 'funcs/function.php';
require_once 'includes/config.php';
include 'includes/navigation.php';
include 'includes/dashboard.php';

$confirm = 1;
$reject = 2;

$sql = $db->query("SELECT * FROM requests WHERE userid = '$user_id' ORDER BY id DESC");
$sqlconf = $db->query("SELECT * FROM requests WHERE userid = '$user_id' AND confirm = '$confirm' ORDER BY id DESC ");
$sqlrej = $db->query("SELECT * FROM requests WHERE userid = '$user_id' AND confirm = '$reject' ORDER BY id DESC ");
$sqlpend = $db->query("SELECT * FROM requests WHERE userid = '$user_id' AND readi = 0 ORDER BY id DESC");

?>

        <div class="col-md-9 body">
            <h4>My Requests <i class="ti-comment-alt"></i></h4>
            <div class="row">
                <div class="col-md-6" id="msg-select">
                    <ul class="nav nav-tabs nav-justified">
                        <li class="active">
                        <a data-toggle="tab" href="#all">ALL</a>
                        </li>
                        <li>
                        <a data-toggle="tab" href="#read">PENDING</a>
                        </li>
                        <li>
                        <a data-toggle="tab" href="#unread">CONFIRMED</a>
                        </li>
                        <li>
                        <a data-toggle="tab" href="#reject">REJECTED</a>
                        </li>
                    </ul>
                    <div class="tab-content">

                        <div id="all" class="tab-pane fade in active">
                            <?php while ($request = mysqli_fetch_assoc ($sql)) :?>
                            <div class="msg">
                                <a href="<?php 

                                if($request['confirm'] != 0){

                                    $link = $request['id'];

                                echo 'request.php?req_id='.$link;

                                    }
                                ?>">
                                    <p><?=$request['product'];?><b class="pull-right"><?php if($request['confirm'] == 1){
                                                    echo 'CONFIRMED';
                                            }

                                            else if($request['confirm'] == 2){

                                                    echo 'REJECTED';

                                            }
                                            else if ($request['readi'] == 0) {
                                                    echo 'UNREAD';
                                            }
                                            else if ($request['readi'] == 1 && $request['confirm'] == 0) {
                                                
                                                    echo 'PENDING';
                                            }

                                            ;?>
                                </b></p>
                                    <small><?=$request['datesent'];?></small>
                                </a>
                            </div>
                        <?php endwhile ;?>
                        </div>
                        <div id="read" class="tab-pane fade">  

                            <?php while ($request = mysqli_fetch_assoc ($sqlpend)) :?>
                            <div class="msg">
                                <a href="request.php?req_id=<?= $request['id'];?>">
                                    <p><?=$request['product'];?><b class="pull-right"></b></p>
                                    <small><?=$request['datesent'];?></small>
                                </a>
                            </div>
                            <?php endwhile ;?>
                        </div>
                        <div id="unread" class="tab-pane fade">   

                                <?php while ($request = mysqli_fetch_assoc ($sqlconf)) :?>
                            <div class="msg">
                                <a href="request.php?req_id=<?= $request['id'];?>">
                                    <p><?=$request['product'];?><b class="pull-right"></b></p>
                                    <small><?=$request['datesent'];?></small>
                                </a>
                            </div>
                                <?php endwhile ;?>
                        </div>
                       <div id="reject" class="tab-pane fade">   

                                <?php while ($request = mysqli_fetch_assoc ($sqlrej)) :?>
                            <div class="msg">
                                <a href="request.php?req_id=<?= $request['id'];?>">
                                    <p><?=$request['product'];?><b class="pull-right"></b></p>
                                    <small><?=$request['datesent'];?></small>
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
                        $qts = "UPDATE requests SET userread='1' WHERE id = '$id'";

                    $db->query($qts);

                    ?>

                <div class="col-md-6" id="msg-body">
                    <div class="msg">
                        <h4><b>Email:</b> <?=$req['email'];?></b></h4>
                        <p>Product Name : <?=$req['product'];?></p>
                        <p><?=$req['details'];?></p>
                        <hr>
                        <h5><b>Phone number:</b> <?=$req['phone'];?></h5>
                        <small><?=$req['datesent'];?></small>
                    </div>
                    
                </div>
            <?php } ;?>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'; ?>