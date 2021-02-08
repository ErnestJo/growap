<?php include '../includes/config.php';

$id = (int)$_POST['orderid'];

$sql = $db->query ("SELECT * FROM cart WHERE orderid = '$id' ");

$order = mysqli_fetch_assoc($sql);

if ($_POST) {
	$yes = 1;
	$confirm = $order['confirm'];

	if($confirm == 0 ){

		$db->query("UPDATE cart SET confirm = '$yes' WHERE orderid = '$id'");

		$sql = $db->query ("SELECT * FROM cart WHERE orderid = '$id' ");
		$order = mysqli_fetch_assoc($sql);

		$qty = '';

		foreach ($order as $key ) {
			$old_qty = $key['quantity'];
			$pid = $key['pid']; 
			$sql = $db->query ("SELECT * FROM products WHERE pid = '$pid' ");
			$prdcts = mysqli_fetch_assoc($sql);
			$new_qty = $prdcts['quantity'] - $old_qty;
		 $db->query("UPDATE products SET quantity = '$new_qty' WHERE pid = '$pid'");
		}


	}
	else{

		$db->query("UPDATE cart SET deliver = '$yes' WHERE orderid = '$id'"); 
	}
}
