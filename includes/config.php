<?php
date_default_timezone_set('Africa/Nairobi');

$db = mysqli_connect('127.0.0.1','root','','growap');

session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/growap/config.php';
define('LINKURL', 'C:/xampp/htdocs/growap/');
define('BACKLINK','/growap/');



if(isset($_SESSION['admin'])){
  $id = $_SESSION['admin'];
  $sql = $db->query("SELECT * FROM users WHERE id = '$id'");
  $userdata = mysqli_fetch_assoc($sql);

  $user = $userdata['fullname'];
  $userid = $userdata['id'];

}

if(isset($_SESSION['customer']) && $_SESSION['customer']>0){
	$id = $_SESSION['customer'];
    $sql = $db->query("SELECT * FROM customer WHERE id ='$id'");
    $userlog = mysqli_fetch_assoc($sql);
    $usercustomer = $userlog['fullname'];
    $user_id =$userlog['id'];
}

if(isset($_SESSION['success'])){
  echo'<div class = "bg-success"><p class="text-success text-center sms">'.$_SESSION['success'].'</p></div>';
  unset($_SESSION['success']);
}
if(isset($_SESSION['error'])){
  echo'<div class = "bg-danger"><p class="text-danger text-center sms">'.$_SESSION['error'].'</p></div>';
  unset($_SESSION['error']);
}

