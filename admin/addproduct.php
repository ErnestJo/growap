a<!DOCTYPE html>
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
    <link href="../plugin/pages/admin_product.css" rel="stylesheet">

</head>

<body>
<?php
include '../includes/config.php'; 
require_once '../funcs/function.php'; 
include 'includes/navigation.php';
include 'includes/dashboard.php';


    
    $category = ((isset($_POST['category']))? clean($_POST['category']):'');
    $title = ((isset($_POST['title']))? clean($_POST['title']): '');
    $quantity = ((isset($_POST['quantity']))? clean($_POST['quantity']): '');
    $price = ((isset($_POST['price']))? clean($_POST['price']): '');
    $detailz = ((isset($_POST['detailz']))? clean($_POST['detailz']): '');
    $recommended = ((isset($_POST['recommended']))? clean($_POST['recommended']): '');



    if(isset($_GET['edit'])&&$_GET['edit'] !=''){
      $edit_id = (int)$_GET['edit'];
      $sql = $db->query("SELECT * FROM product WHERE pid = '$edit_id'");
      $toedit = mysqli_fetch_assoc($sql);
    }
    

    if($_POST){
        $errors = array();
        
        //image validation
        if(!empty($_FILES)){
          $photo = $_FILES['image'];
          $name = $photo['name'];
          $nameArray = explode('.',$name);
          $filename = $nameArray[0];
          $fileEXT = $nameArray[1];
          $mime = explode('/', $photo['type']);
          $mimeType = $mime[0];
          $mimeEXT = $mime[1];
          $temploc = $photo['tmp_name'];
          $filesize = $photo['size'];
          $allowed = array('png','jpg','jpeg','gif');
          $uploadname = md5(microtime()).'.'.$fileEXT;
          $uploadpath = LINKURL.'imgs/products/'.$uploadname;
          $dbpath = BACKLINK.'imgs/products/'.$uploadname;
          if($mimeType != 'image'){
              $errors[]= 'File must be an image';
          }
          elseif(!in_array($fileEXT, $allowed)){
              $errors[]= 'The photo extension must be jpg,png,jpeg or gif.';
          }
          elseif($filesize > 25000000){
             $errors[]= 'The file size must be less than 25MB.';
          }
          elseif($quantity <= 0){
             $errors[]= 'Quantity should more than zero.';
          }
          elseif($price <= 0){
             $errors[]= 'Invalid Price.';
          }
          elseif($fileEXT != $mimeEXT && $mimeEXT == 'jpeg' && $fileEXT != 'jpg' ){
              $errors[]= 'File extension does not match the file.';
          }
          else {
    
          }
        }
        if(!empty($errors)){
          echo show_errors($errors);
        }else{
          if(!empty($_FILES)){
            move_uploaded_file($temploc,$uploadpath);
          }
         
          
          //new inserts
          $insertSQL="INSERT INTO product (name,price,quantity,category,images,recommended,detail) VALUES ('$title','$price','$quantity','$category','$dbpath','$recommended','$detailz')";
           //$_SESSION['success']= 'Product uploaded succesifully';
           //header('Location: movies.php');
           //updating the edited movies
             if(isset($_GET['edit'])){
             $insertSQL="UPDATE product SET name='$title',quantity='$quantity',price='$price',category='$category', images = '$dbpath', detail = '$detailz' WHERE pid ='$edit_id'";
              //$_SESSION['success']= 'Product updated succesifully';
             // header('Location: add_movies.php?edit='.$edit_id);
            }
            $db->query($insertSQL);
            echo "<script>window.location.replace('products.php');</script>";
        }
      }
    
    
    $sql = $db -> query ("SELECT * FROM category ORDER BY id DESC");

    $sql1 = $db -> query ("SELECT * FROM product ORDER BY pid DESC");

    $recent_product = mysqli_fetch_assoc($sql1);
?>
        <div class="col-md-9 body">
            <h3>
               Add Products <i class="ti-tag"></i>
               <a href="products.php" class="pull-right btn btn-sm btn-info">View Products</a>
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-9 products">
                    <form action="addproduct.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'');?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>NAME</label>
                            <input type="text" name="title" required class="form-control" value="<?=((isset($_GET['edit']))? $toedit['name']:'');?>" placeholder="Name or product's details...">  
                        </div>
                        <div class="form-group">
                            <label>DESCRIPTION</label>
                            <input type="text" name=detailz class="form-control" value="<?=((isset($_GET['edit']))? $toedit['detail']:'');?>" placeholder="Name or product's details...">  
                        </div>
                       <input type="file" name="image" class="form-control btn btn-default" required> 
                        <div class="form-group">
                            <label>QUANTITY</label>
                            <input type="number" required name="quantity" class="form-control" value="<?=((isset($_GET['edit']))? $toedit['quantity']:'');?>" placeholder="Quantity">  
                        </div>
                        <div class="form-group">
                            <label>PRICE</label>
                            <input type="number" required name="price" class="form-control" value = "<?=((isset($_GET['edit']))? $toedit['price']:'');?>" placeholder="Product's price...">  
                        </div>
                        <div class="form-group">
                            <label class="text-uppercase ">CATEGORY</label>
                           <select required class="form-control" name="category">
                            <option><?=((isset($_GET['edit']))? $toedit['category']:'<--SELECT CATEGORY-->');?></option>
                            <?php while($category = mysqli_fetch_assoc($sql)) : ?>
                                <option value="<?=$category['name'];?>"><?=$category['name'];?></option>
                                <?php endwhile ;?>
                          </select>
                            
                        </div>
                        <div class="form-group">
                            <label class="text-uppercase ">Recommended</label>
                           <select class="form-control" name="recommended">
                            <option><?=((isset($_GET['edit']))? $toedit['recommended']:'<--Is It Recommended?-->');?></option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                          </select>
                            
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-primary" value="<?=((isset($_GET['edit']))?'edit='.$edit_id :'add=1');?>"><?=((isset($_GET['edit']))?'EDIT ':'ADD ')?> PRODUCT</button>  
                        </div>
                    </form>
                </div>

                <div class="col-md-3 side">
                    <div class="card">
                      <img src="<?=$recent_product['images'];?>" alt="Avatar" style="width:100%">
                      <div class="card_box">
                        <p class="text-center"><?=$recent_product['name'];?></p> 
                        <p class="text-center"><?=$recent_product['price'];?> Tshs</p> 
                        <p class="text-center"><a href="addproduct.php?edit=<?=$recent_product['pid'];?>" class="btn btn-block btn-sm btn-primary">EDIT</a></p>
                        <p class="text-center"><a href="products.php?del=<?=$recent_product['pid'];?>" class="btn btn-block btn-sm btn-info">DELETE</a></p>
                      </div>
                    </div>
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
</script>

<script src="plugin/js/menu_slide.js"></script>


</body>

</html>
