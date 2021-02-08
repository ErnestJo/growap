<?php include '../includes/config.php';

$id = (int)$_POST['pid'];

$db->query("DELETE FROM product WHERE pid = '$id'");