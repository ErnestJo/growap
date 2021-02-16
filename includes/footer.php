<?php
require_once 'funcs/function.php';
require_once 'includes/config.php';
?>
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
                <i class="fa fa-university"></i>UDSM
            </p>
            <p>&copy; Copyright SOKONI 2021</p>
            </center>
        </div>
    </div>
</div>
<div class="container" id="brand">
    <div class="row">
        <div class="col-md-12 text-center">
            <a href="" target="_blank" id="me">Website by Group five </a>
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


 function checkout(uid){
                var uid = uid;
                $.ajax({
                  url:'checkout.php',
                  type:'POST',
                  data: {uid:uid},
                  success: function(){window.location.reload();},
                  error: function(){alert( "Something Went Wrong");},
                });
              }


 function reduce(pid){
                var pid = pid;
                $.ajax({
                  url:'reduce.php',
                  type:'POST',
                  data: {pid:pid},
                  success: function(){window.location.reload();},
                  error: function(){alert( "Something Went Wrong");},
                });
              }

 function increment(pid){
                var pid = pid;
                $.ajax({
                  url:'increment.php',
                  type:'POST',
                  data: {pid:pid},
                  success: function(){window.location.reload();},
                  error: function(){alert( "Something Went Wrong");},
                });
              }

function remove(pid){
                var pid = pid;
                $.ajax({
                  url:'remove.php',
                  type:'POST',
                  data: {pid:pid},
                  success: function(){window.location.reload();},
                  error: function(){alert( "Something Went Wrong");},
                });
              }

function clearcart(uid){
                var uid = uid;
                $.ajax({
                  url:'clearcart.php',
                  type:'POST',
                  data: {uid:uid},
                  success: function(){window.location.reload();},
                  //success: function(){window.location.reload();},
                  error: function(){alert( "Something Went Wrong");},
                });
              }
  </script>

</body>

</html>
