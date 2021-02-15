<?php include 'includes/config.php';

$id = (int)$_POST['pid'];


$sql = $db->query("SELECT * FROM cart WHERE id = '$pid' AND uid = '$user_id'");
$resu = mysqli_fetch_assoc($sql);

	
$db->query("DELETE FROM cart WHERE pid = '$id' AND uid = '$user_id'"); 	

