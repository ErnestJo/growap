<?php 
include 'includes/config.php';
include 'funcs/function.php';
include 'includes/cart_header.php';
include 'includes/navigation.php';

$sql = $db->query ("SELECT * FROM product,customer,cart 
    WHERE product.pid = cart.pid 
    AND customer.id = cart.uid 
    AND cart.uid = '$user_id' 
    AND confirm = 0 AND orderid = 0
    ORDER BY cart.id DESC ");

$sql1 = $db->query ("SELECT * FROM product,customer,cart 
    WHERE product.pid = cart.pid AND customer.id = cart.uid AND cart.uid = '$user_id'
    ORDER BY cart.carttime DESC ");

$sql2 = $db->query ("SELECT SUM(price * quantities) AS grandtotal FROM cart 
    WHERE uid = '$user_id' AND orderid = 0 ");

        $uid = mysqli_fetch_assoc($sql1);
        $grandtotal = mysqli_fetch_assoc($sql2);

$sqlcust = $db->query ("SELECT * FROM customer 
    WHERE id = '$user_id' ");

$customer = mysqli_fetch_assoc($sqlcust);

$email = ((isset($_POST['email']))?clean($_POST['email']):'');
$phone = ((isset($_POST['phone']))?clean($_POST['phone']):'');
$location = ((isset($_POST['location']))?clean($_POST['location']):'');


if($_POST){
    $errors = array();

    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
         $errors[]='Please check the  Email you entered';
    }
    elseif ($checki== 1) {
         $errors[]='Email you entered is Already registerd, Please Try with A diffrent Email Adress';
    }
    
    else{

        $db->query("UPDATE customer SET email = '$email', phone = '$phone', location = '$location' WHERE id = '$user_id' ");

        $_SESSION['success'] = 'Details Updated Successful';
        echo "<script>window.location.replace('users.php');</script>";
         
    }
  
}

?>
<div class="container" id="cart_body">
    <div class="row">
        <div class="col-md-12">
           <div class="row products">
                <h4>SHOPPING CART <a type="submit" class=" pull-right"><?php if(mysqli_num_rows($sql) >  0){  echo 'Tshs.';}?><?=$grandtotal['grandtotal'];?></a></h4>
                <div class="col-md-8">
                    <table class="table table-bordered table-responsive table-condensed">

                        <?php if(mysqli_num_rows($sql) > 1){
                       echo 
                        '<tr class="bg-danger">
                            <th class="text-center">ITEM</th>
                            <th class="text-center">QUANTITY</th>
                            <th class="text-center">PRICE</th>
                            <th class="text-center">SUBTOTAL</th>
                        </tr>';
                    }?>
                        <?php if(mysqli_num_rows($sql) ==  0){  echo '<h2 class="text-center text-danger">No Product In Your Cart, Order Products From Us for Your Satisfaction</h2>';}?>
                        <tr>
                            <?php $total = 0 ; ?>
                            <?php while ( $cart = mysqli_fetch_assoc($sql)):

                                    $subtotal = $cart['price'] * $cart['quantities'];
                                    
                                   
                             ?>
                            <td>
                                <div class="media">
                                    <div class="media-left">
                                        <img src="<?=$cart['images'];?>" class="media-object">            
                                    </div>
                                    <div class="media-body">
                                        <?=$cart['name'];?>
                                        <br>                    
                                        <a href= "" onclick="remove(<?=$cart['pid'];?>);">Remove</a>
                                    </div>
                                </div>
                                
                            </td>

                            <td class="text-center quantity">
                                <h5>
                                    <a href="" class="text-success" onclick="reduce(<?=$cart['pid'];?>);"><i  class="ti-arrow-circle-left"></i></a>
                                    <?=$cart['quantities'];?>
                                    <a href="" class="text-success" onclick="increment(<?=$cart['pid'];?>);"><i class="ti-arrow-circle-right"></i></a>
                                </h5>
                                <h6>Available : <?=$cart['quantity'];?></h6>
                            </td>
                            <td class="text-center price"><?=$cart['price'];?></td>
                            <td class="text-center price"><?=$subtotal;?></td>  
                        </tr>
                    <?php endwhile ;?>
                        
                    </table> 
                    <hr>

                    <?php 

                    if ((mysqli_num_rows($sql) >  0)) {
                        
                        echo '<button  class="btn btn-danger btn-sm " onclick="clearcart('.$cart['uid'].');">CLEAR CART</button> ';
                    }
                        

                    ?>   

                    <?php if(mysqli_num_rows($sql) > 0){
                       echo  '<a href=""> <button type="button" class="btn btn-info pull-right" onclick="checkout('.$uid['uid'].');" data-dismiss="modal">SEND AN ORDER REQUEST</button></a>';
                   }

                       ?>          
                </div>
                <div class="col-md-4">
                    <h3 class="text-info">Your Contact Information</h3>
                    <table class="table table-condensed table-responsive">


                        <tr>
                            <th>FULL NAME</th>
                            <td><?=ucwords($usercustomer) ;?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?=ucwords($userlog['email']); ?></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>+(255) <?=$userlog['phone']; ?></td>
                        </tr>
                        <tr>
                            <th>Location</th>
                            <td><?=$userlog['location'];?></td>
                        </tr>
                    </table>
                    <p><b>Fill the below form, If you wish to change your informations.</b></p>
                    <form action="cart.php" method="post">
                        <div class="form-group form-group-sm">
                            <label>Full Name</label>
                            <input type="email" name="email" value="<?=$customer['email'];?>" class="form-control" placeholder="Email Address">
                        </div>
                        <div class="form-group form-group-sm">
                            <label>Phone Number</label>
                            <input type="number" name="phone" value="<?=$customer['phone'];?>" class="form-control" placeholder="+255 700 000 000">
                        </div>
                        <div class="form-group form-group-sm">
                            <label>Address</label>
                            <input type="text" name="location" value="<?=$customer['location'];?>" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                                <input type="submit" value="UPDATE DETAILS" class="btn btn-block btn-success">
                        </div>
                    </form>
                
                </div>       
           </div>
        </div>
    </div> 
</div>
<?php include 'includes/footer.php'; ?>