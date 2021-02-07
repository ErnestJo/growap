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
    <link href="../plugin/pages/admin_product.css" rel="stylesheet">

</head>

<body>
<?php
include '../includes/config.php'; 
require_once '../funcs/function.php'; 
include 'includes/navigation.php';
include 'includes/dashboard.php';

if(isset($_GET['delete'])){
    $delete_id = clean($_GET['delete']);
    $db->query("DELETE FROM category WHERE id = '$delete_id'");
    $_SESSION['success_flash'] = 'Category Has Been Deleted';
    //header('Location: place.php');
}

    $category = ((isset($_POST['category']))? clean($_POST['category']):'');

    if($_POST){


        
        $checkcat = $db-> query ("SELECT * FROM category WHERE name = '$category'");
        $exist = mysqli_num_rows($checkcat);

        if ($exist != 0) {
            $errors[]= 'Sorry ! Category you added already exists ';
        }
          else{
        $userinsert = "INSERT INTO category (name) VALUES ('$category')";
            $db->query($userinsert);
           // $_SESSION['success'] = 'Category Has Been Successfull Added';
          }
            //header('Location: categories.php');
    }
        
            $cat = $db->query("SELECT * FROM category ORDER BY name");

?>

        <div class="col-md-9 body">
            <h3>
               CATEGORIES <i class="ti-tag"></i>
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-9 products">
                    <h4 class="text-center">EXISTING CATEGORIES</h4>
                    <table class="table table-condensed">
                <tr class="bg-danger">
                    <th class="text-center">CATEGORY NAME</th>
                    <th class="text-center">DELETE</th>
                </tr>
                <?php while ($categories = mysqli_fetch_assoc($cat)) : ?>
                <tr>
                    <td class="text-center"><?=ucwords($categories['name']) ;?></td>
                    <td>
                            <center>
                               <a href="categories.php?delete=<?= $categories['id'];?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                            </center>
                    </td>
                </tr>

            <?php endwhile ;?>
                
            </table>
                </div>
        
       <div class="col-md-3 filters ">
        <div class="row">
        <div class="col-md-12 ">
          <div><?php if(!empty($errors)){echo show_errors($errors);};?></div>
            <div class="card">
                <form action="categories.php" method="post" enctype="multipart/form-data">
                  <h5 class="text-primary">Add New Category</h5>
                   <div class="form-group">
                   </br>
                        <input type="text" name="category" class="form-control" placeholder="Category Name">
                    </div>
                    <div class="form-group form-group-sm">
                        <input type="submit" class="btn btn-sm btn-block btn-primary" value="ADD CATEGORY">
                    </div>
                </form>    
            </div>
          </div>
        </div>
      </div>
    </div>
  
        