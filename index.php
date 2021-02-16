<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SOKONI | Home</title>


    <link href="plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugin/animations/animate.css" rel="stylesheet">

    <link href="plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugin/themify/themify-icons.css" rel="stylesheet">

    <link href="plugin/pages/common.css" rel="stylesheet">
    <link href="plugin/pages/index.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</head>
<?php
require_once 'funcs/function.php';
require_once 'includes/config.php';
include 'includes/navigation.php';

    //$email = ((isset($_POST['email']))?clean($_POST['email']):'');
    $phone = ((isset($_POST['phone']))?clean($_POST['phone']):'');
    $details = ((isset($_POST['details']))?clean($_POST['details']):'');
    $product = ((isset($_POST['product']))?clean($_POST['product']):'');

    $email = $userlog['email'];

    if($_POST){

        $fields = array('email','phone');
        foreach ($fields as $required) {
            if($_POST[$required] == ''){
                  $errors[] = 'All fields are required.';
                  break;
              }
        }
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
         $errors[]='Please check the  Email you entered';
        }
        else{

      // insert the request in the database.
     $db->query("INSERT INTO requests (email,phone,details,product,user,userid) VALUES('$email','$phone','$details','$product','$usercustomer','$user_id')");
     //$_SESSION['success'] = 'Request Sent Successful , we will notify you for the confirmation!!';
            
    }
  }

$sqlcats = $db->query ("SELECT category FROM product GROUP BY category ORDER BY pid DESC ");
$sqlads1 = $db->query ("SELECT image FROM ads WHERE id = 1");
$sqlads2 = $db->query ("SELECT image FROM ads WHERE id = 2");
$sqllatest = $db -> query ("SELECT * FROM product WHERE quantity <> 0 AND price <> 0 ORDER BY pid DESC LIMIT 6 ");
$sqllatest = $db -> query ("SELECT * FROM product WHERE quantity <> 0 AND price <> 0 ORDER BY pid DESC LIMIT 6");
$sqlrecommended = $db -> query ("SELECT * FROM product WHERE recommended = 'yes' AND quantity <> 0 AND price <> 0  ORDER BY pid DESC LIMIT 6 ");

$ad1 = mysqli_fetch_assoc ($sqlads1);
$ad2 = mysqli_fetch_assoc ($sqlads2);
?>

<div class="container" id="intro">
    <div class="row">
        <div class="col-md-2">
            <ul>
                <?php while ($category = mysqli_fetch_assoc ($sqlcats)) : ?>
                    <li><a href="viewmore.php?category=<?=ucwords($category['category']);?>"><?=$category['category'];?></a></li>
                <?php endwhile; ?>
            </ul>
        </div>
        <div class="col-md-7">
            <div id="myCarousel" class=" carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <center>
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner" role="listbox">
                        <div class="item active">
                            <img src="<?=$ad1['image'];?>" alt="Advert">
                        </div>

                        <div class="item">
                            <img src="<?=$ad2['image'];?>" alt="Advert">
                        </div>

                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </center>
            </div>
        </div>
        <div class="col-md-3">
            <h4 class="text-uppercase text-info">Request Your Product</h4>
            <p><small>If you have not found your product, Please send your request here.</small></p>
            <form action="index.php" method="post">
                <div class="form-group form-group-sm">
                    <input type="text" required name="product" class="form-control" placeholder="Product name *">
                </div>
                <div class="form-group form-group-sm">
                    <input type="number" required name="phone" class="form-control" placeholder="(+255) 000 000 000 *">
                </div>
                
                <div class="form-group form-group-sm">
                    <textarea class="form-control" name="details" placeholder="Any instructions about the product..."></textarea>
                </div>
                <div class="form-group form-group-sm">
                    <?php if(is_loggedin_customer()){ echo '<button type="submit" class="btn btn-info btn-block btn-sm">REQUEST</button>';} 
                        else {
                             echo ' <a href="login.php" <button class="btn btn-info btn-block btn-sm">Log In To Send Request</button> </a>';
                        }
                    ;?>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="container" id="welcome">
    <div class="row">
        <div class="col-md-12">
            <h1 class="text-center">WELCOME TO SOKONI</h1>
                <h4 class="text-center">EXCLUSIVE AND QUICK SEARCH FOR WHAT YOU WANT</h4>
        </div>
    </div>
</div>

<div class="container" id="products_body">
    <div class="row products">
        <h4>Latest Products <small><a href="viewmore.php?category=yes" class="pull-right">view more ></a></small></h4>
        <?php while ($latest = mysqli_fetch_assoc($sqllatest)) :

        ?>
        <div class="col-md-2">
            <div class="card">
              <img src="<?=$latest['images'];?>" alt="<?=$latest['name'];?>" style="width:100%">
              <div class="card_box">
                <p class="text-center"><?=$latest['name'];?> <?php 
                                if ($latest['detail'] != '') {
                                    echo '/'.$latest['detail'];
                                }
                                else{

                                    echo '';
                                }

                            ?></p> 
                <p class="text-center"><?=$latest['price'];?> Tshs</p>
                <?php if(is_loggedin_customer()){
                  echo  '<a type="button" class="btn btn-block btn-info" onclick="add_to_cart('.$latest['pid'].');" data-dismiss="modal">ADD TO CART</a>';
                }else{
                        echo ' <a href="login.php" <button class="btn btn-block btn-info">ADD TO CART</button> </a>';
                }
                ?>
              </div>
            </div>
        </div>

    <?php endwhile ;?>

    </div>
    
    <div class="row products"> 
        <h4>Recomended Products <small><a href="viewmore.php?category=yes" class="pull-right">view more ></a></small></h4><?php while ($latest = mysqli_fetch_assoc($sqlrecommended)) :

    
        ?>
        <div class="col-md-2">
            <div class="card">
              <img src="<?=$latest['images'];?>" alt="<?=$latest['name'];?>" style="width:100%">
              <div class="card_box">
                <p class="text-center"><?=$latest['name'];?></p> 
                <p class="text-center"><?=$latest['price'];?> Tshs</p> 
                <?php if(is_loggedin_customer()){
                  echo  '<a type="button" class="btn btn-block btn-info" onclick="add_to_cart('.$latest['pid'].');" data-dismiss="modal">ADD TO CART</a>';
                }else{
                        echo ' <a href="login.php" <button class="btn btn-block btn-info">Log In To Place An Order</button> </a>';
                }
                ?>
              </div>
            </div>
        </div>

    <?php endwhile ;?>
    </div>
</div>

<div class="container" id="about">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <p class="text-center">
                <b>"SOKONI"</b> is Manage by Sokoni ltd.. We recognizes the importance of E-market we have provide a bridge between customers and market . So that to make market items accessible easily. 
            </p>
        </div>
    </div>
</div>
<div class="container" id="why">
    <div class="row">
        <div class="col-md-4">
                    <div class="media">
                        <div class="media-left">
                            <i class="fa fa-tags"></i>
                        </div>
                        <div class="media-body">
                            <h4>Best Price</h4>
                            <p>We offer best price of our product that is affordable to everyone and reasonable.</p>
                        </div>
                    </div>
        </div>
        <div class="col-md-4">
            <div class="media">
                <div class="media-left">
                    <i class="fa fa-bolt"></i>
                </div>
                <div class="media-body">
                    <h4>Quick Response</h4>
                    <p>We respond your opinion and product request that customer are  requesting.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="media">
                <div class="media-left">
                    <i class="fa fa-truck"></i>
                </div>
                <div class="media-body">
                    <h4>Easy connect</h4>
                    <p>We plan many kind of design including commercial/public design,residential design, depending on a customers requirments.</p>
                </div>
            </div>
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
                <i class="fa fa-desktop"></i> sokoni@gmail.com |
                <i class="fa fa-university"></i> UDSM
            </p>
            <p>&copy; Copyright SOKONI 2021</p>
            </center>
        </div>
    </div>
</div>
<div class="container" id="brand">
    <div class="row">
        <div class="col-md-12 text-center">
        <a href="" target="_blank" id="me">Website by group five</a>
        </div>
    </div>    
</div>

<?php 

$sql = $db -> query ("SELECT * FROM product");
$modal = mysqli_fetch_assoc ($sql);

?>

<!-- JAVASCRIPT SECTIONS -->
<script src="plugin/bootstrap/js/jquery-3.3.1.js"></script>
<script src="plugin/bootstrap/js/bootstrap.min.js"></script>
<script src="plugin/bootstrap/js/wow.min.js"></script>

<script>
    new WOW().init();
</script>

<script src="plugin/js/menu_slide.js"></script>

<script>


 function add_to_cart(pid){
                var pid = pid;
                $.ajax({
                  url:'add_to_cart.php',
                  type:'POST',
                  data: {pid:pid},
                  success: function(){window.location.reload();},
                  error: function(){alert( "Something Went Wrong");},
                });
              }

  </script>

</body>

</html>
