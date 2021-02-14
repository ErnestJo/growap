<?php include 'includes/config.php';

$id = (int)$_POST['pid'];

$sql = $db->query("SELECT * FROM cart WHERE pid = '$id' AND orderid = 0 AND uid = '$user_id'");
$sql1 = $db->query("SELECT * FROM product WHERE pid = '$id'");
$resu = mysqli_fetch_assoc($sql);
$check = mysqli_fetch_assoc($sql1);

$current = $resu['quantities'];





 
if ($_POST) {

	$new = $current + 1;
	$quantity = $check['quantity'];
	
 	if ($new <= $quantity){

			$db->query("UPDATE cart SET quantities = '$new' WHERE pid = '$id' AND orderid = 0 AND uid = '$user_id'"); 

}
}
