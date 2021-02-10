<?php include '../includes/config.php';

$id = (int)$_POST['id'];


$sql = $db->query("SELECT * FROM confirm WHERE id = '$id'");
$resu = mysqli_fetch_assoc($sql);



$no = 2;

$db->query("UPDATE requests SET confirm = '$no' WHERE id = '$id'"); 