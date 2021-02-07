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
include 'includes/navigation.php';
include 'includes/dashboard.php';



  $cats = ((isset($_POST['cat']))? clean($_POST['cat']) :'');

  if($_POST){
      $errors = array();
      if(empty($cats)){
        $errors[] = 'You must select one category!';
      }
      if(!empty($_FILES)){
          $photo = $_FILES['photo'];
          $name = $photo['name'];
         $nameArray = explode('.',$name);
          $filename = $nameArray[0];
          $fileEXT = $nameArray[1];
          $mime = explode('/', $photo['type']);
          $mimeType = $mime[0];
          $mimeEXT = $mime[1];
          $temploc = $photo['tmp_name'];
          $filesize = $photo['size'];
          $fileExt = explode('.', $name);
          $ActualfileEXT = strtolower(end($fileExt));
          $allowed = array('png','jpg','jpeg','gif');
          $uploadname = md5(microtime()).'.'.$ActualfileEXT;
          $uploadpath = LINKURL.'imgs/adverts/'.$uploadname;
          $dbpath = BACKLINK.'imgs/adverts/'.$uploadname;
          
          if(!in_array($ActualfileEXT, $allowed)){
              $errors[]= 'The photo extension must be jpg,png,jpeg or gif.';
          }
          if($filesize > 25000000){
             $errors[]= 'The file size must be less than 25MB.';
          }
          if($ActualfileEXT != $mimeEXT && $mimeEXT == 'jpeg' && $ActualfileEXT != 'jpg' ){
              $errors[]= 'File extension does not match the file.';
          }
      }
      if(!empty($errors)){
          echo show_errors($errors);
      } else {
         //upload file and insert into database
        if (!empty($_FILES)) {
          move_uploaded_file($temploc,$uploadpath);
        }
        //deletes image from file system
         $img_del=$db->query("SELECT * FROM ads WHERE id = '$cats'");
            $del_img = mysqli_fetch_assoc($img_del);

            $image_url = $_SERVER['DOCUMENT_ROOT'].$del_img['image'];
            unlink($image_url);

        $db->query("UPDATE ads SET image='$dbpath' WHERE id ='$cats'");
         //$_SESSION['success'] = 'Ads Updated succesifully';
         //header('Location: Adverts.php');
        }
  }
 ?>
        <div class="col-md-9 body">
            <h3>
               Our Adverts <i class="ti-tag"></i> 
                
            </h3>
            <hr>
            <div class="row">
                <div class="col-md-3 filters">
                    <h4 class="text-uppercase text-info"><b>Upload Adverts</b></h4>
                    <form action="Adverts.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="category">Priority:*</label>
        <select class="form-control" name="cat">
          <option value=""></option>
          <option value="1">First Advert</option>
          <option value="2">Second Advert</option>
          
        </select>
      </div>
      <div class="form-group">
        <label for="image">Image:*</label>
        <input type="file" name="photo" class="form-control">
      </div>
      <div class="form-groupr">
        <button type="submit" class="btn btn-success">Update</button>
      </div>
    </form>
                </div>
                <div class="col-md-9 products">
                    <?php $sql = $db->query("SELECT * FROM ads WHERE id = 1") ;
                      $advert = mysqli_fetch_assoc($sql);
                    ;?>
                    <div class="col-md-3">
                        <div class="card">
                          <img src="<?=$advert['image'];?>" alt="Avatar" style="width:100%">
                          <div class="card_box">
                            
                          </div>
                        </div>
                    </div>
                    <?php $sql = $db->query("SELECT * FROM ads WHERE id = 2") ;
                      $advert = mysqli_fetch_assoc($sql);
                    ;?>
                    <div class="col-md-3">
                        <div class="card">
                          <img src="<?=$advert['image'];?>" alt="Avatar" style="width:100%">
                          <div class="card_box">
                            
                          </div>
                        </div>
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
