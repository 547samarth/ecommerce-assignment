<?php
include 'config.php';
$user_id = 1;
$product_id = $_GET['id'];
mysqli_query($conn,"INSERT INTO wishlist(user_id,product_id) VALUES('$user_id','$product_id')");
header("Location: wishlist.php");
?>