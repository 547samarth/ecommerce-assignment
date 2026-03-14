<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Wishlist</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">
<h3>Your Wishlist</h3>

<table class="table table-bordered">
<tr>
<th>Product</th>
<th>Price</th>
</tr>

<?php
$user_id=1;

$q=mysqli_query($conn,"SELECT products.name,products.price FROM wishlist 
JOIN products ON wishlist.product_id=products.id WHERE wishlist.user_id='$user_id'");

if(mysqli_num_rows($q) == 0){
echo "<tr><td colspan='2'>Your wishlist is empty</td></tr>";
}

while($r=mysqli_fetch_assoc($q)){
echo "<tr><td>".$r['name']."</td><td>₹".$r['price']."</td></tr>";
}
?>

</table>

<a href="index.php" class="btn btn-primary">Back to Shop</a>

</div>
</body>
</html>