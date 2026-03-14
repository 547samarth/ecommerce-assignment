<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Naya Style Link -->
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">My<span>Shop</span></a>
            <div class="d-flex align-items-center">
                <a href="cart.php" class="btn btn-warning btn-sm"><i class="fas fa-shopping-cart me-1"></i> Cart</a>
                <a href="wishlist.php" class="btn btn-danger btn-sm"><i class="fas fa-heart me-1"></i> Wishlist</a>
                <a href="profile.php" class="btn btn-info btn-sm active"><i class="fas fa-user me-1"></i> Profile</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card user-info-card">
                    <!-- Banner -->
                    <div class="profile-header-bg"></div>
                    
                    <div class="card-body p-4">
                        <div class="row">
                            <!-- Left: Avatar & Menu -->
                            <div class="col-md-4 text-center border-end-md">
                                <div class="profile-avatar-container">
                                    <img src="https://ui-avatars.com/api/?name=User&background=4361ee&color=fff&size=200" class="profile-avatar">
                                </div>
                                <h4 class="mt-3 mb-1">
                                    <?php 
                                    $q=mysqli_query($conn,"SELECT * FROM users WHERE id=1");
                                    $u=mysqli_fetch_assoc($q);
                                    echo $u['name']; 
                                    ?>
                                </h4>
                                <p class="text-muted mb-4">Customer</p>

                                <div class="list-group list-group-flush text-start profile-menu">
                                    <a href="#" class="list-group-item list-group-item-action active">
                                        <i class="fas fa-user-circle me-2"></i> My Profile
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <i class="fas fa-box me-2"></i> My Orders
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <i class="fas fa-cog me-2"></i> Settings
                                    </a>
                                </div>
                            </div>

                            <!-- Right: Details -->
                            <div class="col-md-8 ps-md-4 mt-4 mt-md-0">
                                <h5 class="mb-4 border-bottom pb-2">Personal Information</h5>
                                
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <div class="detail-label">Full Name</div>
                                        <div class="detail-value"><?php echo $u['name']; ?></div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="detail-label">User ID</div>
                                        <div class="detail-value">#<?php echo $u['id']; ?></div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-sm-12">
                                        <div class="detail-label">Email Address</div>
                                        <div class="detail-value"><?php echo $u['email']; ?></div>
                                    </div>
                                </div>

                                <button class="btn btn-add-cart mt-2">Edit Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>