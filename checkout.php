<?php include 'includes/config.php';

$id = (int)$_POST['uid'];


$sql = $db->query("SELECT * FROM cart WHERE uid = '$id'");
$resu = mysqli_fetch_assoc($sql);


$ready = rand(1000,100000);
	
$db->query("UPDATE cart SET orderid = '$ready' WHERE uid = '$id' AND orderid = 0"); 	

