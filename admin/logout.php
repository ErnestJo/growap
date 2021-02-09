<?php
include '../includes/config.php';
unset($_SESSION['admin']);
header('Location: ../login.php');