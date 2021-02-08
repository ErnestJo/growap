<?php include '../includes/config.php';

$id = (int)$_POST['id'];


$sql = $db->query("SELECT * FROM confirm WHERE id = '$id'");
$resu = mysqli_fetch_assoc($sql);



$yes = 1;

$db->query("UPDATE requests SET confirm = '$yes' WHERE id = '$id'"); 