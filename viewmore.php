<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SOKONI| Products</title>


    <link href="plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="plugin/animations/animate.css" rel="stylesheet">

    <link href="plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugin/themify/themify-icons.css" rel="stylesheet">

    <link href="plugin/pages/common.css" rel="stylesheet">
    <link href="plugin/pages/viewmore.css" rel="stylesheet">



</head>

<?php
require_once 'funcs/function.php';
require_once 'includes/config.php';
include 'includes/navigation.php';

if(isset($_GET['category']) && $_GET['category'] !=''){
  $category = $_GET['category'];

  

 
  $page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
                $limit = 24;

                $startpoint = ($page * $limit) - $limit;
                $statement = "product WHERE category LIKE '%$category%' OR recommended = '$category' AND quantity <> 0 AND price <> 0 ORDER BY pid DESC "; //you have to pass your query over here
                $sql = $db->query("SELECT * FROM {$statement} LIMIT {$startpoint} , {$limit}");

                $catlist = $db->query("SELECT category FROM product GROUP BY category ORDER BY category ASC");

                $sql2 = $db->query("SELECT * FROM product WHERE category LIKE '%".$category."%'");

                $titlename = mysqli_fetch_assoc ($sql2);

?>
<div class="container" id="prod_body">
    <div class="row">
        <div class="col-md-9 products">
            <div class="row">
                <h4><?php echo $titlename['category'];?> Products</h4>
                <?php while ( $catpro = mysqli_fetch_assoc($sql)):
                    
                     ?>
                    <div class="col-md-3">
                        
                        <div class="card">
                          <img src="<?=$catpro['images'];?>" alt="product" style="width:100%">
                          <div class="card_box">
                            <div class="details">
                                <p class="text-center"><?=$catpro['name'];?></p> 
                                
                               <p class="text-center"><?=$catpro['price'];?> Tshs</p> 
                                
                            </div>
                            <?php if(is_loggedin_customer()){
                  echo  '<a type="button" class="btn btn-block btn-info" onclick="add_to_cart('.$catpro['pid'].');" data-dismiss="modal">ADD TO CART</a>
                    
                  ';
                }else{
                        echo ' <a href="login.php" <button class="btn btn-block btn-info">ADD TO CART</button> </a>';
                }
                ?>
                          </div>
                        </div>
                        
                    </div>

                    <!-- The Modal -->
<div class="modal" id="<?=$catpro['pid'];?>">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><?=$catpro['name'];?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <?php if(is_loggedin_customer()){
     

      echo  '<a type="button" class="btn btn-success" onclick="add_to_cart('.$latest['pid'].');" data-dismiss="modal">Add To Cart</a>';

    }else{

            echo ' <a href="login.php" <button class="btn btn-success">Log In To Place An Order</button> </a>';

    }
    ?>
      </div>

    </div>
  </div>
</div>
                   
                        <?php endwhile ;?>
                    <div class="col-md-offset-4 col-md-4">
                       <center>
                  <?php 

                echo pagination($statement,$limit,$page);

                ?>
              </center>
                    </div>
            </div>
        </div>
        <div class="col-md-3 filters">
            <h4>Filter Area</h4>
            <p class="text-uppercase text-info"><b>Available Categoeries</b></p>
            <ul>
                <?php while ( $cats = mysqli_fetch_assoc($catlist)) :?>
                <li><a href="viewmore.php?category=<?=ucwords($cats['category']);?>"><?=$cats['category'];?></a></li>
                
            <?php endwhile ;?>
            </ul>
            <p class="text-uppercase text-info"><b>Request Your Product</b></p>
            <p><small>If you have not found your product, Please send a your request here.</small></p>
            <form action="index.php" method="post">
                <div class="form-group form-group-sm">
                    <input type="text" required name="product" class="form-control" placeholder="Product name *">
                </div>
                <div class="form-group form-group-sm">
                    <input type="number" required name="phone" class="form-control" placeholder="(+255) 000 000 000 *">
                </div>
                <div class="form-group form-group-sm">
                    <input type="email" name="email" class="form-control" placeholder="username@email.com *">
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
<?php } ;?>
<?php include 'includes/footer.php'; ?>