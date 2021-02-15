<?php include 'includes/config.php';

$id = (int)$_POST['pid'];

$sql = $db->query("SELECT * FROM cart WHERE pid = '$id' AND orderid = 0 AND uid = '$user_id'");
$resu = mysqli_fetch_assoc($sql);

$current = $resu['quantities'];

if ($_POST) {

		$new = $current - 1;

	if ($new == 0 ) {

		$db->query("DELETE * FROM cart WHERE pid = '$id' AND orderid = 0 AND uid = '$user_id'"); 
	}
	else
	{
		$db->query("UPDATE cart SET quantities = '$new' WHERE pid = '$id' AND orderid = 0 AND uid = '$user_id'"); 

		echo "perfect";
	}
}

