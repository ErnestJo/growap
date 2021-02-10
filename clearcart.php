<?php include 'includes/config.php';

$id = (int)$_POST['uid'];



	
$db->query("DELETE FROM cart WHERE uid = '$user_id'"); 	

