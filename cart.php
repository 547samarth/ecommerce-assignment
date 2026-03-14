<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Cart</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">
<h3>Your Cart</h3>

<table class="table table-bordered">
<tr>
<th>Product</th>
<th>Price</th>
</tr>

<?php
$user_id=1;
$q=mysqli_query($conn,"SELECT products.name,products.price FROM cart 
JOIN products ON cart.product_id=products.id WHERE cart.user_id='$user_id'");

while($r=mysqli_fetch_assoc($q)){
echo "<tr><td>".$r['name']."</td><td>₹".$r['price']."</td></tr>";
}
?>

</table>
<a href="index.php" class="btn btn-primary">Continue Shopping</a>
</div>
</body>
</html>